<?php
/**
 * V2authloginclientAttributes
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
 * V2authloginclientAttributes Class Doc Comment
 *
 * @category Class
 * @description This object contains custom attributes (with any names).  &lt;strong&gt;&lt;span style&#x3D;\&quot;color:red\&quot;&gt;WARNING&lt;span&gt;&lt;/strong&gt;: Some attributes are reserved and cannot be sent. If you send them, they are ignored.  &lt;details&gt;&lt;summary&gt;Click to expand the list of reserved attributes&lt;/summary&gt; &lt;code&gt;email&lt;/code&gt;&lt;br&gt;&lt;code&gt;clientId&lt;/code&gt;&lt;br&gt;&lt;code&gt;phone&lt;/code&gt;&lt;br&gt;&lt;code&gt;customId&lt;/code&gt;&lt;br&gt;&lt;code&gt;uuid&lt;/code&gt;&lt;br&gt;&lt;code&gt;firstName&lt;/code&gt;&lt;br&gt;&lt;code&gt;lastName&lt;/code&gt;&lt;br&gt;&lt;code&gt;displayName&lt;/code&gt;&lt;br&gt;&lt;code&gt;company&lt;/code&gt;&lt;br&gt;&lt;code&gt;address&lt;/code&gt;&lt;br&gt;&lt;code&gt;city&lt;/code&gt;&lt;br&gt;&lt;code&gt;province&lt;/code&gt;&lt;br&gt;&lt;code&gt;zipCode&lt;/code&gt;&lt;br&gt;&lt;code&gt;countryCode&lt;/code&gt;&lt;br&gt;&lt;code&gt;birthDate&lt;/code&gt;&lt;br&gt;&lt;code&gt;sex&lt;/code&gt;&lt;br&gt;&lt;code&gt;avatarUrl&lt;/code&gt;&lt;br&gt;&lt;code&gt;anonymous&lt;/code&gt;&lt;br&gt;&lt;code&gt;agreements&lt;/code&gt;&lt;br&gt;&lt;code&gt;tags&lt;/code&gt;&lt;br&gt;&lt;code&gt;businessProfileId&lt;/code&gt;&lt;br&gt;&lt;code&gt;time&lt;/code&gt;&lt;br&gt;&lt;code&gt;ip&lt;/code&gt;&lt;br&gt;&lt;code&gt;source&lt;/code&gt;&lt;br&gt;&lt;code&gt;newsletter_agreement&lt;/code&gt;&lt;br&gt;&lt;code&gt;custom_identify&lt;/code&gt;&lt;br&gt;&lt;code&gt;firstname&lt;/code&gt;&lt;br&gt;&lt;code&gt;lastname&lt;/code&gt;&lt;br&gt;&lt;code&gt;created&lt;/code&gt;&lt;br&gt;&lt;code&gt;updated&lt;/code&gt;&lt;br&gt;&lt;code&gt;last_activity_date&lt;/code&gt;&lt;br&gt;&lt;code&gt;birthdate&lt;/code&gt;&lt;br&gt;&lt;code&gt;external_avatar_url&lt;/code&gt;&lt;br&gt;&lt;code&gt;displayname&lt;/code&gt;&lt;br&gt;&lt;code&gt;receive_smses&lt;/code&gt;&lt;br&gt;&lt;code&gt;receive_push_messages&lt;/code&gt;&lt;br&gt;&lt;code&gt;receive_webpush_messages&lt;/code&gt;&lt;br&gt;&lt;code&gt;receive_btooth_messages&lt;/code&gt;&lt;br&gt;&lt;code&gt;receive_rfid_messages&lt;/code&gt;&lt;br&gt;&lt;code&gt;receive_wifi_messages&lt;/code&gt;&lt;br&gt;&lt;code&gt;confirmation_hash&lt;/code&gt;&lt;br&gt;&lt;code&gt;ownerId&lt;/code&gt;&lt;br&gt;&lt;code&gt;zipCode&lt;/code&gt;&lt;br&gt;&lt;code&gt;anonymous_type&lt;/code&gt;&lt;br&gt;&lt;code&gt;country_id&lt;/code&gt;&lt;br&gt;&lt;code&gt;geo_loc_city&lt;/code&gt;&lt;br&gt;&lt;code&gt;geo_loc_country&lt;/code&gt;&lt;br&gt;&lt;code&gt;geo_loc_as&lt;/code&gt;&lt;br&gt;&lt;code&gt;geo_loc_country_code&lt;/code&gt;&lt;br&gt;&lt;code&gt;geo_loc_isp&lt;/code&gt;&lt;br&gt;&lt;code&gt;geo_loc_lat&lt;/code&gt;&lt;br&gt;&lt;code&gt;geo_loc_lon&lt;/code&gt;&lt;br&gt;&lt;code&gt;geo_loc_org&lt;/code&gt;&lt;br&gt;&lt;code&gt;geo_loc_query&lt;/code&gt;&lt;br&gt;&lt;code&gt;geo_loc_region&lt;/code&gt;&lt;br&gt;&lt;code&gt;geo_loc_region_name&lt;/code&gt;&lt;br&gt;&lt;code&gt;geo_loc_status&lt;/code&gt;&lt;br&gt;&lt;code&gt;geo_loc_timezone&lt;/code&gt;&lt;br&gt;&lt;code&gt;geo_loc_zip&lt;/code&gt;&lt;br&gt;&lt;code&gt;club_card_id&lt;/code&gt;&lt;br&gt;&lt;code&gt;type&lt;/code&gt;&lt;br&gt;&lt;code&gt;confirmed&lt;/code&gt;&lt;br&gt;&lt;code&gt;facebookId&lt;/code&gt;&lt;br&gt;&lt;code&gt;status&lt;/code&gt; &lt;/details&gt;
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class V2authloginclientAttributes implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'v2authloginclient_attributes';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'property1' => 'string',
'property2' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'property1' => null,
'property2' => null    ];

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
        'property1' => 'property1',
'property2' => 'property2'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'property1' => 'setProperty1',
'property2' => 'setProperty2'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'property1' => 'getProperty1',
'property2' => 'getProperty2'    ];

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
        $this->container['property1'] = isset($data['property1']) ? $data['property1'] : null;
        $this->container['property2'] = isset($data['property2']) ? $data['property2'] : null;
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
     * Gets property1
     *
     * @return string
     */
    public function getProperty1()
    {
        return $this->container['property1'];
    }

    /**
     * Sets property1
     *
     * @param string $property1 Custom property
     *
     * @return $this
     */
    public function setProperty1($property1)
    {
        $this->container['property1'] = $property1;

        return $this;
    }

    /**
     * Gets property2
     *
     * @return string
     */
    public function getProperty2()
    {
        return $this->container['property2'];
    }

    /**
     * Sets property2
     *
     * @param string $property2 Custom property
     *
     * @return $this
     */
    public function setProperty2($property2)
    {
        $this->container['property2'] = $property2;

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
