<?php
/**
 * ClientIdPreviewBody1
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
 * ClientIdPreviewBody1 Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ClientIdPreviewBody1 implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'clientId_preview_body_1';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'aggregate' => '\Synerise\DataManagement\Model\Aggregate',
'is_visible_for_client_profile' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'aggregate' => null,
'is_visible_for_client_profile' => null    ];

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
        'aggregate' => 'aggregate',
'is_visible_for_client_profile' => 'isVisibleForClientProfile'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'aggregate' => 'setAggregate',
'is_visible_for_client_profile' => 'setIsVisibleForClientProfile'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'aggregate' => 'getAggregate',
'is_visible_for_client_profile' => 'getIsVisibleForClientProfile'    ];

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
        $this->container['aggregate'] = isset($data['aggregate']) ? $data['aggregate'] : null;
        $this->container['is_visible_for_client_profile'] = isset($data['is_visible_for_client_profile']) ? $data['is_visible_for_client_profile'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['aggregate'] === null) {
            $invalidProperties[] = "'aggregate' can't be null";
        }
        if ($this->container['is_visible_for_client_profile'] === null) {
            $invalidProperties[] = "'is_visible_for_client_profile' can't be null";
        }
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
     * Gets aggregate
     *
     * @return \Synerise\DataManagement\Model\Aggregate
     */
    public function getAggregate()
    {
        return $this->container['aggregate'];
    }

    /**
     * Sets aggregate
     *
     * @param \Synerise\DataManagement\Model\Aggregate $aggregate aggregate
     *
     * @return $this
     */
    public function setAggregate($aggregate)
    {
        $this->container['aggregate'] = $aggregate;

        return $this;
    }

    /**
     * Gets is_visible_for_client_profile
     *
     * @return bool
     */
    public function getIsVisibleForClientProfile()
    {
        return $this->container['is_visible_for_client_profile'];
    }

    /**
     * Sets is_visible_for_client_profile
     *
     * @param bool $is_visible_for_client_profile When set to `true`, information about this analysis can be shown in a customer's card. In the Synerise CRM, only aggregates, segmentations, and expressions can be shown.
     *
     * @return $this
     */
    public function setIsVisibleForClientProfile($is_visible_for_client_profile)
    {
        $this->container['is_visible_for_client_profile'] = $is_visible_for_client_profile;

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
    #[\ReturnTypeWillChange]
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
    #[\ReturnTypeWillChange]
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
    #[\ReturnTypeWillChange]
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
