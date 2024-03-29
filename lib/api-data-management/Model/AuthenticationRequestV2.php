<?php
/**
 * AuthenticationRequestV2
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
 * AuthenticationRequestV2 Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class AuthenticationRequestV2 implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'AuthenticationRequestV2';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'api_key' => 'string',
'identity_provider' => 'string',
'identity_provider_token' => 'string',
'email' => 'string',
'custom_id' => '',
'password' => 'string',
'uuid' => 'string',
'device_id' => 'string',
'agreements' => '\Synerise\DataManagement\Model\V2authloginclientAgreements',
'attributes' => '\Synerise\DataManagement\Model\V2authloginclientAttributes',
'tags' => 'string[]'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'api_key' => null,
'identity_provider' => null,
'identity_provider_token' => null,
'email' => null,
'custom_id' => null,
'password' => null,
'uuid' => null,
'device_id' => null,
'agreements' => null,
'attributes' => null,
'tags' => null    ];

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
        'api_key' => 'apiKey',
'identity_provider' => 'identityProvider',
'identity_provider_token' => 'identityProviderToken',
'email' => 'email',
'custom_id' => 'customId',
'password' => 'password',
'uuid' => 'uuid',
'device_id' => 'deviceId',
'agreements' => 'agreements',
'attributes' => 'attributes',
'tags' => 'tags'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'api_key' => 'setApiKey',
'identity_provider' => 'setIdentityProvider',
'identity_provider_token' => 'setIdentityProviderToken',
'email' => 'setEmail',
'custom_id' => 'setCustomId',
'password' => 'setPassword',
'uuid' => 'setUuid',
'device_id' => 'setDeviceId',
'agreements' => 'setAgreements',
'attributes' => 'setAttributes',
'tags' => 'setTags'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'api_key' => 'getApiKey',
'identity_provider' => 'getIdentityProvider',
'identity_provider_token' => 'getIdentityProviderToken',
'email' => 'getEmail',
'custom_id' => 'getCustomId',
'password' => 'getPassword',
'uuid' => 'getUuid',
'device_id' => 'getDeviceId',
'agreements' => 'getAgreements',
'attributes' => 'getAttributes',
'tags' => 'getTags'    ];

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

    const IDENTITY_PROVIDER_SYNERISE = 'SYNERISE';
const IDENTITY_PROVIDER_FACEBOOK = 'FACEBOOK';
const IDENTITY_PROVIDER_OAUTH = 'OAUTH';
const IDENTITY_PROVIDER_APPLE = 'APPLE';
const IDENTITY_PROVIDER_GOOGLE = 'GOOGLE';
const IDENTITY_PROVIDER_UNKNOWN = 'UNKNOWN';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getIdentityProviderAllowableValues()
    {
        return [
            self::IDENTITY_PROVIDER_SYNERISE,
self::IDENTITY_PROVIDER_FACEBOOK,
self::IDENTITY_PROVIDER_OAUTH,
self::IDENTITY_PROVIDER_APPLE,
self::IDENTITY_PROVIDER_GOOGLE,
self::IDENTITY_PROVIDER_UNKNOWN,        ];
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
        $this->container['api_key'] = isset($data['api_key']) ? $data['api_key'] : null;
        $this->container['identity_provider'] = isset($data['identity_provider']) ? $data['identity_provider'] : null;
        $this->container['identity_provider_token'] = isset($data['identity_provider_token']) ? $data['identity_provider_token'] : null;
        $this->container['email'] = isset($data['email']) ? $data['email'] : null;
        $this->container['custom_id'] = isset($data['custom_id']) ? $data['custom_id'] : null;
        $this->container['password'] = isset($data['password']) ? $data['password'] : null;
        $this->container['uuid'] = isset($data['uuid']) ? $data['uuid'] : null;
        $this->container['device_id'] = isset($data['device_id']) ? $data['device_id'] : null;
        $this->container['agreements'] = isset($data['agreements']) ? $data['agreements'] : null;
        $this->container['attributes'] = isset($data['attributes']) ? $data['attributes'] : null;
        $this->container['tags'] = isset($data['tags']) ? $data['tags'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['api_key'] === null) {
            $invalidProperties[] = "'api_key' can't be null";
        }
        if ($this->container['identity_provider'] === null) {
            $invalidProperties[] = "'identity_provider' can't be null";
        }
        $allowedValues = $this->getIdentityProviderAllowableValues();
        if (!is_null($this->container['identity_provider']) && !in_array($this->container['identity_provider'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'identity_provider', must be one of '%s'",
                implode("', '", $allowedValues)
            );
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
     * Gets api_key
     *
     * @return string
     */
    public function getApiKey()
    {
        return $this->container['api_key'];
    }

    /**
     * Sets api_key
     *
     * @param string $api_key Client API key
     *
     * @return $this
     */
    public function setApiKey($api_key)
    {
        $this->container['api_key'] = $api_key;

        return $this;
    }

    /**
     * Gets identity_provider
     *
     * @return string
     */
    public function getIdentityProvider()
    {
        return $this->container['identity_provider'];
    }

    /**
     * Sets identity_provider
     *
     * @param string $identity_provider The identity provider.
     *
     * @return $this
     */
    public function setIdentityProvider($identity_provider)
    {
        $allowedValues = $this->getIdentityProviderAllowableValues();
        if (!in_array($identity_provider, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'identity_provider', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['identity_provider'] = $identity_provider;

        return $this;
    }

    /**
     * Gets identity_provider_token
     *
     * @return string
     */
    public function getIdentityProviderToken()
    {
        return $this->container['identity_provider_token'];
    }

    /**
     * Sets identity_provider_token
     *
     * @param string $identity_provider_token Third-party authentication token used to authenticate with the Identity Provider. Required if `identityProvider` is different than `SYNERISE`.
     *
     * @return $this
     */
    public function setIdentityProviderToken($identity_provider_token)
    {
        $this->container['identity_provider_token'] = $identity_provider_token;

        return $this;
    }

    /**
     * Gets email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param string $email Client email. Required if `identityProvider` is `SYNERISE` and email is the unique identifier (default setting).
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets custom_id
     *
     * @return 
     */
    public function getCustomId()
    {
        return $this->container['custom_id'];
    }

    /**
     * Sets custom_id
     *
     * @param  $custom_id Client customId. Required if `identityProvider` is `SYNERISE` and customId is the unique identifier (see https://help.synerise.com/docs/settings/configuration/non-unique-emails/).
     *
     * @return $this
     */
    public function setCustomId($custom_id)
    {
        $this->container['custom_id'] = $custom_id;

        return $this;
    }

    /**
     * Gets password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->container['password'];
    }

    /**
     * Sets password
     *
     * @param string $password Client password. Required if `identityProvider` is `SYNERISE`.
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->container['password'] = $password;

        return $this;
    }

    /**
     * Gets uuid
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->container['uuid'];
    }

    /**
     * Sets uuid
     *
     * @param string $uuid Client UUID. Required if `identityProvider` is `SYNERISE`.
     *
     * @return $this
     */
    public function setUuid($uuid)
    {
        $this->container['uuid'] = $uuid;

        return $this;
    }

    /**
     * Gets device_id
     *
     * @return string
     */
    public function getDeviceId()
    {
        return $this->container['device_id'];
    }

    /**
     * Sets device_id
     *
     * @param string $device_id Unique Android or iOS device ID
     *
     * @return $this
     */
    public function setDeviceId($device_id)
    {
        $this->container['device_id'] = $device_id;

        return $this;
    }

    /**
     * Gets agreements
     *
     * @return \Synerise\DataManagement\Model\V2authloginclientAgreements
     */
    public function getAgreements()
    {
        return $this->container['agreements'];
    }

    /**
     * Sets agreements
     *
     * @param \Synerise\DataManagement\Model\V2authloginclientAgreements $agreements agreements
     *
     * @return $this
     */
    public function setAgreements($agreements)
    {
        $this->container['agreements'] = $agreements;

        return $this;
    }

    /**
     * Gets attributes
     *
     * @return \Synerise\DataManagement\Model\V2authloginclientAttributes
     */
    public function getAttributes()
    {
        return $this->container['attributes'];
    }

    /**
     * Sets attributes
     *
     * @param \Synerise\DataManagement\Model\V2authloginclientAttributes $attributes attributes
     *
     * @return $this
     */
    public function setAttributes($attributes)
    {
        $this->container['attributes'] = $attributes;

        return $this;
    }

    /**
     * Gets tags
     *
     * @return string[]
     */
    public function getTags()
    {
        return $this->container['tags'];
    }

    /**
     * Sets tags
     *
     * @param string[] $tags Tags can be used to group Client accounts.
     *
     * @return $this
     */
    public function setTags($tags)
    {
        $this->container['tags'] = $tags;

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
