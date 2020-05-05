## 3.2.0
*   Added support for v3_1 of Google Ads API.
*   Fixed the field masks to work properly with repeated fields in a message.
*   Extended `GoogleAdsService.searchStream` with an experimental iterator.
*   Refreshed `ResourceNames` with some types: `CurrencyConstant`, `Ad`, `AdGroupExtensionSetting`,
    `CustomerExtensionSetting`, `CampaignExtensionSetting`.
*   Added code examples
    * AddResponsiveSearchAd
    * GetResponsiveSearchAds
    * AddHotelCallout
    * UpdateExpandedTextAd
    * UpdateSitelink
    * UpdateSitelinkCampaignExtensionSetting
    * AddMerchantCenterDynamicRemarketingCampaign
    * ForecastReach
    * AddGeoTarget
    * RemoveEntireSitelinkCampaignExtensionSetting
    * GetAdGroupCriterionCpcBidSimulations
    * UploadCallConversion
    * ApproveMerchantCenterLink
    * SearchForLanguageAndCarrierConstants
    * GetCampaignCriterionBidModifierSimulations
    * AddCustomerMatchUserList
*   Improved code examples
    * GetAccountHierarchy
    * AddCompleteCampaignsUsingMutateJob
    * GetAccountBudgets

## 3.1.0
*   Added support for v3_0 of Google Ads API.
*   Added support for conversion-typed API errors.
*   Added code examples: AddSiteLinks, UploadMediaBundle, UploadImageAsset,
    UploadConversionAdjustment, ValidateTextAd, AddPrices, AddListingScope,
    UpdateCampaignCriterionBidModifier, AddAppCampaign.
*   Fixed code examples: AddDynamicPageFeed.
*   Improved code examples: UploadOfflineConversion, GetArtifactMetadata, AddRemarketingAction.
*   Upgraded the Coding Style from PSR-2 to PSR-12 and made the code compliant.
*   Upgraded dependencies: `squizlabs/php_codesniffer` (^3.5), `google/protobuf` (^3.11.4).

## 3.0.0
*   Removed support of PHP 7.1.
*   Remove the preemptive initialization of "GoogleAdsFailures" when not running with gRPC
    transport.
*   Added code examples: RemoveFlightsFeedItemStringAttributeValue,
    UpdateFlightsFeedItemStringAttributeValue, RemoveFeedItems, HandleRateExceededError,
    GetProductBiddingCategoryConstant, AddDemographicTargetingCriteria, AddRemarketingAction and
    UploadOfflineConversion.
*   Fixed code examples: AddHotelAd and GetAccountHierarchy.

## 2.2.0
*   Added support for v2_2 of Google Ads API.
*   Added examples for feeds (ad customizer, real estate, flights, Google My Business), negative
    criteria, image assets and account hierarchy.
*   Enhanced error management of mutate operations.
*   Added support for monolog 2.0.

## 2.1.0
*   Added support for v2_1 of Google Ads API.
*   Switched the default implementation of protobuf to use the C extension and added related
    documentation.
*   Added examples for Google My Business location extensions, Smart display ads and campaign
    experiments.

## 2.0.0
*   Added support for v2 of Google Ads API.
*   Renamed the getter and setter functions for unwrapped values from getXXXValue/setXXXValue to
    getXXXUnwrapped/setXXXUnwrapped to prevent them from clashing with other field names.
*   Added a test to instantiate all classes in the codebase to make sure there are no syntax errors.
*   Upgraded dependencies.

## 1.4.1
*   Fixed logging level configuration ([#120](https://github.com/googleads/google-ads-php/pull/120)).
*   Set max response message and metadata size ([#127](https://github.com/googleads/google-ads-php/pull/127)).

## 1.4.0
*   Added support for more resources in `ResourceNames`.
*   Added examples for Smart Shopping campaigns, batch processing using
    MutateJobService, and campaign draft.
*   Increased default deadline to 1 hour and added retry support for
    GoogleAdsService.search().

## 1.3.0
*   Added support for v1_3 of Google Ads API.
*   Added examples for ad parameters, campaign labels and media upload and retrieval.

## 1.2.0

*   Added support for v1_2 of Google Ads API.
*   Added utility functions to convert enum names to integer values and vice versa.
*   Added convenience functions for automatic unboxing of protobuf values, e.g. `getNameValue` along
    with the existing `getName`.
*   Added an example on campaign management migration from the legacy AdWords API.

## 1.1.0

*   Added support for v1_1 of Google Ads API.
*   Upgraded PHPUnit dependency to v7.5.
*   Added support for partial failures and matching example.

## 1.0.0

*   Added support and examples for v1_0 of Google Ads API.
*   Updated some dependencies, e.g., google/gax 0.38.0 and ulrichsg/getopt-php 3.2.2.
*   Updated some examples to match the new API specifications, e.g., GetHotelAdsPerformance.
*   Fixed a bug that prevented the login-customer-id header from being sent.

## 0.7.0

*   Added support and examples for v0_7 of Google Ads API.
*   Updated some examples to match the new API specifications, e.g., ApplyRecommendation,
    DismissRecommendation, GetKeywordStats, AddCampaignBidModifier.
*   Added GetHotelAdsPerformance example.
*   Removed AddCampaignGroup example.

## 0.6.0

*   Added support and examples for v0_6 of Google Ads API.
*   Added support for passing log-in customer ID with API requests.
*   Updated some examples to match the new API specifications, e.g.,
    ApplyRecommendations.php, GetGeoTargetConstantByNames.php.
*   Updated AddCampaignTargetingCriteria example to show how to include
    proximity targeting.

## 0.5.0

*   Added support and examples for v0_5 of Google Ads API.
*   Added campaign targeting criteria examples.
*   Added an account budget example.
*   Added Shopping campaign examples.
*   Added an account change example.

## 0.4.0

*   Added support and examples for v0_4 of Google Ads API.
*   Added account budget proposal and billing setup examples.
*   Added conversion action examples.
*   Added an example showing how to retrieve disapproved ads.

## 0.3.0

*   Added support and examples for V0_3 of Google Ads API.
*   Updated GetArtifactMetadata to quote the name param value.
*   Updated examples to initialize properties via constructors instead of
    setters.
*   Added examples showing how to add and get ad group bid modifiers.
*   Added an example showing how to create and attach shared keyword sets.
*   Added an example showing how to remove shared set criteria.
*   Updated hotel ad group bid modifier example with v0_3 criteria changes.
*   Added AddCampaignBidModifier example.

## 0.2.0

*   Added support for V0_2 of Google Ads API, which includes the Percent CPC
    bidding strategy.

## 0.1.0

*   Initial release with support for V0_1 of Google Ads API.
