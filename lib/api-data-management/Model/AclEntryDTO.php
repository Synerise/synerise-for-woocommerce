<?php
/**
 * AclEntryDTO
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
 * AclEntryDTO Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class AclEntryDTO implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'AclEntryDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'application' => 'string',
'method' => 'string',
'permission_groups' => 'string[]',
'permission_scopes' => 'string[]',
'permissions' => 'object[]',
'regex' => 'string',
'version' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'application' => null,
'method' => null,
'permission_groups' => null,
'permission_scopes' => null,
'permissions' => null,
'regex' => null,
'version' => null    ];

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
        'application' => 'application',
'method' => 'method',
'permission_groups' => 'permissionGroups',
'permission_scopes' => 'permissionScopes',
'permissions' => 'permissions',
'regex' => 'regex',
'version' => 'version'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'application' => 'setApplication',
'method' => 'setMethod',
'permission_groups' => 'setPermissionGroups',
'permission_scopes' => 'setPermissionScopes',
'permissions' => 'setPermissions',
'regex' => 'setRegex',
'version' => 'setVersion'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'application' => 'getApplication',
'method' => 'getMethod',
'permission_groups' => 'getPermissionGroups',
'permission_scopes' => 'getPermissionScopes',
'permissions' => 'getPermissions',
'regex' => 'getRegex',
'version' => 'getVersion'    ];

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

    const PERMISSION_SCOPES_USER = 'USER';
const PERMISSION_SCOPES_CLIENT = 'CLIENT';
const PERMISSION_SCOPES_ANONYMOUS_CLIENT = 'ANONYMOUS_CLIENT';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPermissionScopesAllowableValues()
    {
        return [
            self::PERMISSION_SCOPES_USER,
self::PERMISSION_SCOPES_CLIENT,
self::PERMISSION_SCOPES_ANONYMOUS_CLIENT,        ];
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
        $this->container['application'] = isset($data['application']) ? $data['application'] : null;
        $this->container['method'] = isset($data['method']) ? $data['method'] : null;
        $this->container['permission_groups'] = isset($data['permission_groups']) ? $data['permission_groups'] : null;
        $this->container['permission_scopes'] = isset($data['permission_scopes']) ? $data['permission_scopes'] : null;
        $this->container['permissions'] = isset($data['permissions']) ? $data['permissions'] : null;
        $this->container['regex'] = isset($data['regex']) ? $data['regex'] : null;
        $this->container['version'] = isset($data['version']) ? $data['version'] : null;
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
     * Gets application
     *
     * @return string
     */
    public function getApplication()
    {
        return $this->container['application'];
    }

    /**
     * Sets application
     *
     * @param string $application application
     *
     * @return $this
     */
    public function setApplication($application)
    {
        $this->container['application'] = $application;

        return $this;
    }

    /**
     * Gets method
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->container['method'];
    }

    /**
     * Sets method
     *
     * @param string $method method
     *
     * @return $this
     */
    public function setMethod($method)
    {
        $this->container['method'] = $method;

        return $this;
    }

    /**
     * Gets permission_groups
     *
     * @return string[]
     */
    public function getPermissionGroups()
    {
        return $this->container['permission_groups'];
    }

    /**
     * Sets permission_groups
     *
     * @param string[] $permission_groups permission_groups
     *
     * @return $this
     */
    public function setPermissionGroups($permission_groups)
    {
        $this->container['permission_groups'] = $permission_groups;

        return $this;
    }

    /**
     * Gets permission_scopes
     *
     * @return string[]
     */
    public function getPermissionScopes()
    {
        return $this->container['permission_scopes'];
    }

    /**
     * Sets permission_scopes
     *
     * @param string[] $permission_scopes permission_scopes
     *
     * @return $this
     */
    public function setPermissionScopes($permission_scopes)
    {
        $allowedValues = $this->getPermissionScopesAllowableValues();
        if (!is_null($permission_scopes) && array_diff($permission_scopes, $allowedValues)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'permission_scopes', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['permission_scopes'] = $permission_scopes;

        return $this;
    }

    /**
     * Gets permissions
     *
     * @return object[]
     */
    public function getPermissions()
    {
        return $this->container['permissions'];
    }

    /**
     * Sets permissions
     *
     * @param object[] $permissions permissions
     *
     * @return $this
     */
    public function setPermissions($permissions)
    {
        $this->container['permissions'] = $permissions;

        return $this;
    }

    /**
     * Gets regex
     *
     * @return string
     */
    public function getRegex()
    {
        return $this->container['regex'];
    }

    /**
     * Sets regex
     *
     * @param string $regex regex
     *
     * @return $this
     */
    public function setRegex($regex)
    {
        $this->container['regex'] = $regex;

        return $this;
    }

    /**
     * Gets version
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->container['version'];
    }

    /**
     * Sets version
     *
     * @param string $version version
     *
     * @return $this
     */
    public function setVersion($version)
    {
        $this->container['version'] = $version;

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
