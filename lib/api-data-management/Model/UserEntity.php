<?php
/**
 * UserEntity
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
 * UserEntity Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class UserEntity implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'UserEntity';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'avatar' => 'string',
'blocked' => 'bool',
'business_profile_associations' => 'string[]',
'business_profile_ids' => '\Synerise\DataManagement\Model\BusinessProfileId[]',
'confirmation_token' => '\Synerise\DataManagement\Model\ConfirmationToken',
'created' => '\DateTime',
'deleted' => 'int',
'description' => 'string',
'display_name' => 'string',
'email' => 'string',
'first_name' => 'string',
'force_to_change_password' => 'bool',
'id' => 'int',
'introduction' => 'string',
'language' => 'string',
'last_login' => '\DateTime',
'last_name' => 'string',
'mail_account_id' => 'int',
'organization_role' => 'string',
'password' => 'string',
'password_reset_request_time' => '\DateTime',
'password_reset_token' => '\Synerise\DataManagement\Model\PasswordResetToken',
'phone' => 'string',
'php_password' => 'string',
'php_salt' => 'string',
'salt' => 'string',
'super_admin' => 'bool',
'updated' => '\DateTime',
'wrapped_id' => '\Synerise\DataManagement\Model\UserId'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'avatar' => null,
'blocked' => null,
'business_profile_associations' => null,
'business_profile_ids' => null,
'confirmation_token' => null,
'created' => 'date-time',
'deleted' => 'int64',
'description' => null,
'display_name' => null,
'email' => null,
'first_name' => null,
'force_to_change_password' => null,
'id' => 'int64',
'introduction' => null,
'language' => null,
'last_login' => 'date-time',
'last_name' => null,
'mail_account_id' => 'int32',
'organization_role' => null,
'password' => null,
'password_reset_request_time' => 'date-time',
'password_reset_token' => null,
'phone' => null,
'php_password' => null,
'php_salt' => null,
'salt' => null,
'super_admin' => null,
'updated' => 'date-time',
'wrapped_id' => null    ];

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
'blocked' => 'blocked',
'business_profile_associations' => 'businessProfileAssociations',
'business_profile_ids' => 'businessProfileIds',
'confirmation_token' => 'confirmationToken',
'created' => 'created',
'deleted' => 'deleted',
'description' => 'description',
'display_name' => 'displayName',
'email' => 'email',
'first_name' => 'firstName',
'force_to_change_password' => 'forceToChangePassword',
'id' => 'id',
'introduction' => 'introduction',
'language' => 'language',
'last_login' => 'lastLogin',
'last_name' => 'lastName',
'mail_account_id' => 'mailAccountId',
'organization_role' => 'organizationRole',
'password' => 'password',
'password_reset_request_time' => 'passwordResetRequestTime',
'password_reset_token' => 'passwordResetToken',
'phone' => 'phone',
'php_password' => 'phpPassword',
'php_salt' => 'phpSalt',
'salt' => 'salt',
'super_admin' => 'superAdmin',
'updated' => 'updated',
'wrapped_id' => 'wrappedId'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'avatar' => 'setAvatar',
'blocked' => 'setBlocked',
'business_profile_associations' => 'setBusinessProfileAssociations',
'business_profile_ids' => 'setBusinessProfileIds',
'confirmation_token' => 'setConfirmationToken',
'created' => 'setCreated',
'deleted' => 'setDeleted',
'description' => 'setDescription',
'display_name' => 'setDisplayName',
'email' => 'setEmail',
'first_name' => 'setFirstName',
'force_to_change_password' => 'setForceToChangePassword',
'id' => 'setId',
'introduction' => 'setIntroduction',
'language' => 'setLanguage',
'last_login' => 'setLastLogin',
'last_name' => 'setLastName',
'mail_account_id' => 'setMailAccountId',
'organization_role' => 'setOrganizationRole',
'password' => 'setPassword',
'password_reset_request_time' => 'setPasswordResetRequestTime',
'password_reset_token' => 'setPasswordResetToken',
'phone' => 'setPhone',
'php_password' => 'setPhpPassword',
'php_salt' => 'setPhpSalt',
'salt' => 'setSalt',
'super_admin' => 'setSuperAdmin',
'updated' => 'setUpdated',
'wrapped_id' => 'setWrappedId'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'avatar' => 'getAvatar',
'blocked' => 'getBlocked',
'business_profile_associations' => 'getBusinessProfileAssociations',
'business_profile_ids' => 'getBusinessProfileIds',
'confirmation_token' => 'getConfirmationToken',
'created' => 'getCreated',
'deleted' => 'getDeleted',
'description' => 'getDescription',
'display_name' => 'getDisplayName',
'email' => 'getEmail',
'first_name' => 'getFirstName',
'force_to_change_password' => 'getForceToChangePassword',
'id' => 'getId',
'introduction' => 'getIntroduction',
'language' => 'getLanguage',
'last_login' => 'getLastLogin',
'last_name' => 'getLastName',
'mail_account_id' => 'getMailAccountId',
'organization_role' => 'getOrganizationRole',
'password' => 'getPassword',
'password_reset_request_time' => 'getPasswordResetRequestTime',
'password_reset_token' => 'getPasswordResetToken',
'phone' => 'getPhone',
'php_password' => 'getPhpPassword',
'php_salt' => 'getPhpSalt',
'salt' => 'getSalt',
'super_admin' => 'getSuperAdmin',
'updated' => 'getUpdated',
'wrapped_id' => 'getWrappedId'    ];

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
        $this->container['blocked'] = isset($data['blocked']) ? $data['blocked'] : null;
        $this->container['business_profile_associations'] = isset($data['business_profile_associations']) ? $data['business_profile_associations'] : null;
        $this->container['business_profile_ids'] = isset($data['business_profile_ids']) ? $data['business_profile_ids'] : null;
        $this->container['confirmation_token'] = isset($data['confirmation_token']) ? $data['confirmation_token'] : null;
        $this->container['created'] = isset($data['created']) ? $data['created'] : null;
        $this->container['deleted'] = isset($data['deleted']) ? $data['deleted'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['display_name'] = isset($data['display_name']) ? $data['display_name'] : null;
        $this->container['email'] = isset($data['email']) ? $data['email'] : null;
        $this->container['first_name'] = isset($data['first_name']) ? $data['first_name'] : null;
        $this->container['force_to_change_password'] = isset($data['force_to_change_password']) ? $data['force_to_change_password'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['introduction'] = isset($data['introduction']) ? $data['introduction'] : null;
        $this->container['language'] = isset($data['language']) ? $data['language'] : null;
        $this->container['last_login'] = isset($data['last_login']) ? $data['last_login'] : null;
        $this->container['last_name'] = isset($data['last_name']) ? $data['last_name'] : null;
        $this->container['mail_account_id'] = isset($data['mail_account_id']) ? $data['mail_account_id'] : null;
        $this->container['organization_role'] = isset($data['organization_role']) ? $data['organization_role'] : null;
        $this->container['password'] = isset($data['password']) ? $data['password'] : null;
        $this->container['password_reset_request_time'] = isset($data['password_reset_request_time']) ? $data['password_reset_request_time'] : null;
        $this->container['password_reset_token'] = isset($data['password_reset_token']) ? $data['password_reset_token'] : null;
        $this->container['phone'] = isset($data['phone']) ? $data['phone'] : null;
        $this->container['php_password'] = isset($data['php_password']) ? $data['php_password'] : null;
        $this->container['php_salt'] = isset($data['php_salt']) ? $data['php_salt'] : null;
        $this->container['salt'] = isset($data['salt']) ? $data['salt'] : null;
        $this->container['super_admin'] = isset($data['super_admin']) ? $data['super_admin'] : null;
        $this->container['updated'] = isset($data['updated']) ? $data['updated'] : null;
        $this->container['wrapped_id'] = isset($data['wrapped_id']) ? $data['wrapped_id'] : null;
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
     * @return string
     */
    public function getAvatar()
    {
        return $this->container['avatar'];
    }

    /**
     * Sets avatar
     *
     * @param string $avatar avatar
     *
     * @return $this
     */
    public function setAvatar($avatar)
    {
        $this->container['avatar'] = $avatar;

        return $this;
    }

    /**
     * Gets blocked
     *
     * @return bool
     */
    public function getBlocked()
    {
        return $this->container['blocked'];
    }

    /**
     * Sets blocked
     *
     * @param bool $blocked blocked
     *
     * @return $this
     */
    public function setBlocked($blocked)
    {
        $this->container['blocked'] = $blocked;

        return $this;
    }

    /**
     * Gets business_profile_associations
     *
     * @return string[]
     */
    public function getBusinessProfileAssociations()
    {
        return $this->container['business_profile_associations'];
    }

    /**
     * Sets business_profile_associations
     *
     * @param string[] $business_profile_associations business_profile_associations
     *
     * @return $this
     */
    public function setBusinessProfileAssociations($business_profile_associations)
    {
        $this->container['business_profile_associations'] = $business_profile_associations;

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
     * @param \Synerise\DataManagement\Model\BusinessProfileId[] $business_profile_ids business_profile_ids
     *
     * @return $this
     */
    public function setBusinessProfileIds($business_profile_ids)
    {
        $this->container['business_profile_ids'] = $business_profile_ids;

        return $this;
    }

    /**
     * Gets confirmation_token
     *
     * @return \Synerise\DataManagement\Model\ConfirmationToken
     */
    public function getConfirmationToken()
    {
        return $this->container['confirmation_token'];
    }

    /**
     * Sets confirmation_token
     *
     * @param \Synerise\DataManagement\Model\ConfirmationToken $confirmation_token confirmation_token
     *
     * @return $this
     */
    public function setConfirmationToken($confirmation_token)
    {
        $this->container['confirmation_token'] = $confirmation_token;

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
     * @param \DateTime $created created
     *
     * @return $this
     */
    public function setCreated($created)
    {
        $this->container['created'] = $created;

        return $this;
    }

    /**
     * Gets deleted
     *
     * @return int
     */
    public function getDeleted()
    {
        return $this->container['deleted'];
    }

    /**
     * Sets deleted
     *
     * @param int $deleted deleted
     *
     * @return $this
     */
    public function setDeleted($deleted)
    {
        $this->container['deleted'] = $deleted;

        return $this;
    }

    /**
     * Gets description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->container['description'];
    }

    /**
     * Sets description
     *
     * @param string $description description
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

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
     * @param string $display_name display_name
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
     * @return string
     */
    public function getEmail()
    {
        return $this->container['email'];
    }

    /**
     * Sets email
     *
     * @param string $email email
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
     * @return string
     */
    public function getFirstName()
    {
        return $this->container['first_name'];
    }

    /**
     * Sets first_name
     *
     * @param string $first_name first_name
     *
     * @return $this
     */
    public function setFirstName($first_name)
    {
        $this->container['first_name'] = $first_name;

        return $this;
    }

    /**
     * Gets force_to_change_password
     *
     * @return bool
     */
    public function getForceToChangePassword()
    {
        return $this->container['force_to_change_password'];
    }

    /**
     * Sets force_to_change_password
     *
     * @param bool $force_to_change_password force_to_change_password
     *
     * @return $this
     */
    public function setForceToChangePassword($force_to_change_password)
    {
        $this->container['force_to_change_password'] = $force_to_change_password;

        return $this;
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
     * @param int $id id
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
     * @return string
     */
    public function getIntroduction()
    {
        return $this->container['introduction'];
    }

    /**
     * Sets introduction
     *
     * @param string $introduction introduction
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
     * @return string
     */
    public function getLanguage()
    {
        return $this->container['language'];
    }

    /**
     * Sets language
     *
     * @param string $language language
     *
     * @return $this
     */
    public function setLanguage($language)
    {
        $this->container['language'] = $language;

        return $this;
    }

    /**
     * Gets last_login
     *
     * @return \DateTime
     */
    public function getLastLogin()
    {
        return $this->container['last_login'];
    }

    /**
     * Sets last_login
     *
     * @param \DateTime $last_login last_login
     *
     * @return $this
     */
    public function setLastLogin($last_login)
    {
        $this->container['last_login'] = $last_login;

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
     * @param string $last_name last_name
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
     * @return int
     */
    public function getMailAccountId()
    {
        return $this->container['mail_account_id'];
    }

    /**
     * Sets mail_account_id
     *
     * @param int $mail_account_id mail_account_id
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
     * @return string
     */
    public function getOrganizationRole()
    {
        return $this->container['organization_role'];
    }

    /**
     * Sets organization_role
     *
     * @param string $organization_role organization_role
     *
     * @return $this
     */
    public function setOrganizationRole($organization_role)
    {
        $this->container['organization_role'] = $organization_role;

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
     * @param string $password password
     *
     * @return $this
     */
    public function setPassword($password)
    {
        $this->container['password'] = $password;

        return $this;
    }

    /**
     * Gets password_reset_request_time
     *
     * @return \DateTime
     */
    public function getPasswordResetRequestTime()
    {
        return $this->container['password_reset_request_time'];
    }

    /**
     * Sets password_reset_request_time
     *
     * @param \DateTime $password_reset_request_time password_reset_request_time
     *
     * @return $this
     */
    public function setPasswordResetRequestTime($password_reset_request_time)
    {
        $this->container['password_reset_request_time'] = $password_reset_request_time;

        return $this;
    }

    /**
     * Gets password_reset_token
     *
     * @return \Synerise\DataManagement\Model\PasswordResetToken
     */
    public function getPasswordResetToken()
    {
        return $this->container['password_reset_token'];
    }

    /**
     * Sets password_reset_token
     *
     * @param \Synerise\DataManagement\Model\PasswordResetToken $password_reset_token password_reset_token
     *
     * @return $this
     */
    public function setPasswordResetToken($password_reset_token)
    {
        $this->container['password_reset_token'] = $password_reset_token;

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
     * @param string $phone phone
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->container['phone'] = $phone;

        return $this;
    }

    /**
     * Gets php_password
     *
     * @return string
     */
    public function getPhpPassword()
    {
        return $this->container['php_password'];
    }

    /**
     * Sets php_password
     *
     * @param string $php_password php_password
     *
     * @return $this
     */
    public function setPhpPassword($php_password)
    {
        $this->container['php_password'] = $php_password;

        return $this;
    }

    /**
     * Gets php_salt
     *
     * @return string
     */
    public function getPhpSalt()
    {
        return $this->container['php_salt'];
    }

    /**
     * Sets php_salt
     *
     * @param string $php_salt php_salt
     *
     * @return $this
     */
    public function setPhpSalt($php_salt)
    {
        $this->container['php_salt'] = $php_salt;

        return $this;
    }

    /**
     * Gets salt
     *
     * @return string
     */
    public function getSalt()
    {
        return $this->container['salt'];
    }

    /**
     * Sets salt
     *
     * @param string $salt salt
     *
     * @return $this
     */
    public function setSalt($salt)
    {
        $this->container['salt'] = $salt;

        return $this;
    }

    /**
     * Gets super_admin
     *
     * @return bool
     */
    public function getSuperAdmin()
    {
        return $this->container['super_admin'];
    }

    /**
     * Sets super_admin
     *
     * @param bool $super_admin super_admin
     *
     * @return $this
     */
    public function setSuperAdmin($super_admin)
    {
        $this->container['super_admin'] = $super_admin;

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
     * @param \DateTime $updated updated
     *
     * @return $this
     */
    public function setUpdated($updated)
    {
        $this->container['updated'] = $updated;

        return $this;
    }

    /**
     * Gets wrapped_id
     *
     * @return \Synerise\DataManagement\Model\UserId
     */
    public function getWrappedId()
    {
        return $this->container['wrapped_id'];
    }

    /**
     * Sets wrapped_id
     *
     * @param \Synerise\DataManagement\Model\UserId $wrapped_id wrapped_id
     *
     * @return $this
     */
    public function setWrappedId($wrapped_id)
    {
        $this->container['wrapped_id'] = $wrapped_id;

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