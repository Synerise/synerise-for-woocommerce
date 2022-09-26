<?php
/**
 * UserResponse
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
 * UserResponse Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class UserResponse implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'UserResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'avatar' => '\Synerise\DataManagement\Model\AvatarUrl',
'business_profile_ids' => '\Synerise\DataManagement\Model\BusinessProfileId[]',
'confirmed' => '\Synerise\DataManagement\Model\UserConfirmed',
'display_name' => '\Synerise\DataManagement\Model\UserDisplayName',
'email' => '\Synerise\DataManagement\Model\UserEmail',
'first_name' => '\Synerise\DataManagement\Model\UserFirstName',
'id' => '\Synerise\DataManagement\Model\UserId',
'introduction' => '\Synerise\DataManagement\Model\UserIntroduction',
'language' => '\Synerise\DataManagement\Model\UserLanguage',
'last_name' => '\Synerise\DataManagement\Model\UserLastName',
'mail_account_id' => '\Synerise\DataManagement\Model\UserMailAccountId',
'organization_role' => '\Synerise\DataManagement\Model\UserOrganizationRole',
'phone' => '\Synerise\DataManagement\Model\UserPhone',
'super_admin' => '\Synerise\DataManagement\Model\UserSuperAdmin'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'avatar' => null,
'business_profile_ids' => null,
'confirmed' => null,
'display_name' => null,
'email' => null,
'first_name' => null,
'id' => null,
'introduction' => null,
'language' => null,
'last_name' => null,
'mail_account_id' => null,
'organization_role' => null,
'phone' => null,
'super_admin' => null    ];

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
        'avatar' => 'avatar',
'business_profile_ids' => 'businessProfileIds',
'confirmed' => 'confirmed',
'display_name' => 'displayName',
'email' => 'email',
'first_name' => 'firstName',
'id' => 'id',
'introduction' => 'introduction',
'language' => 'language',
'last_name' => 'lastName',
'mail_account_id' => 'mailAccountId',
'organization_role' => 'organizationRole',
'phone' => 'phone',
'super_admin' => 'superAdmin'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'avatar' => 'setAvatar',
'business_profile_ids' => 'setBusinessProfileIds',
'confirmed' => 'setConfirmed',
'display_name' => 'setDisplayName',
'email' => 'setEmail',
'first_name' => 'setFirstName',
'id' => 'setId',
'introduction' => 'setIntroduction',
'language' => 'setLanguage',
'last_name' => 'setLastName',
'mail_account_id' => 'setMailAccountId',
'organization_role' => 'setOrganizationRole',
'phone' => 'setPhone',
'super_admin' => 'setSuperAdmin'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'avatar' => 'getAvatar',
'business_profile_ids' => 'getBusinessProfileIds',
'confirmed' => 'getConfirmed',
'display_name' => 'getDisplayName',
'email' => 'getEmail',
'first_name' => 'getFirstName',
'id' => 'getId',
'introduction' => 'getIntroduction',
'language' => 'getLanguage',
'last_name' => 'getLastName',
'mail_account_id' => 'getMailAccountId',
'organization_role' => 'getOrganizationRole',
'phone' => 'getPhone',
'super_admin' => 'getSuperAdmin'    ];

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
        $this->container['avatar'] = isset($data['avatar']) ? $data['avatar'] : null;
        $this->container['business_profile_ids'] = isset($data['business_profile_ids']) ? $data['business_profile_ids'] : null;
        $this->container['confirmed'] = isset($data['confirmed']) ? $data['confirmed'] : null;
        $this->container['display_name'] = isset($data['display_name']) ? $data['display_name'] : null;
        $this->container['email'] = isset($data['email']) ? $data['email'] : null;
        $this->container['first_name'] = isset($data['first_name']) ? $data['first_name'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['introduction'] = isset($data['introduction']) ? $data['introduction'] : null;
        $this->container['language'] = isset($data['language']) ? $data['language'] : null;
        $this->container['last_name'] = isset($data['last_name']) ? $data['last_name'] : null;
        $this->container['mail_account_id'] = isset($data['mail_account_id']) ? $data['mail_account_id'] : null;
        $this->container['organization_role'] = isset($data['organization_role']) ? $data['organization_role'] : null;
        $this->container['phone'] = isset($data['phone']) ? $data['phone'] : null;
        $this->container['super_admin'] = isset($data['super_admin']) ? $data['super_admin'] : null;
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
     * Gets avatar
     *
     * @return \Synerise\DataManagement\Model\AvatarUrl
     */
    public function getAvatar()
    {
        return $this->container['avatar'];
    }

    /**
     * Sets avatar
     *
     * @param \Synerise\DataManagement\Model\AvatarUrl $avatar avatar
     *
     * @return $this
     */
    public function setAvatar($avatar)
    {
        $this->container['avatar'] = $avatar;

        return $this;
    }

    /**
     * Gets business_profile_ids
     *
     * @return \Synerise\DataManagement\Model\BusinessProfileId[]
     */
    public function getBusinessProfileIds()
    {
        return $this->container['business_profile_ids'];
    }

    /**
     * Sets business_profile_ids
     *
     * @param \Synerise\DataManagement\Model\BusinessProfileId[] $business_profile_ids An array of business profiles that the user has access to
     *
     * @return $this
     */
    public function setBusinessProfileIds($business_profile_ids)
    {
        $this->container['business_profile_ids'] = $business_profile_ids;

        return $this;
    }

    /**
     * Gets confirmed
     *
     * @return \Synerise\DataManagement\Model\UserConfirmed
     */
    public function getConfirmed()
    {
        return $this->container['confirmed'];
    }

    /**
     * Sets confirmed
     *
     * @param \Synerise\DataManagement\Model\UserConfirmed $confirmed confirmed
     *
     * @return $this
     */
    public function setConfirmed($confirmed)
    {
        $this->container['confirmed'] = $confirmed;

        return $this;
    }

    /**
     * Gets display_name
     *
     * @return \Synerise\DataManagement\Model\UserDisplayName
     */
    public function getDisplayName()
    {
        return $this->container['display_name'];
    }

    /**
     * Sets display_name
     *
     * @param \Synerise\DataManagement\Model\UserDisplayName $display_name display_name
     *
     * @return $this
     */
    public function setDisplayName($display_name)
    {
        $this->container['display_name'] = $display_name;

        return $this;
    }

    /**
     * Gets email
     *
     * @return \Synerise\DataManagement\Model\UserEmail
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param \Synerise\DataManagement\Model\UserEmail $email email
     *
     * @return $this
     */
    public function setEmail($email)
    {
        $this->container['email'] = $email;

        return $this;
    }

    /**
     * Gets first_name
     *
     * @return \Synerise\DataManagement\Model\UserFirstName
     */
    public function getFirstName()
    {
        return $this->container['first_name'];
    }

    /**
     * Sets first_name
     *
     * @param \Synerise\DataManagement\Model\UserFirstName $first_name first_name
     *
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->container['first_name'] = $first_name;

        return $this;
    }

    /**
     * Gets id
     *
     * @return \Synerise\DataManagement\Model\UserId
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param \Synerise\DataManagement\Model\UserId $id id
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

        return $this;
    }

    /**
     * Gets introduction
     *
     * @return \Synerise\DataManagement\Model\UserIntroduction
     */
    public function getIntroduction()
    {
        return $this->container['introduction'];
    }

    /**
     * Sets introduction
     *
     * @param \Synerise\DataManagement\Model\UserIntroduction $introduction introduction
     *
     * @return $this
     */
    public function setIntroduction($introduction)
    {
        $this->container['introduction'] = $introduction;

        return $this;
    }

    /**
     * Gets language
     *
     * @return \Synerise\DataManagement\Model\UserLanguage
     */
    public function getLanguage()
    {
        return $this->container['language'];
    }

    /**
     * Sets language
     *
     * @param \Synerise\DataManagement\Model\UserLanguage $language language
     *
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->container['language'] = $language;

        return $this;
    }

    /**
     * Gets last_name
     *
     * @return \Synerise\DataManagement\Model\UserLastName
     */
    public function getLastName()
    {
        return $this->container['last_name'];
    }

    /**
     * Sets last_name
     *
     * @param \Synerise\DataManagement\Model\UserLastName $last_name last_name
     *
     * @return $this
     */
    public function setLastName($last_name)
    {
        $this->container['last_name'] = $last_name;

        return $this;
    }

    /**
     * Gets mail_account_id
     *
     * @return \Synerise\DataManagement\Model\UserMailAccountId
     */
    public function getMailAccountId()
    {
        return $this->container['mail_account_id'];
    }

    /**
     * Sets mail_account_id
     *
     * @param \Synerise\DataManagement\Model\UserMailAccountId $mail_account_id mail_account_id
     *
     * @return $this
     */
    public function setMailAccountId($mail_account_id)
    {
        $this->container['mail_account_id'] = $mail_account_id;

        return $this;
    }

    /**
     * Gets organization_role
     *
     * @return \Synerise\DataManagement\Model\UserOrganizationRole
     */
    public function getOrganizationRole()
    {
        return $this->container['organization_role'];
    }

    /**
     * Sets organization_role
     *
     * @param \Synerise\DataManagement\Model\UserOrganizationRole $organization_role organization_role
     *
     * @return $this
     */
    public function setOrganizationRole($organization_role)
    {
        $this->container['organization_role'] = $organization_role;

        return $this;
    }

    /**
     * Gets phone
     *
     * @return \Synerise\DataManagement\Model\UserPhone
     */
    public function getPhone()
    {
        return $this->container['phone'];
    }

    /**
     * Sets phone
     *
     * @param \Synerise\DataManagement\Model\UserPhone $phone phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->container['phone'] = $phone;

        return $this;
    }

    /**
     * Gets super_admin
     *
     * @return \Synerise\DataManagement\Model\UserSuperAdmin
     */
    public function getSuperAdmin()
    {
        return $this->container['super_admin'];
    }

    /**
     * Sets super_admin
     *
     * @param \Synerise\DataManagement\Model\UserSuperAdmin $super_admin super_admin
     *
     * @return $this
     */
    public function setSuperAdmin($super_admin)
    {
        $this->container['super_admin'] = $super_admin;

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
