<?php
/**
 * Copyright 2019 Google LLC
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

namespace Google\Ads\GoogleAds\Examples\AdvancedOperations;

require __DIR__ . '/../../vendor/autoload.php';

use GetOpt\GetOpt;
use Google\Ads\GoogleAds\Examples\Utils\ArgumentNames;
use Google\Ads\GoogleAds\Examples\Utils\ArgumentParser;
use Google\Ads\GoogleAds\Lib\V1\GoogleAdsClient;
use Google\Ads\GoogleAds\Lib\V1\GoogleAdsClientBuilder;
use Google\Ads\GoogleAds\Lib\V1\GoogleAdsException;
use Google\Ads\GoogleAds\Lib\OAuth2TokenBuilder;
use Google\Ads\GoogleAds\V1\Common\ExpandedDynamicSearchAdInfo;
use Google\Ads\GoogleAds\V1\Common\ManualCpc;
use Google\Ads\GoogleAds\V1\Common\WebPageConditionInfo;
use Google\Ads\GoogleAds\V1\Common\WebPageInfo;
use Google\Ads\GoogleAds\V1\Enums\AdGroupAdStatusEnum\AdGroupAdStatus;
use Google\Ads\GoogleAds\V1\Enums\AdGroupCriterionStatusEnum\AdGroupCriterionStatus;
use Google\Ads\GoogleAds\V1\Enums\AdGroupStatusEnum\AdGroupStatus;
use Google\Ads\GoogleAds\V1\Enums\AdGroupTypeEnum\AdGroupType;
use Google\Ads\GoogleAds\V1\Enums\AdvertisingChannelTypeEnum\AdvertisingChannelType;
use Google\Ads\GoogleAds\V1\Enums\BudgetDeliveryMethodEnum\BudgetDeliveryMethod;
use Google\Ads\GoogleAds\V1\Enums\CampaignStatusEnum\CampaignStatus;
use Google\Ads\GoogleAds\V1\Enums\WebpageConditionOperandEnum\WebPageConditionOperand;
use Google\Ads\GoogleAds\V1\Resources\Ad;
use Google\Ads\GoogleAds\V1\Resources\AdGroup;
use Google\Ads\GoogleAds\V1\Resources\AdGroupCriterion;
use Google\Ads\GoogleAds\V1\Resources\AdGroupAd;
use Google\Ads\GoogleAds\V1\Resources\Campaign;
use Google\Ads\GoogleAds\V1\Resources\Campaign\DynamicSearchAdsSetting;
use Google\Ads\GoogleAds\V1\Resources\CampaignBudget;
use Google\Ads\GoogleAds\V1\Services\AdGroupCriterionOperation;
use Google\Ads\GoogleAds\V1\Services\AdGroupOperation;
use Google\Ads\GoogleAds\V1\Services\AdGroupAdOperation;
use Google\Ads\GoogleAds\V1\Services\CampaignBudgetOperation;
use Google\Ads\GoogleAds\V1\Services\CampaignOperation;
use Google\Ads\GoogleAds\V1\Services\MutateAdGroupAdsResponse;
use Google\Ads\GoogleAds\V1\Services\MutateAdGroupsResponse;
use Google\Ads\GoogleAds\V1\Services\MutateAdGroupCriteriaResponse;
use Google\Ads\GoogleAds\V1\Services\MutateCampaignBudgetsResponse;
use Google\Ads\GoogleAds\V1\Services\MutateCampaignsResponse;
use Google\Protobuf\Int64Value;
use Google\Protobuf\StringValue;

/**
 * This example adds a new dynamic search ad (DSA) and webpage targeting criteria for the DSA.
 */
class AddDynamicSearchAds
{
    const CUSTOMER_ID = 'INSERT_CUSTOMER_ID_HERE';

    public static function main()
    {
        // Either pass the required parameters for this example on the command line, or insert them
        // into the constants above.
        $options = (new ArgumentParser())->parseCommandArguments([
            ArgumentNames::CUSTOMER_ID => GetOpt::REQUIRED_ARGUMENT
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
                $options[ArgumentNames::CUSTOMER_ID] ?: self::CUSTOMER_ID
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
     * @param string $customerId the client customer ID without hyphens
     */
    public static function runExample(
        GoogleAdsClient $googleAdsClient,
        string $customerId
    ) {
        $budgetResourceName = self::createCampaignBudget($googleAdsClient, $customerId);
        $campaignResourceName = self::createCampaign(
            $googleAdsClient,
            $customerId,
            $budgetResourceName
        );
        $adGroupResourceName = self::createAdGroup(
            $googleAdsClient,
            $customerId,
            $campaignResourceName
        );
        self::createExpandedDSA($googleAdsClient, $customerId, $adGroupResourceName);
        self::createWebPageCriteria($googleAdsClient, $customerId, $adGroupResourceName);
    }

    /**
     * Creates a campaign budget.
     *
     * @param GoogleAdsClient $googleAdsClient the Google Ads API client.
     * @param int $customerId the client customer ID.
     * @return string the campaign budget resource name.
     */
    private static function createCampaignBudget(GoogleAdsClient $googleAdsClient, $customerId)
    {
        $campaignBudget = new CampaignBudget([
            'name' => new StringValue(['value' => 'Interplanetary Cruise Budget #' . uniqid()]),
            'delivery_method' => BudgetDeliveryMethod::STANDARD,
            'amount_micros' => new Int64Value(['value' => 500000])
        ]);

        // Creates a campaign budget operation.
        $campaignBudgetOperation = new CampaignBudgetOperation();
        $campaignBudgetOperation->setCreate($campaignBudget);
     
        // Issues a mutate request to add campaign budgets.
        $campaignBudgetServiceClient = $googleAdsClient->getCampaignBudgetServiceClient();
        /** @var MutateCampaignBudgetsResponse $campaignBudgetResponse */
        $campaignBudgetResponse = $campaignBudgetServiceClient->mutateCampaignBudgets(
            $customerId,
            [$campaignBudgetOperation]
        );

        $campaignBudgetResourceName = $campaignBudgetResponse->getResults()[0]->getResourceName();

        printf("Added budget named '%s'.%s", $campaignBudgetResourceName, PHP_EOL);

        return $campaignBudgetResourceName;
    }

    /**
     * Creates a campaign.
     * @param GoogleAdsClient $googleAdsClient the Google Ads API client
     * @param string $customerId the client customer ID without hyphens
     * @param CampaignBudget $campaignBudget the campaign budget
     * @return string the resource name of the newly created campaign
     */
    private static function createCampaign(
        GoogleAdsClient $googleAdsClient,
        string $customerId,
        string $campaignBudgetResourceName
    ) {
        $startDate = new StringValue(['value' => date('Ymd', strtotime('+1 day'))]);
        $endDate = new StringValue(['value' => date('Ymd', strtotime('+1 month'))]);

        $campaign = new Campaign([
            'name' => new StringValue(['value' => 'Interplanetary Cruise #' . uniqid()]),
            'advertising_channel_type' => AdvertisingChannelType::SEARCH,
            'status' => CampaignStatus::PAUSED,
            'manual_cpc' => new ManualCpc(),
            'campaign_budget' => $campaignBudgetResourceName,
            // Enables the campaign for DSAs.
            'dynamic_search_ads_setting' => new DynamicSearchAdsSetting([
                'domain_name' => new StringValue(['value' => 'example.com']),
                'language_code' => new StringValue(['value' => 'en'])
            ]),
            // Optional: Sets the start and end dates.
            'start_date' => $startDate,
            'end_date' => $endDate
        ]);

        // Creates a campaign operation.
        $campaignOperation = new CampaignOperation();
        $campaignOperation->setCreate($campaign);

        // Issues a mutate request to add campaigns.
        $campaignServiceClient = $googleAdsClient->getCampaignServiceClient();
        /** @var MutateCampaignsResponse $campaignResponse */
        $campaignResponse = $campaignServiceClient->mutateCampaigns(
            $customerId,
            [$campaignOperation]
        );

        $campaignResourceName = $campaignResponse->getResults()[0]->getResourceName();
        printf("Added campaign named '%s'.%s", $campaignResourceName, PHP_EOL);

        return $campaignResourceName;
    }

    /**
     * Creates an ad group.
     * @param GoogleAdsClient $googleAdsClient the Google Ads API client
     * @param string $customerId the client customer ID without hyphens
     * @param Campaign $campaign the campaign
     * @return string the resource name of the newly created ad group
     */
    private static function createAdGroup(
        GoogleAdsClient $googleAdsClient,
        string $customerId,
        string $campaignResourceName
    ) {
        // Constructs an ad group and sets an optional CPC value.
        $adGroup = new AdGroup([
            'name' => new StringValue(['value' => 'Earth to Mars Cruises #' . uniqid()]),
            'campaign' => $campaignResourceName,
            'status' => AdGroupStatus::PAUSED,
            'type' => AdGroupType::SEARCH_DYNAMIC_ADS,
            'tracking_url_template' => new StringValue(
                ['value' => 'http://tracker.examples.com/traveltracker/{escapedlpurl}']
            ),
            'cpc_bid_micros' => new Int64Value(['value' => 10000000])
        ]);

        // Creates an ad group operation.
        $adGroupOperation = new AdGroupOperation();
        $adGroupOperation->setCreate($adGroup);

        // Issues a mutate request to add the ad groups.
        $adGroupServiceClient = $googleAdsClient->getAdGroupServiceClient();
        /** @var MutateAdGroupsResponse $adGroupResponse */
        $adGroupResponse = $adGroupServiceClient->mutateAdGroups($customerId, [$adGroupOperation]);

        $adGroupResourceName = $adGroupResponse->getResults()[0]->getResourceName();
        printf("Added ad group named '%s'.%s", $adGroupResourceName, PHP_EOL);

        return $adGroupResourceName;
    }

    /**
     * Creates an expanded dynamic search ad.
     * @param GoogleAdsClient $googleAdsClient the Google Ads API client
     * @param string $customerId the client customer ID without hyphens
     * @param string $adGroupResourceName the ad group resource name
     */
    private static function createExpandedDSA(
        GoogleAdsClient $googleAdsClient,
        string $customerId,
        string $adGroupResourceName
    ) {
        $adGroupAd = new AdGroupAd([
            'ad_group' => $adGroupResourceName,
            'status' => AdGroupAdStatus::PAUSED,
            'ad' => new Ad([
                'expanded_dynamic_search_ad' => new ExpandedDynamicSearchAdInfo([
                    'description' => new StringValue(['value' => 'Buy tickets now!'])
                ])
            ])
        ]);

        $adGroupAdOperation = new AdGroupAdOperation();
        $adGroupAdOperation->setCreate($adGroupAd);

        // Issues a mutate request to add the ad group ads.
        $adGroupAdServiceClient = $googleAdsClient->getAdGroupAdServiceClient();
        /** @var MutateAdGroupAdsResponse $adGroupAdResponse */
        $adGroupAdResponse = $adGroupAdServiceClient->mutateAdGroupAds(
            $customerId,
            [$adGroupAdOperation]
        );

        $adGroupAdResourceName = $adGroupAdResponse->getResults()[0]->getResourceName();
        printf("Added ad group ad named '%s'.%s", $adGroupAdResourceName, PHP_EOL);

        return $adGroupAdResourceName;
    }

    /**
     * Creates webpage targeting criteria for the DSA.
     * @param GoogleAdsClient $googleAdsClient the Google Ads API client
     * @param string $customerId the client customer ID without hyphens
     * @param AdGroup $adGroup the ad group
     */
    private static function createWebPageCriteria(
        GoogleAdsClient $googleAdsClient,
        string $customerId,
        string $adGroupResourceName
    ) {
        $adGroupCriterion = new AdGroupCriterion([
            'ad_group' => new StringValue(['value' => $adGroupResourceName]),
            'status' => AdGroupCriterionStatus::PAUSED,
            'cpc_bid_micros' => new Int64Value(['value' => 10000000]),
            'webpage' => new WebPageInfo([
                'criterion_name' => new StringValue(['value' => 'Special Offers']),
                'conditions' => [
                    new WebPageConditionInfo([
                        'operand' => WebPageConditionOperand::URL,
                        'argument' => new StringValue(['value' => '/specialoffers'])
                    ]),
                    new WebPageConditionInfo([
                        'operand' => WebPageConditionOperand::PAGE_TITLE,
                        'argument' => new StringValue(['value' => 'Special Offer'])
                    ])
                ]
            ])
        ]);

        $adGroupCriterionOperation = new AdGroupCriterionOperation();
        $adGroupCriterionOperation->setCreate($adGroupCriterion);

        // Issues a mutate request to add the ad group criteria.
        $adGroupCriterionServiceClient = $googleAdsClient->getAdGroupCriterionServiceClient();
        /** @var MutateAdGroupCriteriaResponse $adGroupCriterionResponse */
        $adGroupCriterionResponse = $adGroupCriterionServiceClient->mutateAdGroupCriteria(
            $customerId,
            [$adGroupCriterionOperation]
        );

        $adGroupCriterionResourceName =
            $adGroupCriterionResponse->getResults()[0]->getResourceName();
        printf("Added ad group criterion named '%s'.%s", $adGroupCriterionResourceName, PHP_EOL);
    }
}

AddDynamicSearchAds::main();
