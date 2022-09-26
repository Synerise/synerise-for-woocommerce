<?php
/**
 * InlineResponse20055Content
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
 * InlineResponse20055Content Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class InlineResponse20055Content implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'inline_response_200_55_content';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'aggregate_id' => 'string',
'aggregate_uuid' => 'string',
'client_id' => 'int',
'title' => 'string',
'result' => 'string',
'variables' => '\Synerise\DataManagement\Model\AnalyticsdefinitionsmanagerexpressionsprojectionsVariables[]',
'date_filter' => 'OneOfinlineResponse20055ContentDateFilter'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'aggregate_id' => 'uuid',
'aggregate_uuid' => 'uuid',
'client_id' => null,
'title' => null,
'result' => null,
'variables' => null,
'date_filter' => null    ];

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
        'aggregate_id' => 'aggregateId',
'aggregate_uuid' => 'aggregateUuid',
'client_id' => 'clientId',
'title' => 'title',
'result' => 'result',
'variables' => 'variables',
'date_filter' => 'dateFilter'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'aggregate_id' => 'setAggregateId',
'aggregate_uuid' => 'setAggregateUuid',
'client_id' => 'setClientId',
'title' => 'setTitle',
'result' => 'setResult',
'variables' => 'setVariables',
'date_filter' => 'setDateFilter'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'aggregate_id' => 'getAggregateId',
'aggregate_uuid' => 'getAggregateUuid',
'client_id' => 'getClientId',
'title' => 'getTitle',
'result' => 'getResult',
'variables' => 'getVariables',
'date_filter' => 'getDateFilter'    ];

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
        $this->container['aggregate_id'] = isset($data['aggregate_id']) ? $data['aggregate_id'] : null;
        $this->container['aggregate_uuid'] = isset($data['aggregate_uuid']) ? $data['aggregate_uuid'] : null;
        $this->container['client_id'] = isset($data['client_id']) ? $data['client_id'] : null;
        $this->container['title'] = isset($data['title']) ? $data['title'] : null;
        $this->container['result'] = isset($data['result']) ? $data['result'] : null;
        $this->container['variables'] = isset($data['variables']) ? $data['variables'] : null;
        $this->container['date_filter'] = isset($data['date_filter']) ? $data['date_filter'] : null;
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
     * Gets aggregate_id
     *
     * @return string
     */
    public function getAggregateId()
    {
        return $this->container['aggregate_id'];
    }

    /**
     * Sets aggregate_id
     *
     * @param string $aggregate_id UUID of the aggregate
     *
     * @return $this
     */
    public function setAggregateId($aggregate_id)
    {
        $this->container['aggregate_id'] = $aggregate_id;

        return $this;
    }

    /**
     * Gets aggregate_uuid
     *
     * @return string
     */
    public function getAggregateUuid()
    {
        return $this->container['aggregate_uuid'];
    }

    /**
     * Sets aggregate_uuid
     *
     * @param string $aggregate_uuid UUID of the aggregate
     *
     * @return $this
     */
    public function setAggregateUuid($aggregate_uuid)
    {
        $this->container['aggregate_uuid'] = $aggregate_uuid;

        return $this;
    }

    /**
     * Gets client_id
     *
     * @return int
     */
    public function getClientId()
    {
        return $this->container['client_id'];
    }

    /**
     * Sets client_id
     *
     * @param int $client_id Client ID
     *
     * @return $this
     */
    public function setClientId($client_id)
    {
        $this->container['client_id'] = $client_id;

        return $this;
    }

    /**
     * Gets title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->container['title'];
    }

    /**
     * Sets title
     *
     * @param string $title Title of the aggregate
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->container['title'] = $title;

        return $this;
    }

    /**
     * Gets result
     *
     * @return string
     */
    public function getResult()
    {
        return $this->container['result'];
    }

    /**
     * Sets result
     *
     * @param string $result The result of the aggregate calculation
     *
     * @return $this
     */
    public function setResult($result)
    {
        $this->container['result'] = $result;

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
     * Gets date_filter
     *
     * @return OneOfinlineResponse20055ContentDateFilter
     */
    public function getDateFilter()
    {
        return $this->container['date_filter'];
    }

    /**
     * Sets date_filter
     *
     * @param OneOfinlineResponse20055ContentDateFilter $date_filter Details of the date filter. The analysis results are calculated from data that matches the filter.
     *
     * @return $this
     */
    public function setDateFilter($date_filter)
    {
        $this->container['date_filter'] = $date_filter;

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
