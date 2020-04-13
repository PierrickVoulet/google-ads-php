<?php

/**
 * Copyright 2020 Google LLC
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     https://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Ads\GoogleAds\Examples\Extensions;

require __DIR__ . '/../../vendor/autoload.php';

use GetOpt\GetOpt;
use Google\Ads\GoogleAds\Examples\Utils\ArgumentNames;
use Google\Ads\GoogleAds\Examples\Utils\ArgumentParser;
use Google\Ads\GoogleAds\Lib\OAuth2TokenBuilder;
use Google\Ads\GoogleAds\Lib\V3\GoogleAdsClient;
use Google\Ads\GoogleAds\Lib\V3\GoogleAdsClientBuilder;
use Google\Ads\GoogleAds\Lib\V3\GoogleAdsException;
use Google\Ads\GoogleAds\Util\V3\ResourceNames;
use Google\Ads\GoogleAds\V3\Common\AdScheduleInfo;
use Google\Ads\GoogleAds\V3\Common\Money;
use Google\Ads\GoogleAds\V3\Common\PriceFeedItem;
use Google\Ads\GoogleAds\V3\Common\PriceOffer;
use Google\Ads\GoogleAds\V3\Enums\DayOfWeekEnum\DayOfWeek;
use Google\Ads\GoogleAds\V3\Enums\ExtensionTypeEnum\ExtensionType;
use Google\Ads\GoogleAds\V3\Enums\MinuteOfHourEnum\MinuteOfHour;
use Google\Ads\GoogleAds\V3\Enums\PriceExtensionPriceQualifierEnum\PriceExtensionPriceQualifier;
use Google\Ads\GoogleAds\V3\Enums\PriceExtensionPriceUnitEnum\PriceExtensionPriceUnit;
use Google\Ads\GoogleAds\V3\Enums\PriceExtensionTypeEnum\PriceExtensionType;
use Google\Ads\GoogleAds\V3\Errors\GoogleAdsError;
use Google\Ads\GoogleAds\V3\Resources\CustomerExtensionSetting;
use Google\Ads\GoogleAds\V3\Resources\ExtensionFeedItem;
use Google\Ads\GoogleAds\V3\Services\CustomerExtensionSettingOperation;
use Google\Ads\GoogleAds\V3\Services\ExtensionFeedItemOperation;
use Google\ApiCore\ApiException;
use Google\Protobuf\Int32Value;
use Google\Protobuf\Int64Value;
use Google\Protobuf\StringValue;

/**
 * This example adds a price extension and associates it with an account. Campaign
 * targeting is also set using the specified campaign ID. To get campaigns, run GetCampaigns.php
 */
class AddPrices
{
    private const CUSTOMER_ID = 'INSERT_CUSTOMER_ID_HERE';
    private const CAMPAIGN_ID = 'INSERT_CAMPAIGN_ID_HERE';

    public static function main()
    {
        // Either pass the required parameters for this example on the command line, or insert them
        // into the constants above.
        $options = (new ArgumentParser())->parseCommandArguments([
            ArgumentNames::CUSTOMER_ID => GetOpt::REQUIRED_ARGUMENT,
            ArgumentNames::CAMPAIGN_ID => GetOpt::REQUIRED_ARGUMENT
        ]);

        // Generate a refreshable OAuth2 credential for authentication.
        $oAuth2Credential = (new OAuth2TokenBuilder())->fromFile()->build();

        // Construct a Google Ads client configured from a properties file and the
        // OAuth2 credentials above.
        $googleAdsClient = (new GoogleAdsClientBuilder())->fromFile()
            ->withOAuth2Credential($oAuth2Credential)
            ->build();

        try {
            self::runExample(
                $googleAdsClient,
                $options[ArgumentNames::CUSTOMER_ID] ?: self::CUSTOMER_ID,
                $options[ArgumentNames::CAMPAIGN_ID] ?: self::CAMPAIGN_ID
            );
        } catch (GoogleAdsException $googleAdsException) {
            printf(
                "Request with ID '%s' has failed.%sGoogle Ads failure details:%s",
                $googleAdsException->getRequestId(),
                PHP_EOL,
                PHP_EOL
            );
            foreach ($googleAdsException->getGoogleAdsFailure()->getErrors() as $error) {
                /** @var GoogleAdsError $error */
                printf(
                    "\t%s: %s%s",
                    $error->getErrorCode()->getErrorCode(),
                    $error->getMessage(),
                    PHP_EOL
                );
            }
        } catch (ApiException $apiException) {
            printf(
                "ApiException was thrown with message '%s'.%s",
                $apiException->getMessage(),
                PHP_EOL
            );
        }
    }

    /**
     * Runs the example.
     *
     * @param GoogleAdsClient $googleAdsClient the Google Ads API client
     * @param int $customerId the client customer ID
     * @param int $campaignId the campaign ID
     */
    public static function runExample(
        GoogleAdsClient $googleAdsClient,
        int $customerId,
        int $campaignId
    ) {
        // Creates an extension feed item as price.
        $extensionFeedItemResourceName =
            self::createExtensionFeedItem($googleAdsClient, $customerId, $campaignId);

        // Creates a customer extension setting using the previously created extension
        // feed item. This associates the price extension to your account.
        $customerExtensionSetting = new CustomerExtensionSetting([
            'extension_type' => ExtensionType::PRICE,
            'extension_feed_items' => [new StringValue(['value' => $extensionFeedItemResourceName])]
        ]);
        // Creates a customer extension setting operation.
        $customerExtensionSettingOperation = new CustomerExtensionSettingOperation();
        $customerExtensionSettingOperation->setCreate($customerExtensionSetting);

        // Issues a mutate request to add the customer extension setting and print its information.
        $customerExtensionSettingServiceClient =
            $googleAdsClient->getCustomerExtensionSettingServiceClient();
        $response = $customerExtensionSettingServiceClient->mutateCustomerExtensionSettings(
            $customerId,
            [$customerExtensionSettingOperation]
        );
        printf(
            "Created customer extension setting with resource name: '%s'.%s",
            $response->getResults()[0]->getResourceName(),
            PHP_EOL
        );
    }

    /**
     * Creates an extension feed item for price extension.
     *
     * @param GoogleAdsClient $googleAdsClient the Google Ads API client
     * @param int $customerId the client customer ID
     * @param int $campaignId the campaign ID
     * @return string the created extension feed item's resource name
     */
    private static function createExtensionFeedItem(
        GoogleAdsClient $googleAdsClient,
        int $customerId,
        int $campaignId
    ) {
        // Creates the price extension feed item.
        $priceFeedItem = new PriceFeedItem([
            'type' => PriceExtensionType::SERVICES,
            // Optional: Sets price qualifier.
            'price_qualifier' => PriceExtensionPriceQualifier::FROM,
            'tracking_url_template' => new StringValue([
                'value' => 'http://tracker.example.com/?u={lpurl}']),
            'language_code' => new StringValue(['value' => 'en'])
        ]);

        // To create a price extension, at least three price offerings are needed.
        $priceFeedItem->setPriceOfferings([
            self::createPriceOffer(
                'Scrubs',
                'Body Scrub, Salt Scrub',
                60000000, // 60 USD
                'USD',
                PriceExtensionPriceUnit::PER_HOUR,
                'http://www.example.com/scrubs',
                'http://m.example.com/scrubs'
            ),
            self::createPriceOffer(
                'Hair Cuts',
                'Once a month',
                75000000, // 75 USD
                'USD',
                PriceExtensionPriceUnit::PER_MONTH,
                'http://www.example.com/haircuts',
                'http://m.example.com/haircuts'
            ),
            self::createPriceOffer(
                'Skin Care Package',
                'Four times a month',
                250000000, // 250 USD
                'USD',
                PriceExtensionPriceUnit::PER_MONTH,
                'http://www.example.com/skincarepackage'
            )
        ]);

        // Creates an extension feed item from the price feed item.
        $extensionFeedItem = new ExtensionFeedItem([
            'extension_type' => ExtensionType::PRICE,
            'price_feed_item' => $priceFeedItem,
            'targeted_campaign' => ResourceNames::forCampaign($customerId, $campaignId),
            'ad_schedules' => [
                self::createAdScheduleInfo(
                    DayOfWeek::SUNDAY,
                    10,
                    MinuteOfHour::ZERO,
                    18,
                    MinuteOfHour::ZERO
                ),
                self::createAdScheduleInfo(
                    DayOfWeek::SATURDAY,
                    10,
                    MinuteOfHour::ZERO,
                    22,
                    MinuteOfHour::ZERO
                )
            ]
        ]);

        // Creates an extension feed item operation.
        $extensionFeedItemOperation = new ExtensionFeedItemOperation();
        $extensionFeedItemOperation->setCreate($extensionFeedItem);

        // Issues a mutate request to add the extension feed item and print its information.
        $extensionFeedItemServiceClient = $googleAdsClient->getExtensionFeedItemServiceClient();
        $response = $extensionFeedItemServiceClient->mutateExtensionFeedItems(
            $customerId,
            [$extensionFeedItemOperation]
        );
        $extensionFeedItemResourceName = $response->getResults()[0]->getResourceName();
        printf(
            "Created extension feed item with resource name: '%s'.%s",
            $extensionFeedItemResourceName,
            PHP_EOL
        );

        return $extensionFeedItemResourceName;
    }

    /**
     * Creates a new price offer with the specified parameters.
     *
     * @param string $header the header
     * @param string $description the description
     * @param int $priceInMicros the price in micros
     * @param string $currencyCode the currency code
     * @param int $unit the enum value of unit
     * @param string $finalUrl the final URL
     * @param null|string $finalMobileUrl the final mobile URL
     * @return PriceOffer the created price offer
     */
    private static function createPriceOffer(
        string $header,
        string $description,
        int $priceInMicros,
        string $currencyCode,
        int $unit,
        string $finalUrl,
        string $finalMobileUrl = null
    ) {
        $priceOffer = new PriceOffer([
            'header' => new StringValue(['value' => $header]),
            'description' => new StringValue(['value' => $description]),
            'final_urls' => [new StringValue(['value' => $finalUrl])],
            'price' => new Money([
                'amount_micros' => new Int64Value(['value' => $priceInMicros]),
                'currency_code' => new StringValue(['value' => $currencyCode])
            ]),
            'unit' => $unit
        ]);

        // Optional: Sets the final mobile URLs.
        if (!is_null($finalMobileUrl)) {
            $priceOffer->setFinalMobileUrls([new StringValue(['value' => $finalMobileUrl])]);
        }

        return $priceOffer;
    }

    /**
     * Creates a new ad schedule info with the specified parameters.
     *
     * @param int $dayOfWeek the enum value of day of the schedule
     * @param int $startHour the start hour of the schedule
     * @param int $startMinute the enum value of start minute of the schedule
     * @param int $endHour the end hour of the schedule
     * @param int $endMinute the enum value of end minute of the schedule
     * @return AdScheduleInfo the created schedule info
     */
    private static function createAdScheduleInfo(
        int $dayOfWeek,
        int $startHour,
        int $startMinute,
        int $endHour,
        int $endMinute
    ) {
        return new AdScheduleInfo([
            'day_of_week' => $dayOfWeek,
            'start_hour' => new Int32Value(['value' => $startHour]),
            'start_minute' => $startMinute,
            'end_hour' => new Int32Value(['value' => $endHour]),
            'end_minute' => $endMinute
        ]);
    }
}

AddPrices::main();
