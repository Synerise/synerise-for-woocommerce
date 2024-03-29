<?php
/**
 * CompanyclientsClientIdBody
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
 * CompanyclientsClientIdBody Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class CompanyclientsClientIdBody implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'companyclients_clientId_body';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'int',
'uuid' => 'string',
'anonymous_type' => 'string',
'email' => 'string',
'firstname' => 'string',
'last_name' => 'string',
'custom_identify' => 'string',
'company' => 'string',
'phone' => 'string',
'address' => 'string',
'birthdate' => 'string',
'city' => 'string',
'zip_code' => 'string',
'province' => 'string',
'country_id' => 'string',
'country_code' => 'string',
'avatar_url' => 'string',
'sex' => 'string',
'last_activity_date' => '\DateTime',
'created' => '\DateTime',
'updated' => '\DateTime',
'deleted_at' => '\DateTime',
'tags' => 'string[]'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'id' => null,
'uuid' => null,
'anonymous_type' => null,
'email' => null,
'firstname' => null,
'last_name' => null,
'custom_identify' => null,
'company' => null,
'phone' => null,
'address' => null,
'birthdate' => null,
'city' => null,
'zip_code' => null,
'province' => null,
'country_id' => null,
'country_code' => null,
'avatar_url' => null,
'sex' => null,
'last_activity_date' => 'date',
'created' => 'date',
'updated' => 'date',
'deleted_at' => 'date',
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
        'id' => 'id',
'uuid' => 'uuid',
'anonymous_type' => 'anonymous_type',
'email' => 'email',
'firstname' => 'firstname',
'last_name' => 'lastName',
'custom_identify' => 'custom_identify',
'company' => 'company',
'phone' => 'phone',
'address' => 'address',
'birthdate' => 'birthdate',
'city' => 'city',
'zip_code' => 'zipCode',
'province' => 'province',
'country_id' => 'country_id',
'country_code' => 'countryCode',
'avatar_url' => 'avatarUrl',
'sex' => 'sex',
'last_activity_date' => 'last_activity_date',
'created' => 'created',
'updated' => 'updated',
'deleted_at' => 'deletedAt',
'tags' => 'tags'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
'uuid' => 'setUuid',
'anonymous_type' => 'setAnonymousType',
'email' => 'setEmail',
'firstname' => 'setFirstname',
'last_name' => 'setLastName',
'custom_identify' => 'setCustomIdentify',
'company' => 'setCompany',
'phone' => 'setPhone',
'address' => 'setAddress',
'birthdate' => 'setBirthdate',
'city' => 'setCity',
'zip_code' => 'setZipCode',
'province' => 'setProvince',
'country_id' => 'setCountryId',
'country_code' => 'setCountryCode',
'avatar_url' => 'setAvatarUrl',
'sex' => 'setSex',
'last_activity_date' => 'setLastActivityDate',
'created' => 'setCreated',
'updated' => 'setUpdated',
'deleted_at' => 'setDeletedAt',
'tags' => 'setTags'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
'uuid' => 'getUuid',
'anonymous_type' => 'getAnonymousType',
'email' => 'getEmail',
'firstname' => 'getFirstname',
'last_name' => 'getLastName',
'custom_identify' => 'getCustomIdentify',
'company' => 'getCompany',
'phone' => 'getPhone',
'address' => 'getAddress',
'birthdate' => 'getBirthdate',
'city' => 'getCity',
'zip_code' => 'getZipCode',
'province' => 'getProvince',
'country_id' => 'getCountryId',
'country_code' => 'getCountryCode',
'avatar_url' => 'getAvatarUrl',
'sex' => 'getSex',
'last_activity_date' => 'getLastActivityDate',
'created' => 'getCreated',
'updated' => 'getUpdated',
'deleted_at' => 'getDeletedAt',
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

    const SEX_FEMALE = 'FEMALE';
const SEX_MALE = 'MALE';
const SEX_UNDEFINED = 'UNDEFINED';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getSexAllowableValues()
    {
        return [
            self::SEX_FEMALE,
self::SEX_MALE,
self::SEX_UNDEFINED,        ];
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
        $this->container['uuid'] = isset($data['uuid']) ? $data['uuid'] : null;
        $this->container['anonymous_type'] = isset($data['anonymous_type']) ? $data['anonymous_type'] : null;
        $this->container['email'] = isset($data['email']) ? $data['email'] : null;
        $this->container['firstname'] = isset($data['firstname']) ? $data['firstname'] : null;
        $this->container['last_name'] = isset($data['last_name']) ? $data['last_name'] : null;
        $this->container['custom_identify'] = isset($data['custom_identify']) ? $data['custom_identify'] : null;
        $this->container['company'] = isset($data['company']) ? $data['company'] : null;
        $this->container['phone'] = isset($data['phone']) ? $data['phone'] : null;
        $this->container['address'] = isset($data['address']) ? $data['address'] : null;
        $this->container['birthdate'] = isset($data['birthdate']) ? $data['birthdate'] : null;
        $this->container['city'] = isset($data['city']) ? $data['city'] : null;
        $this->container['zip_code'] = isset($data['zip_code']) ? $data['zip_code'] : null;
        $this->container['province'] = isset($data['province']) ? $data['province'] : null;
        $this->container['country_id'] = isset($data['country_id']) ? $data['country_id'] : null;
        $this->container['country_code'] = isset($data['country_code']) ? $data['country_code'] : null;
        $this->container['avatar_url'] = isset($data['avatar_url']) ? $data['avatar_url'] : null;
        $this->container['sex'] = isset($data['sex']) ? $data['sex'] : null;
        $this->container['last_activity_date'] = isset($data['last_activity_date']) ? $data['last_activity_date'] : null;
        $this->container['created'] = isset($data['created']) ? $data['created'] : null;
        $this->container['updated'] = isset($data['updated']) ? $data['updated'] : null;
        $this->container['deleted_at'] = isset($data['deleted_at']) ? $data['deleted_at'] : null;
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

        $allowedValues = $this->getSexAllowableValues();
        if (!is_null($this->container['sex']) && !in_array($this->container['sex'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'sex', must be one of '%s'",
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
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int $id ID of the Client
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

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
     * @param string $uuid UUID of the Client
     *
     * @return $this
     */
    public function setUuid($uuid)
    {
        $this->container['uuid'] = $uuid;

        return $this;
    }

    /**
     * Gets anonymous_type
     *
     * @return string
     */
    public function getAnonymousType()
    {
        return $this->container['anonymous_type'];
    }

    /**
     * Sets anonymous_type
     *
     * @param string $anonymous_type If the Client is anonymous, this field defines how they are identified
     *
     * @return $this
     */
    public function setAnonymousType($anonymous_type)
    {
        $this->container['anonymous_type'] = $anonymous_type;

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
     * @param string $email Client's e-mail address
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->container['firstname'];
    }

    /**
     * Sets firstname
     *
     * @param string $firstname Client's first name
     *
     * @return $this
     */
    public function setFirstname($firstname)
    {
        $this->container['firstname'] = $firstname;

        return $this;
    }

    /**
     * Gets last_name
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->container['last_name'];
    }

    /**
     * Sets last_name
     *
     * @param string $last_name Client's last name
     *
     * @return $this
     */
    public function setLastName($last_name)
    {
        $this->container['last_name'] = $last_name;

        return $this;
    }

    /**
     * Gets custom_identify
     *
     * @return string
     */
    public function getCustomIdentify()
    {
        return $this->container['custom_identify'];
    }

    /**
     * Sets custom_identify
     *
     * @param string $custom_identify A custom ID for the Client
     *
     * @return $this
     */
    public function setCustomIdentify($custom_identify)
    {
        $this->container['custom_identify'] = $custom_identify;

        return $this;
    }

    /**
     * Gets company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->container['company'];
    }

    /**
     * Sets company
     *
     * @param string $company Client's company
     *
     * @return $this
     */
    public function setCompany($company)
    {
        $this->container['company'] = $company;

        return $this;
    }

    /**
     * Gets phone
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->container['phone'];
    }

    /**
     * Sets phone
     *
     * @param string $phone Client's phone number
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->container['phone'] = $phone;

        return $this;
    }

    /**
     * Gets address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->container['address'];
    }

    /**
     * Sets address
     *
     * @param string $address Client's street address
     *
     * @return $this
     */
    public function setAddress($address)
    {
        $this->container['address'] = $address;

        return $this;
    }

    /**
     * Gets birthdate
     *
     * @return string
     */
    public function getBirthdate()
    {
        return $this->container['birthdate'];
    }

    /**
     * Sets birthdate
     *
     * @param string $birthdate Client's date of birth
     *
     * @return $this
     */
    public function setBirthdate($birthdate)
    {
        $this->container['birthdate'] = $birthdate;

        return $this;
    }

    /**
     * Gets city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->container['city'];
    }

    /**
     * Sets city
     *
     * @param string $city Client's city of residence
     *
     * @return $this
     */
    public function setCity($city)
    {
        $this->container['city'] = $city;

        return $this;
    }

    /**
     * Gets zip_code
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->container['zip_code'];
    }

    /**
     * Sets zip_code
     *
     * @param string $zip_code Client's zip code
     *
     * @return $this
     */
    public function setZipCode($zip_code)
    {
        $this->container['zip_code'] = $zip_code;

        return $this;
    }

    /**
     * Gets province
     *
     * @return string
     */
    public function getProvince()
    {
        return $this->container['province'];
    }

    /**
     * Sets province
     *
     * @param string $province Client's province of residence
     *
     * @return $this
     */
    public function setProvince($province)
    {
        $this->container['province'] = $province;

        return $this;
    }

    /**
     * Gets country_id
     *
     * @return string
     */
    public function getCountryId()
    {
        return $this->container['country_id'];
    }

    /**
     * Sets country_id
     *
     * @param string $country_id ID of the Client's country of residence
     *
     * @return $this
     */
    public function setCountryId($country_id)
    {
        $this->container['country_id'] = $country_id;

        return $this;
    }

    /**
     * Gets country_code
     *
     * @return string
     */
    public function getCountryCode()
    {
        return $this->container['country_code'];
    }

    /**
     * Sets country_code
     *
     * @param string $country_code Code of Client's country of residence
     *
     * @return $this
     */
    public function setCountryCode($country_code)
    {
        $this->container['country_code'] = $country_code;

        return $this;
    }

    /**
     * Gets avatar_url
     *
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->container['avatar_url'];
    }

    /**
     * Sets avatar_url
     *
     * @param string $avatar_url URL of the Client's avatar picture
     *
     * @return $this
     */
    public function setAvatarUrl($avatar_url)
    {
        $this->container['avatar_url'] = $avatar_url;

        return $this;
    }

    /**
     * Gets sex
     *
     * @return string
     */
    public function getSex()
    {
        return $this->container['sex'];
    }

    /**
     * Sets sex
     *
     * @param string $sex Client's sex
     *
     * @return $this
     */
    public function setSex($sex)
    {
        $allowedValues = $this->getSexAllowableValues();
        if (!is_null($sex) && !in_array($sex, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'sex', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['sex'] = $sex;

        return $this;
    }

    /**
     * Gets last_activity_date
     *
     * @return \DateTime
     */
    public function getLastActivityDate()
    {
        return $this->container['last_activity_date'];
    }

    /**
     * Sets last_activity_date
     *
     * @param \DateTime $last_activity_date Date of Client's last activity
     *
     * @return $this
     */
    public function setLastActivityDate($last_activity_date)
    {
        $this->container['last_activity_date'] = $last_activity_date;

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
     * @param \DateTime $created Date when the Client's CRM profile was created
     *
     * @return $this
     */
    public function setCreated($created)
    {
        $this->container['created'] = $created;

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
     * @param \DateTime $updated Date when the Client account was last updated
     *
     * @return $this
     */
    public function setUpdated($updated)
    {
        $this->container['updated'] = $updated;

        return $this;
    }

    /**
     * Gets deleted_at
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->container['deleted_at'];
    }

    /**
     * Sets deleted_at
     *
     * @param \DateTime $deleted_at Date when the Client account was deleted
     *
     * @return $this
     */
    public function setDeletedAt($deleted_at)
    {
        $this->container['deleted_at'] = $deleted_at;

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
     * @param string[] $tags Custom tags. They can be used, for example, to group Client accounts.
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
