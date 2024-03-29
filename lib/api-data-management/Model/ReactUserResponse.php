<?php
/**
 * ReactUserResponse
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
 * ReactUserResponse Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ReactUserResponse implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'ReactUserResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'avatar' => 'string',
'confirmed' => 'bool',
'created' => '\DateTime',
'description' => 'string',
'display_name' => 'string',
'email' => 'string',
'first_name' => 'string',
'id' => 'int',
'introduction' => 'string',
'is_the_same_user_as_logged_in' => 'bool',
'language' => 'string',
'last_login' => '\DateTime',
'last_name' => 'string',
'mail_account_id' => 'int',
'organization_role' => 'string',
'phone' => 'string',
'roles' => 'int[]',
'status' => 'string',
'super_admin' => 'bool',
'updated' => '\DateTime',
'is_mfa_enabled' => 'bool',
'password_last_modification_date' => '\DateTime'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'avatar' => null,
'confirmed' => null,
'created' => 'date-time',
'description' => null,
'display_name' => null,
'email' => null,
'first_name' => null,
'id' => 'int64',
'introduction' => null,
'is_the_same_user_as_logged_in' => null,
'language' => null,
'last_login' => 'date-time',
'last_name' => null,
'mail_account_id' => null,
'organization_role' => null,
'phone' => null,
'roles' => 'int64',
'status' => null,
'super_admin' => null,
'updated' => 'date-time',
'is_mfa_enabled' => null,
'password_last_modification_date' => 'date-time'    ];

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
'confirmed' => 'confirmed',
'created' => 'created',
'description' => 'description',
'display_name' => 'displayName',
'email' => 'email',
'first_name' => 'firstName',
'id' => 'id',
'introduction' => 'introduction',
'is_the_same_user_as_logged_in' => 'isTheSameUserAsLoggedIn',
'language' => 'language',
'last_login' => 'lastLogin',
'last_name' => 'lastName',
'mail_account_id' => 'mailAccountId',
'organization_role' => 'organizationRole',
'phone' => 'phone',
'roles' => 'roles',
'status' => 'status',
'super_admin' => 'superAdmin',
'updated' => 'updated',
'is_mfa_enabled' => 'isMfaEnabled',
'password_last_modification_date' => 'passwordLastModificationDate'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'avatar' => 'setAvatar',
'confirmed' => 'setConfirmed',
'created' => 'setCreated',
'description' => 'setDescription',
'display_name' => 'setDisplayName',
'email' => 'setEmail',
'first_name' => 'setFirstName',
'id' => 'setId',
'introduction' => 'setIntroduction',
'is_the_same_user_as_logged_in' => 'setIsTheSameUserAsLoggedIn',
'language' => 'setLanguage',
'last_login' => 'setLastLogin',
'last_name' => 'setLastName',
'mail_account_id' => 'setMailAccountId',
'organization_role' => 'setOrganizationRole',
'phone' => 'setPhone',
'roles' => 'setRoles',
'status' => 'setStatus',
'super_admin' => 'setSuperAdmin',
'updated' => 'setUpdated',
'is_mfa_enabled' => 'setIsMfaEnabled',
'password_last_modification_date' => 'setPasswordLastModificationDate'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'avatar' => 'getAvatar',
'confirmed' => 'getConfirmed',
'created' => 'getCreated',
'description' => 'getDescription',
'display_name' => 'getDisplayName',
'email' => 'getEmail',
'first_name' => 'getFirstName',
'id' => 'getId',
'introduction' => 'getIntroduction',
'is_the_same_user_as_logged_in' => 'getIsTheSameUserAsLoggedIn',
'language' => 'getLanguage',
'last_login' => 'getLastLogin',
'last_name' => 'getLastName',
'mail_account_id' => 'getMailAccountId',
'organization_role' => 'getOrganizationRole',
'phone' => 'getPhone',
'roles' => 'getRoles',
'status' => 'getStatus',
'super_admin' => 'getSuperAdmin',
'updated' => 'getUpdated',
'is_mfa_enabled' => 'getIsMfaEnabled',
'password_last_modification_date' => 'getPasswordLastModificationDate'    ];

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

    const STATUS_ACTIVE = 'ACTIVE';
const STATUS_PENDING = 'PENDING';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusAllowableValues()
    {
        return [
            self::STATUS_ACTIVE,
self::STATUS_PENDING,        ];
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
        $this->container['confirmed'] = isset($data['confirmed']) ? $data['confirmed'] : null;
        $this->container['created'] = isset($data['created']) ? $data['created'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['display_name'] = isset($data['display_name']) ? $data['display_name'] : null;
        $this->container['email'] = isset($data['email']) ? $data['email'] : null;
        $this->container['first_name'] = isset($data['first_name']) ? $data['first_name'] : null;
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['introduction'] = isset($data['introduction']) ? $data['introduction'] : null;
        $this->container['is_the_same_user_as_logged_in'] = isset($data['is_the_same_user_as_logged_in']) ? $data['is_the_same_user_as_logged_in'] : null;
        $this->container['language'] = isset($data['language']) ? $data['language'] : null;
        $this->container['last_login'] = isset($data['last_login']) ? $data['last_login'] : null;
        $this->container['last_name'] = isset($data['last_name']) ? $data['last_name'] : null;
        $this->container['mail_account_id'] = isset($data['mail_account_id']) ? $data['mail_account_id'] : null;
        $this->container['organization_role'] = isset($data['organization_role']) ? $data['organization_role'] : null;
        $this->container['phone'] = isset($data['phone']) ? $data['phone'] : null;
        $this->container['roles'] = isset($data['roles']) ? $data['roles'] : null;
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['super_admin'] = isset($data['super_admin']) ? $data['super_admin'] : null;
        $this->container['updated'] = isset($data['updated']) ? $data['updated'] : null;
        $this->container['is_mfa_enabled'] = isset($data['is_mfa_enabled']) ? $data['is_mfa_enabled'] : null;
        $this->container['password_last_modification_date'] = isset($data['password_last_modification_date']) ? $data['password_last_modification_date'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($this->container['status']) && !in_array($this->container['status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'status', must be one of '%s'",
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
     * @param string $avatar URL of the user's avatar
     *
     * @return $this
     */
    public function setAvatar($avatar)
    {
        $this->container['avatar'] = $avatar;

        return $this;
    }

    /**
     * Gets confirmed
     *
     * @return bool
     */
    public function getConfirmed()
    {
        return $this->container['confirmed'];
    }

    /**
     * Sets confirmed
     *
     * @param bool $confirmed Informs if the account is confirmed
     *
     * @return $this
     */
    public function setConfirmed($confirmed)
    {
        $this->container['confirmed'] = $confirmed;

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
     * @param \DateTime $created Account creation date
     *
     * @return $this
     */
    public function setCreated($created)
    {
        $this->container['created'] = $created;

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
     * @param string $description User's description
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
     * @param string $display_name User's display name
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
     * @param string $email User's email address
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
     * @param string $first_name First name of the user
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
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int $id User ID
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
     * @param string $introduction User's introduction
     *
     * @return $this
     */
    public function setIntroduction($introduction)
    {
        $this->container['introduction'] = $introduction;

        return $this;
    }

    /**
     * Gets is_the_same_user_as_logged_in
     *
     * @return bool
     */
    public function getIsTheSameUserAsLoggedIn()
    {
        return $this->container['is_the_same_user_as_logged_in'];
    }

    /**
     * Sets is_the_same_user_as_logged_in
     *
     * @param bool $is_the_same_user_as_logged_in Informs if the user who made the request is the same as the subject of the request
     *
     * @return $this
     */
    public function setIsTheSameUserAsLoggedIn($is_the_same_user_as_logged_in)
    {
        $this->container['is_the_same_user_as_logged_in'] = $is_the_same_user_as_logged_in;

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
     * @param string $language User's interface language
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
     * @param \DateTime $last_login Last login time
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
     * @param string $last_name Last name of the user
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
     * @param int $mail_account_id Unused field
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
     * @param string $organization_role User's role in the organization
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
     * @return string
     */
    public function getPhone()
    {
        return $this->container['phone'];
    }

    /**
     * Sets phone
     *
     * @param string $phone User's phone number
     *
     * @return $this
     */
    public function setPhone($phone)
    {
        $this->container['phone'] = $phone;

        return $this;
    }

    /**
     * Gets roles
     *
     * @return int[]
     */
    public function getRoles()
    {
        return $this->container['roles'];
    }

    /**
     * Sets roles
     *
     * @param int[] $roles An array of roles (IDs) assigned to the user in the currently selected business profile
     *
     * @return $this
     */
    public function setRoles($roles)
    {
        $this->container['roles'] = $roles;

        return $this;
    }

    /**
     * Gets status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     *
     * @param string $status Account status
     *
     * @return $this
     */
    public function setStatus($status)
    {
        $allowedValues = $this->getStatusAllowableValues();
        if (!is_null($status) && !in_array($status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'status', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status'] = $status;

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
     * @param bool $super_admin Informs if the user is a super admin
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
     * @param \DateTime $updated Last update time
     *
     * @return $this
     */
    public function setUpdated($updated)
    {
        $this->container['updated'] = $updated;

        return $this;
    }

    /**
     * Gets is_mfa_enabled
     *
     * @return bool
     */
    public function getIsMfaEnabled()
    {
        return $this->container['is_mfa_enabled'];
    }

    /**
     * Sets is_mfa_enabled
     *
     * @param bool $is_mfa_enabled Informs if multi-factor authentication for the user is active
     *
     * @return $this
     */
    public function setIsMfaEnabled($is_mfa_enabled)
    {
        $this->container['is_mfa_enabled'] = $is_mfa_enabled;

        return $this;
    }

    /**
     * Gets password_last_modification_date
     *
     * @return \DateTime
     */
    public function getPasswordLastModificationDate()
    {
        return $this->container['password_last_modification_date'];
    }

    /**
     * Sets password_last_modification_date
     *
     * @param \DateTime $password_last_modification_date Date and time of last password change
     *
     * @return $this
     */
    public function setPasswordLastModificationDate($password_last_modification_date)
    {
        $this->container['password_last_modification_date'] = $password_last_modification_date;

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
