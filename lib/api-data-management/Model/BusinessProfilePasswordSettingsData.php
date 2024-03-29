<?php
/**
 * BusinessProfilePasswordSettingsData
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
 * BusinessProfilePasswordSettingsData Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class BusinessProfilePasswordSettingsData implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'BusinessProfilePasswordSettingsData';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'attempts' => 'int',
'block' => 'int',
'business_profile_id' => 'int',
'different' => 'int',
'digits' => 'int',
'expiration' => 'int',
'lower_letters' => 'int',
'max_idle_time' => 'int',
'max_length' => 'int',
'min_length' => 'int',
'next_change' => 'int',
'special_chars' => 'int',
'upper_letters' => 'int'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'attempts' => 'int32',
'block' => 'int32',
'business_profile_id' => null,
'different' => 'int32',
'digits' => 'int32',
'expiration' => 'int32',
'lower_letters' => 'int32',
'max_idle_time' => 'int32',
'max_length' => 'int32',
'min_length' => 'int32',
'next_change' => 'int32',
'special_chars' => 'int32',
'upper_letters' => 'int32'    ];

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
        'attempts' => 'attempts',
'block' => 'block',
'business_profile_id' => 'businessProfileId',
'different' => 'different',
'digits' => 'digits',
'expiration' => 'expiration',
'lower_letters' => 'lowerLetters',
'max_idle_time' => 'maxIdleTime',
'max_length' => 'maxLength',
'min_length' => 'minLength',
'next_change' => 'nextChange',
'special_chars' => 'specialChars',
'upper_letters' => 'upperLetters'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'attempts' => 'setAttempts',
'block' => 'setBlock',
'business_profile_id' => 'setBusinessProfileId',
'different' => 'setDifferent',
'digits' => 'setDigits',
'expiration' => 'setExpiration',
'lower_letters' => 'setLowerLetters',
'max_idle_time' => 'setMaxIdleTime',
'max_length' => 'setMaxLength',
'min_length' => 'setMinLength',
'next_change' => 'setNextChange',
'special_chars' => 'setSpecialChars',
'upper_letters' => 'setUpperLetters'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'attempts' => 'getAttempts',
'block' => 'getBlock',
'business_profile_id' => 'getBusinessProfileId',
'different' => 'getDifferent',
'digits' => 'getDigits',
'expiration' => 'getExpiration',
'lower_letters' => 'getLowerLetters',
'max_idle_time' => 'getMaxIdleTime',
'max_length' => 'getMaxLength',
'min_length' => 'getMinLength',
'next_change' => 'getNextChange',
'special_chars' => 'getSpecialChars',
'upper_letters' => 'getUpperLetters'    ];

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
        $this->container['attempts'] = isset($data['attempts']) ? $data['attempts'] : null;
        $this->container['block'] = isset($data['block']) ? $data['block'] : null;
        $this->container['business_profile_id'] = isset($data['business_profile_id']) ? $data['business_profile_id'] : null;
        $this->container['different'] = isset($data['different']) ? $data['different'] : null;
        $this->container['digits'] = isset($data['digits']) ? $data['digits'] : null;
        $this->container['expiration'] = isset($data['expiration']) ? $data['expiration'] : null;
        $this->container['lower_letters'] = isset($data['lower_letters']) ? $data['lower_letters'] : null;
        $this->container['max_idle_time'] = isset($data['max_idle_time']) ? $data['max_idle_time'] : null;
        $this->container['max_length'] = isset($data['max_length']) ? $data['max_length'] : null;
        $this->container['min_length'] = isset($data['min_length']) ? $data['min_length'] : null;
        $this->container['next_change'] = isset($data['next_change']) ? $data['next_change'] : null;
        $this->container['special_chars'] = isset($data['special_chars']) ? $data['special_chars'] : null;
        $this->container['upper_letters'] = isset($data['upper_letters']) ? $data['upper_letters'] : null;
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
     * Gets attempts
     *
     * @return int
     */
    public function getAttempts()
    {
        return $this->container['attempts'];
    }

    /**
     * Sets attempts
     *
     * @param int $attempts The number of failed sign-in attempts after which an account is blocked
     *
     * @return $this
     */
    public function setAttempts($attempts)
    {
        $this->container['attempts'] = $attempts;

        return $this;
    }

    /**
     * Gets block
     *
     * @return int
     */
    public function getBlock()
    {
        return $this->container['block'];
    }

    /**
     * Sets block
     *
     * @param int $block The number of days after which an account is blocked after the password expires.
     *
     * @return $this
     */
    public function setBlock($block)
    {
        $this->container['block'] = $block;

        return $this;
    }

    /**
     * Gets business_profile_id
     *
     * @return int
     */
    public function getBusinessProfileId()
    {
        return $this->container['business_profile_id'];
    }

    /**
     * Sets business_profile_id
     *
     * @param int $business_profile_id Business Profile ID
     *
     * @return $this
     */
    public function setBusinessProfileId($business_profile_id)
    {
        $this->container['business_profile_id'] = $business_profile_id;

        return $this;
    }

    /**
     * Gets different
     *
     * @return int
     */
    public function getDifferent()
    {
        return $this->container['different'];
    }

    /**
     * Sets different
     *
     * @param int $different Defines how many previous passwords are compared.  For example, if set to 3, the new password must be different than the 3 last passwords.
     *
     * @return $this
     */
    public function setDifferent($different)
    {
        $this->container['different'] = $different;

        return $this;
    }

    /**
     * Gets digits
     *
     * @return int
     */
    public function getDigits()
    {
        return $this->container['digits'];
    }

    /**
     * Sets digits
     *
     * @param int $digits The minimum number of digits in a password
     *
     * @return $this
     */
    public function setDigits($digits)
    {
        $this->container['digits'] = $digits;

        return $this;
    }

    /**
     * Gets expiration
     *
     * @return int
     */
    public function getExpiration()
    {
        return $this->container['expiration'];
    }

    /**
     * Sets expiration
     *
     * @param int $expiration The number of days after which the passwords expire
     *
     * @return $this
     */
    public function setExpiration($expiration)
    {
        $this->container['expiration'] = $expiration;

        return $this;
    }

    /**
     * Gets lower_letters
     *
     * @return int
     */
    public function getLowerLetters()
    {
        return $this->container['lower_letters'];
    }

    /**
     * Sets lower_letters
     *
     * @param int $lower_letters The minimum number of lower-case letters in a password
     *
     * @return $this
     */
    public function setLowerLetters($lower_letters)
    {
        $this->container['lower_letters'] = $lower_letters;

        return $this;
    }

    /**
     * Gets max_idle_time
     *
     * @return int
     */
    public function getMaxIdleTime()
    {
        return $this->container['max_idle_time'];
    }

    /**
     * Sets max_idle_time
     *
     * @param int $max_idle_time Time (in seconds) after which an idle user is signed out
     *
     * @return $this
     */
    public function setMaxIdleTime($max_idle_time)
    {
        $this->container['max_idle_time'] = $max_idle_time;

        return $this;
    }

    /**
     * Gets max_length
     *
     * @return int
     */
    public function getMaxLength()
    {
        return $this->container['max_length'];
    }

    /**
     * Sets max_length
     *
     * @param int $max_length The maximum number of characters in a password
     *
     * @return $this
     */
    public function setMaxLength($max_length)
    {
        $this->container['max_length'] = $max_length;

        return $this;
    }

    /**
     * Gets min_length
     *
     * @return int
     */
    public function getMinLength()
    {
        return $this->container['min_length'];
    }

    /**
     * Sets min_length
     *
     * @param int $min_length The minimum number of characters in a password
     *
     * @return $this
     */
    public function setMinLength($min_length)
    {
        $this->container['min_length'] = $min_length;

        return $this;
    }

    /**
     * Gets next_change
     *
     * @return int
     */
    public function getNextChange()
    {
        return $this->container['next_change'];
    }

    /**
     * Sets next_change
     *
     * @param int $next_change Currently not used
     *
     * @return $this
     */
    public function setNextChange($next_change)
    {
        $this->container['next_change'] = $next_change;

        return $this;
    }

    /**
     * Gets special_chars
     *
     * @return int
     */
    public function getSpecialChars()
    {
        return $this->container['special_chars'];
    }

    /**
     * Sets special_chars
     *
     * @param int $special_chars The minimum number of special characters in a password
     *
     * @return $this
     */
    public function setSpecialChars($special_chars)
    {
        $this->container['special_chars'] = $special_chars;

        return $this;
    }

    /**
     * Gets upper_letters
     *
     * @return int
     */
    public function getUpperLetters()
    {
        return $this->container['upper_letters'];
    }

    /**
     * Sets upper_letters
     *
     * @param int $upper_letters The minimum number of upper-case letters in a password
     *
     * @return $this
     */
    public function setUpperLetters($upper_letters)
    {
        $this->container['upper_letters'] = $upper_letters;

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
