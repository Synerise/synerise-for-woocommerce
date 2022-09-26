<?php
/**
 * ClientsBody
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
 * ClientsBody Class Doc Comment
 *
 * @category Class
 * @description You must provide at least one of the following parameters in a Client profile: &#x60;email&#x60;, &#x60;phone&#x60;, &#x60;uuid&#x60;, or &#x60;customId&#x60;.
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ClientsBody implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'clients_body';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'email' => 'string',
'phone' => 'string',
'custom_id' => 'string',
'first_name' => 'string',
'last_name' => 'string',
'display_name' => 'string',
'uuid' => 'string',
'avatar_url' => 'string',
'birth_date' => 'string',
'company' => 'string',
'city' => 'string',
'address' => 'string',
'zip_code' => 'string',
'province' => 'string',
'country_code' => 'string',
'sex' => 'string',
'agreements' => '\Synerise\DataManagement\Model\V2authloginclientAgreements',
'attributes' => '\Synerise\DataManagement\Model\V2authloginclientAttributes',
'tags' => 'string[]'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'email' => null,
'phone' => null,
'custom_id' => null,
'first_name' => null,
'last_name' => null,
'display_name' => null,
'uuid' => null,
'avatar_url' => null,
'birth_date' => null,
'company' => null,
'city' => null,
'address' => null,
'zip_code' => null,
'province' => null,
'country_code' => null,
'sex' => null,
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
        'email' => 'email',
'phone' => 'phone',
'custom_id' => 'customId',
'first_name' => 'firstName',
'last_name' => 'lastName',
'display_name' => 'displayName',
'uuid' => 'uuid',
'avatar_url' => 'avatarUrl',
'birth_date' => 'birthDate',
'company' => 'company',
'city' => 'city',
'address' => 'address',
'zip_code' => 'zipCode',
'province' => 'province',
'country_code' => 'countryCode',
'sex' => 'sex',
'agreements' => 'agreements',
'attributes' => 'attributes',
'tags' => 'tags'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'email' => 'setEmail',
'phone' => 'setPhone',
'custom_id' => 'setCustomId',
'first_name' => 'setFirstName',
'last_name' => 'setLastName',
'display_name' => 'setDisplayName',
'uuid' => 'setUuid',
'avatar_url' => 'setAvatarUrl',
'birth_date' => 'setBirthDate',
'company' => 'setCompany',
'city' => 'setCity',
'address' => 'setAddress',
'zip_code' => 'setZipCode',
'province' => 'setProvince',
'country_code' => 'setCountryCode',
'sex' => 'setSex',
'agreements' => 'setAgreements',
'attributes' => 'setAttributes',
'tags' => 'setTags'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'email' => 'getEmail',
'phone' => 'getPhone',
'custom_id' => 'getCustomId',
'first_name' => 'getFirstName',
'last_name' => 'getLastName',
'display_name' => 'getDisplayName',
'uuid' => 'getUuid',
'avatar_url' => 'getAvatarUrl',
'birth_date' => 'getBirthDate',
'company' => 'getCompany',
'city' => 'getCity',
'address' => 'getAddress',
'zip_code' => 'getZipCode',
'province' => 'getProvince',
'country_code' => 'getCountryCode',
'sex' => 'getSex',
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

    const SEX_FEMALE = 'FEMALE';
const SEX_MALE = 'MALE';
const SEX_NOT_SPECIFIED = 'NOT_SPECIFIED';
const SEX_OTHER = 'OTHER';

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
self::SEX_NOT_SPECIFIED,
self::SEX_OTHER,        ];
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
        $this->container['email'] = isset($data['email']) ? $data['email'] : null;
        $this->container['phone'] = isset($data['phone']) ? $data['phone'] : null;
        $this->container['custom_id'] = isset($data['custom_id']) ? $data['custom_id'] : null;
        $this->container['first_name'] = isset($data['first_name']) ? $data['first_name'] : null;
        $this->container['last_name'] = isset($data['last_name']) ? $data['last_name'] : null;
        $this->container['display_name'] = isset($data['display_name']) ? $data['display_name'] : null;
        $this->container['uuid'] = isset($data['uuid']) ? $data['uuid'] : null;
        $this->container['avatar_url'] = isset($data['avatar_url']) ? $data['avatar_url'] : null;
        $this->container['birth_date'] = isset($data['birth_date']) ? $data['birth_date'] : null;
        $this->container['company'] = isset($data['company']) ? $data['company'] : null;
        $this->container['city'] = isset($data['city']) ? $data['city'] : null;
        $this->container['address'] = isset($data['address']) ? $data['address'] : null;
        $this->container['zip_code'] = isset($data['zip_code']) ? $data['zip_code'] : null;
        $this->container['province'] = isset($data['province']) ? $data['province'] : null;
        $this->container['country_code'] = isset($data['country_code']) ? $data['country_code'] : null;
        $this->container['sex'] = isset($data['sex']) ? $data['sex'] : null;
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
     * @param string $phone Phone number of the client. Can only include digits, spaces, and an optional `+` at the beginning
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->container['phone'] = $phone;

        return $this;
    }

    /**
     * Gets custom_id
     *
     * @return string
     */
    public function getCustomId()
    {
        return $this->container['custom_id'];
    }

    /**
     * Sets custom_id
     *
     * @param string $custom_id A custom ID for the Client
     *
     * @return $this
     */
    public function setCustomId($custom_id)
    {
        $this->container['custom_id'] = $custom_id;

        return $this;
    }

    /**
     * Gets first_name
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->container['first_name'];
    }

    /**
     * Sets first_name
     *
     * @param string $first_name Client's first name
     *
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->container['first_name'] = $first_name;

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
     * Gets display_name
     *
     * @return string
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param string $display_name Currently unused
     *
     * @return $this
     */
    public function setDisplayName($display_name)
    {
        $this->container['display_name'] = $display_name;

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
     * Gets birth_date
     *
     * @return string
     */
    public function getBirthDate()
    {
        return $this->container['birth_date'];
    }

    /**
     * Sets birth_date
     *
     * @param string $birth_date Client's date of birth. Must be in `yyyy-mm-dd` format and later than `1900-01-01`.<br>**IMPORTANT**: Months and days must be zero-padded. For example: May 3, 1993 is `1993-05-03`.
     *
     * @return $this
     */
    public function setBirthDate($birth_date)
    {
        $this->container['birth_date'] = $birth_date;

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
     * @param string $country_code Code of Client's country of residence in accordance with the ISO 3166 format
     *
     * @return $this
     */
    public function setCountryCode($country_code)
    {
        $this->container['country_code'] = $country_code;

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
