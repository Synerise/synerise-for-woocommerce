<?php
/**
 * CalculateOverrideBody2
 *
 * PHP version 5
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Data Management
 *
 * Welcome to Synerise API Reference! We hope that you'll enjoy your stay here.  If you need help with our services, feel free to contact us at  [support@synerise.com](mailto:support@synerise.com).  # Authentication  <!-- ReDoc-Inject: <security-definitions> -->
 *
 * OpenAPI spec version: Jul 4, 2022 12:12:40 PM
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 3.0.34
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Synerise\DataManagement\Model;

use \ArrayAccess;
use \Synerise\DataManagement\ObjectSerializer;

/**
 * CalculateOverrideBody2 Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class CalculateOverrideBody2 implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'calculate_override_body_2';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'date_filter' => 'OneOfcalculateOverrideBody2DateFilter',
'aggregate_data_by' => '\Synerise\DataManagement\Model\AnalyticsdefinitionsmanagerexpressionsUUIDclientclientIdcalculateoverrideAggregateDataBy',
'filter' => '\Synerise\DataManagement\Model\AnalyticsdefinitionsmanagerexpressionsUUIDclientclientIdcalculateoverrideFilter',
'variables' => '\Synerise\DataManagement\Model\AnalyticsdefinitionsmanagerexpressionsprojectionsVariables[]'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'date_filter' => null,
'aggregate_data_by' => null,
'filter' => null,
'variables' => null    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'date_filter' => 'dateFilter',
'aggregate_data_by' => 'aggregateDataBy',
'filter' => 'filter',
'variables' => 'variables'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'date_filter' => 'setDateFilter',
'aggregate_data_by' => 'setAggregateDataBy',
'filter' => 'setFilter',
'variables' => 'setVariables'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'date_filter' => 'getDateFilter',
'aggregate_data_by' => 'getAggregateDataBy',
'filter' => 'getFilter',
'variables' => 'getVariables'    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['date_filter'] = isset($data['date_filter']) ? $data['date_filter'] : null;
        $this->container['aggregate_data_by'] = isset($data['aggregate_data_by']) ? $data['aggregate_data_by'] : null;
        $this->container['filter'] = isset($data['filter']) ? $data['filter'] : null;
        $this->container['variables'] = isset($data['variables']) ? $data['variables'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets date_filter
     *
     * @return OneOfcalculateOverrideBody2DateFilter
     */
    public function getDateFilter()
    {
        return $this->container['date_filter'];
    }

    /**
     * Sets date_filter
     *
     * @param OneOfcalculateOverrideBody2DateFilter $date_filter Details of the date filter. The analysis results are calculated from data that matches the filter.
     *
     * @return $this
     */
    public function setDateFilter($date_filter)
    {
        $this->container['date_filter'] = $date_filter;

        return $this;
    }

    /**
     * Gets aggregate_data_by
     *
     * @return \Synerise\DataManagement\Model\AnalyticsdefinitionsmanagerexpressionsUUIDclientclientIdcalculateoverrideAggregateDataBy
     */
    public function getAggregateDataBy()
    {
        return $this->container['aggregate_data_by'];
    }

    /**
     * Sets aggregate_data_by
     *
     * @param \Synerise\DataManagement\Model\AnalyticsdefinitionsmanagerexpressionsUUIDclientclientIdcalculateoverrideAggregateDataBy $aggregate_data_by aggregate_data_by
     *
     * @return $this
     */
    public function setAggregateDataBy($aggregate_data_by)
    {
        $this->container['aggregate_data_by'] = $aggregate_data_by;

        return $this;
    }

    /**
     * Gets filter
     *
     * @return \Synerise\DataManagement\Model\AnalyticsdefinitionsmanagerexpressionsUUIDclientclientIdcalculateoverrideFilter
     */
    public function getFilter()
    {
        return $this->container['filter'];
    }

    /**
     * Sets filter
     *
     * @param \Synerise\DataManagement\Model\AnalyticsdefinitionsmanagerexpressionsUUIDclientclientIdcalculateoverrideFilter $filter filter
     *
     * @return $this
     */
    public function setFilter($filter)
    {
        $this->container['filter'] = $filter;

        return $this;
    }

    /**
     * Gets variables
     *
     * @return \Synerise\DataManagement\Model\AnalyticsdefinitionsmanagerexpressionsprojectionsVariables[]
     */
    public function getVariables()
    {
        return $this->container['variables'];
    }

    /**
     * Sets variables
     *
     * @param \Synerise\DataManagement\Model\AnalyticsdefinitionsmanagerexpressionsprojectionsVariables[] $variables A list of dynamically modifiable variables that occur in this analysis
     *
     * @return $this
     */
    public function setVariables($variables)
    {
        $this->container['variables'] = $variables;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
