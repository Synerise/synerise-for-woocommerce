<?php
/**
 * ManagedDomainResponse
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
 * ManagedDomainResponse Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ManagedDomainResponse implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'ManagedDomainResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'float',
'domain' => 'string',
'created' => '\DateTime',
'verification_method' => 'string',
'verification_status' => 'string',
'updated' => '\DateTime',
'managed_by_profile' => 'int',
'users_count' => 'float'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'id' => 'int64',
'domain' => null,
'created' => 'date-time',
'verification_method' => null,
'verification_status' => null,
'updated' => 'date-time',
'managed_by_profile' => null,
'users_count' => 'int64'    ];

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
        'id' => 'id',
'domain' => 'domain',
'created' => 'created',
'verification_method' => 'verificationMethod',
'verification_status' => 'verificationStatus',
'updated' => 'updated',
'managed_by_profile' => 'managedByProfile',
'users_count' => 'usersCount'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
'domain' => 'setDomain',
'created' => 'setCreated',
'verification_method' => 'setVerificationMethod',
'verification_status' => 'setVerificationStatus',
'updated' => 'setUpdated',
'managed_by_profile' => 'setManagedByProfile',
'users_count' => 'setUsersCount'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
'domain' => 'getDomain',
'created' => 'getCreated',
'verification_method' => 'getVerificationMethod',
'verification_status' => 'getVerificationStatus',
'updated' => 'getUpdated',
'managed_by_profile' => 'getManagedByProfile',
'users_count' => 'getUsersCount'    ];

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

    const VERIFICATION_METHOD_TXT_RECORD = 'TXT_RECORD';
const VERIFICATION_METHOD_FILE_CHECK = 'FILE_CHECK';
const VERIFICATION_METHOD_INTERNAL = 'INTERNAL';
const VERIFICATION_METHOD_NONE = 'NONE';
const VERIFICATION_STATUS_VERIFIED = 'VERIFIED';
const VERIFICATION_STATUS_NOT_VERIFIED = 'NOT_VERIFIED';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getVerificationMethodAllowableValues()
    {
        return [
            self::VERIFICATION_METHOD_TXT_RECORD,
self::VERIFICATION_METHOD_FILE_CHECK,
self::VERIFICATION_METHOD_INTERNAL,
self::VERIFICATION_METHOD_NONE,        ];
    }
    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getVerificationStatusAllowableValues()
    {
        return [
            self::VERIFICATION_STATUS_VERIFIED,
self::VERIFICATION_STATUS_NOT_VERIFIED,        ];
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
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['domain'] = isset($data['domain']) ? $data['domain'] : null;
        $this->container['created'] = isset($data['created']) ? $data['created'] : null;
        $this->container['verification_method'] = isset($data['verification_method']) ? $data['verification_method'] : null;
        $this->container['verification_status'] = isset($data['verification_status']) ? $data['verification_status'] : null;
        $this->container['updated'] = isset($data['updated']) ? $data['updated'] : null;
        $this->container['managed_by_profile'] = isset($data['managed_by_profile']) ? $data['managed_by_profile'] : null;
        $this->container['users_count'] = isset($data['users_count']) ? $data['users_count'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getVerificationMethodAllowableValues();
        if (!is_null($this->container['verification_method']) && !in_array($this->container['verification_method'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'verification_method', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        $allowedValues = $this->getVerificationStatusAllowableValues();
        if (!is_null($this->container['verification_status']) && !in_array($this->container['verification_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'verification_status', must be one of '%s'",
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
     * Gets id
     *
     * @return float
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param float $id ID of the managed domain
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets domain
     *
     * @return string
     */
    public function getDomain()
    {
        return $this->container['domain'];
    }

    /**
     * Sets domain
     *
     * @param string $domain Domain name
     *
     * @return $this
     */
    public function setDomain($domain)
    {
        $this->container['domain'] = $domain;

        return $this;
    }

    /**
     * Gets created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->container['created'];
    }

    /**
     * Sets created
     *
     * @param \DateTime $created Creation time
     *
     * @return $this
     */
    public function setCreated($created)
    {
        $this->container['created'] = $created;

        return $this;
    }

    /**
     * Gets verification_method
     *
     * @return string
     */
    public function getVerificationMethod()
    {
        return $this->container['verification_method'];
    }

    /**
     * Sets verification_method
     *
     * @param string $verification_method Verification method. The verification string can be retrieved by using [this method](#operation/initializeManagedDomainUsingPOST).  - TXT_RECORD: the verification string needs to be added to your DNS as a TXT record. - FILE_CHECK: the site must include an HTML file whose name is the verification string. The file does not need any content. - INTERNAL; NONE - currently not used
     *
     * @return $this
     */
    public function setVerificationMethod($verification_method)
    {
        $allowedValues = $this->getVerificationMethodAllowableValues();
        if (!is_null($verification_method) && !in_array($verification_method, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'verification_method', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['verification_method'] = $verification_method;

        return $this;
    }

    /**
     * Gets verification_status
     *
     * @return string
     */
    public function getVerificationStatus()
    {
        return $this->container['verification_status'];
    }

    /**
     * Sets verification_status
     *
     * @param string $verification_status Verification status
     *
     * @return $this
     */
    public function setVerificationStatus($verification_status)
    {
        $allowedValues = $this->getVerificationStatusAllowableValues();
        if (!is_null($verification_status) && !in_array($verification_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'verification_status', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['verification_status'] = $verification_status;

        return $this;
    }

    /**
     * Gets updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->container['updated'];
    }

    /**
     * Sets updated
     *
     * @param \DateTime $updated Time of last update
     *
     * @return $this
     */
    public function setUpdated($updated)
    {
        $this->container['updated'] = $updated;

        return $this;
    }

    /**
     * Gets managed_by_profile
     *
     * @return int
     */
    public function getManagedByProfile()
    {
        return $this->container['managed_by_profile'];
    }

    /**
     * Sets managed_by_profile
     *
     * @param int $managed_by_profile Business Profile ID
     *
     * @return $this
     */
    public function setManagedByProfile($managed_by_profile)
    {
        $this->container['managed_by_profile'] = $managed_by_profile;

        return $this;
    }

    /**
     * Gets users_count
     *
     * @return float
     */
    public function getUsersCount()
    {
        return $this->container['users_count'];
    }

    /**
     * Sets users_count
     *
     * @param float $users_count Number of users who belong to the domain
     *
     * @return $this
     */
    public function setUsersCount($users_count)
    {
        $this->container['users_count'] = $users_count;

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
