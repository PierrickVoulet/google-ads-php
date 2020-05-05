<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/ads/googleads/v3/resources/keyword_plan.proto

namespace Google\Ads\GoogleAds\V3\Resources;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * A Keyword Planner plan.
 * Max number of saved keyword plans: 10000.
 * It's possible to remove plans if limit is reached.
 *
 * Generated from protobuf message <code>google.ads.googleads.v3.resources.KeywordPlan</code>
 */
class KeywordPlan extends \Google\Protobuf\Internal\Message
{
    /**
     * Immutable. The resource name of the Keyword Planner plan.
     * KeywordPlan resource names have the form:
     * `customers/{customer_id}/keywordPlans/{kp_plan_id}`
     *
     * Generated from protobuf field <code>string resource_name = 1 [(.google.api.field_behavior) = IMMUTABLE, (.google.api.resource_reference) = {</code>
     */
    protected $resource_name = '';
    /**
     * Output only. The ID of the keyword plan.
     *
     * Generated from protobuf field <code>.google.protobuf.Int64Value id = 2 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     */
    protected $id = null;
    /**
     * The name of the keyword plan.
     * This field is required and should not be empty when creating new keyword
     * plans.
     *
     * Generated from protobuf field <code>.google.protobuf.StringValue name = 3;</code>
     */
    protected $name = null;
    /**
     * The date period used for forecasting the plan.
     *
     * Generated from protobuf field <code>.google.ads.googleads.v3.resources.KeywordPlanForecastPeriod forecast_period = 4;</code>
     */
    protected $forecast_period = null;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type string $resource_name
     *           Immutable. The resource name of the Keyword Planner plan.
     *           KeywordPlan resource names have the form:
     *           `customers/{customer_id}/keywordPlans/{kp_plan_id}`
     *     @type \Google\Protobuf\Int64Value $id
     *           Output only. The ID of the keyword plan.
     *     @type \Google\Protobuf\StringValue $name
     *           The name of the keyword plan.
     *           This field is required and should not be empty when creating new keyword
     *           plans.
     *     @type \Google\Ads\GoogleAds\V3\Resources\KeywordPlanForecastPeriod $forecast_period
     *           The date period used for forecasting the plan.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Ads\GoogleAds\V3\Resources\KeywordPlan::initOnce();
        parent::__construct($data);
    }

    /**
     * Immutable. The resource name of the Keyword Planner plan.
     * KeywordPlan resource names have the form:
     * `customers/{customer_id}/keywordPlans/{kp_plan_id}`
     *
     * Generated from protobuf field <code>string resource_name = 1 [(.google.api.field_behavior) = IMMUTABLE, (.google.api.resource_reference) = {</code>
     * @return string
     */
    public function getResourceName()
    {
        return $this->resource_name;
    }

    /**
     * Immutable. The resource name of the Keyword Planner plan.
     * KeywordPlan resource names have the form:
     * `customers/{customer_id}/keywordPlans/{kp_plan_id}`
     *
     * Generated from protobuf field <code>string resource_name = 1 [(.google.api.field_behavior) = IMMUTABLE, (.google.api.resource_reference) = {</code>
     * @param string $var
     * @return $this
     */
    public function setResourceName($var)
    {
        GPBUtil::checkString($var, True);
        $this->resource_name = $var;

        return $this;
    }

    /**
     * Output only. The ID of the keyword plan.
     *
     * Generated from protobuf field <code>.google.protobuf.Int64Value id = 2 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     * @return \Google\Protobuf\Int64Value
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the unboxed value from <code>getId()</code>

     * Output only. The ID of the keyword plan.
     *
     * Generated from protobuf field <code>.google.protobuf.Int64Value id = 2 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     * @return int|string|null
     */
    public function getIdUnwrapped()
    {
        return $this->readWrapperValue("id");
    }

    /**
     * Output only. The ID of the keyword plan.
     *
     * Generated from protobuf field <code>.google.protobuf.Int64Value id = 2 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     * @param \Google\Protobuf\Int64Value $var
     * @return $this
     */
    public function setId($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\Int64Value::class);
        $this->id = $var;

        return $this;
    }

    /**
     * Sets the field by wrapping a primitive type in a Google\Protobuf\Int64Value object.

     * Output only. The ID of the keyword plan.
     *
     * Generated from protobuf field <code>.google.protobuf.Int64Value id = 2 [(.google.api.field_behavior) = OUTPUT_ONLY];</code>
     * @param int|string|null $var
     * @return $this
     */
    public function setIdUnwrapped($var)
    {
        $this->writeWrapperValue("id", $var);
        return $this;}

    /**
     * The name of the keyword plan.
     * This field is required and should not be empty when creating new keyword
     * plans.
     *
     * Generated from protobuf field <code>.google.protobuf.StringValue name = 3;</code>
     * @return \Google\Protobuf\StringValue
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the unboxed value from <code>getName()</code>

     * The name of the keyword plan.
     * This field is required and should not be empty when creating new keyword
     * plans.
     *
     * Generated from protobuf field <code>.google.protobuf.StringValue name = 3;</code>
     * @return string|null
     */
    public function getNameUnwrapped()
    {
        return $this->readWrapperValue("name");
    }

    /**
     * The name of the keyword plan.
     * This field is required and should not be empty when creating new keyword
     * plans.
     *
     * Generated from protobuf field <code>.google.protobuf.StringValue name = 3;</code>
     * @param \Google\Protobuf\StringValue $var
     * @return $this
     */
    public function setName($var)
    {
        GPBUtil::checkMessage($var, \Google\Protobuf\StringValue::class);
        $this->name = $var;

        return $this;
    }

    /**
     * Sets the field by wrapping a primitive type in a Google\Protobuf\StringValue object.

     * The name of the keyword plan.
     * This field is required and should not be empty when creating new keyword
     * plans.
     *
     * Generated from protobuf field <code>.google.protobuf.StringValue name = 3;</code>
     * @param string|null $var
     * @return $this
     */
    public function setNameUnwrapped($var)
    {
        $this->writeWrapperValue("name", $var);
        return $this;}

    /**
     * The date period used for forecasting the plan.
     *
     * Generated from protobuf field <code>.google.ads.googleads.v3.resources.KeywordPlanForecastPeriod forecast_period = 4;</code>
     * @return \Google\Ads\GoogleAds\V3\Resources\KeywordPlanForecastPeriod
     */
    public function getForecastPeriod()
    {
        return $this->forecast_period;
    }

    /**
     * The date period used for forecasting the plan.
     *
     * Generated from protobuf field <code>.google.ads.googleads.v3.resources.KeywordPlanForecastPeriod forecast_period = 4;</code>
     * @param \Google\Ads\GoogleAds\V3\Resources\KeywordPlanForecastPeriod $var
     * @return $this
     */
    public function setForecastPeriod($var)
    {
        GPBUtil::checkMessage($var, \Google\Ads\GoogleAds\V3\Resources\KeywordPlanForecastPeriod::class);
        $this->forecast_period = $var;

        return $this;
    }

}

