<?php
/**
 * ObjectPermissionWhitelistEntryData
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
 * ObjectPermissionWhitelistEntryData Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ObjectPermissionWhitelistEntryData implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'ObjectPermissionWhitelistEntryData';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'consumer' => '\Synerise\DataManagement\Model\AccessConsumer',
'delete' => 'bool',
'execute' => 'bool',
'read' => 'bool',
'update' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'consumer' => null,
'delete' => null,
'execute' => null,
'read' => null,
'update' => null    ];

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
        'consumer' => 'consumer',
'delete' => 'delete',
'execute' => 'execute',
'read' => 'read',
'update' => 'update'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'consumer' => 'setConsumer',
'delete' => 'setDelete',
'execute' => 'setExecute',
'read' => 'setRead',
'update' => 'setUpdate'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'consumer' => 'getConsumer',
'delete' => 'getDelete',
'execute' => 'getExecute',
'read' => 'getRead',
'update' => 'getUpdate'    ];

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
        $this->container['consumer'] = isset($data['consumer']) ? $data['consumer'] : null;
        $this->container['delete'] = isset($data['delete']) ? $data['delete'] : null;
        $this->container['execute'] = isset($data['execute']) ? $data['execute'] : null;
        $this->container['read'] = isset($data['read']) ? $data['read'] : null;
        $this->container['update'] = isset($data['update']) ? $data['update'] : null;
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
     * Gets consumer
     *
     * @return \Synerise\DataManagement\Model\AccessConsumer
     */
    public function getConsumer()
    {
        return $this->container['consumer'];
    }

    /**
     * Sets consumer
     *
     * @param \Synerise\DataManagement\Model\AccessConsumer $consumer consumer
     *
     * @return $this
     */
    public function setConsumer($consumer)
    {
        $this->container['consumer'] = $consumer;

        return $this;
    }

    /**
     * Gets delete
     *
     * @return bool
     */
    public function getDelete()
    {
        return $this->container['delete'];
    }

    /**
     * Sets delete
     *
     * @param bool $delete delete
     *
     * @return $this
     */
    public function setDelete($delete)
    {
        $this->container['delete'] = $delete;

        return $this;
    }

    /**
     * Gets execute
     *
     * @return bool
     */
    public function getExecute()
    {
        return $this->container['execute'];
    }

    /**
     * Sets execute
     *
     * @param bool $execute execute
     *
     * @return $this
     */
    public function setExecute($execute)
    {
        $this->container['execute'] = $execute;

        return $this;
    }

    /**
     * Gets read
     *
     * @return bool
     */
    public function getRead()
    {
        return $this->container['read'];
    }

    /**
     * Sets read
     *
     * @param bool $read read
     *
     * @return $this
     */
    public function setRead($read)
    {
        $this->container['read'] = $read;

        return $this;
    }

    /**
     * Gets update
     *
     * @return bool
     */
    public function getUpdate()
    {
        return $this->container['update'];
    }

    /**
     * Sets update
     *
     * @param bool $update update
     *
     * @return $this
     */
    public function setUpdate($update)
    {
        $this->container['update'] = $update;

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
