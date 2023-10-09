<?php
/**
 * TextValueTypeDesign
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
 * TextValueTypeDesign Class Doc Comment
 *
 * @category Class
 * @description Field design
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TextValueTypeDesign implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'Text value type design';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'label' => 'string',
'hide_label' => 'bool',
'placeholder' => 'string',
'description' => 'string',
'tooltip' => 'string',
'tab_index' => 'float',
'initial_focus' => 'bool'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'label' => null,
'hide_label' => null,
'placeholder' => null,
'description' => null,
'tooltip' => null,
'tab_index' => null,
'initial_focus' => null    ];

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
        'label' => 'label',
'hide_label' => 'hideLabel',
'placeholder' => 'placeholder',
'description' => 'description',
'tooltip' => 'tooltip',
'tab_index' => 'tabIndex',
'initial_focus' => 'initialFocus'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'label' => 'setLabel',
'hide_label' => 'setHideLabel',
'placeholder' => 'setPlaceholder',
'description' => 'setDescription',
'tooltip' => 'setTooltip',
'tab_index' => 'setTabIndex',
'initial_focus' => 'setInitialFocus'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'label' => 'getLabel',
'hide_label' => 'getHideLabel',
'placeholder' => 'getPlaceholder',
'description' => 'getDescription',
'tooltip' => 'getTooltip',
'tab_index' => 'getTabIndex',
'initial_focus' => 'getInitialFocus'    ];

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
        $this->container['label'] = isset($data['label']) ? $data['label'] : null;
        $this->container['hide_label'] = isset($data['hide_label']) ? $data['hide_label'] : null;
        $this->container['placeholder'] = isset($data['placeholder']) ? $data['placeholder'] : null;
        $this->container['description'] = isset($data['description']) ? $data['description'] : null;
        $this->container['tooltip'] = isset($data['tooltip']) ? $data['tooltip'] : null;
        $this->container['tab_index'] = isset($data['tab_index']) ? $data['tab_index'] : null;
        $this->container['initial_focus'] = isset($data['initial_focus']) ? $data['initial_focus'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['label'] === null) {
            $invalidProperties[] = "'label' can't be null";
        }
        if ($this->container['hide_label'] === null) {
            $invalidProperties[] = "'hide_label' can't be null";
        }
        if ($this->container['initial_focus'] === null) {
            $invalidProperties[] = "'initial_focus' can't be null";
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
     * Gets label
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->container['label'];
    }

    /**
     * Sets label
     *
     * @param string $label A descriptive label for the field, displayed in the UI
     *
     * @return $this
     */
    public function setLabel($label)
    {
        $this->container['label'] = $label;

        return $this;
    }

    /**
     * Gets hide_label
     *
     * @return bool
     */
    public function getHideLabel()
    {
        return $this->container['hide_label'];
    }

    /**
     * Sets hide_label
     *
     * @param bool $hide_label When true, the label is not displayed
     *
     * @return $this
     */
    public function setHideLabel($hide_label)
    {
        $this->container['hide_label'] = $hide_label;

        return $this;
    }

    /**
     * Gets placeholder
     *
     * @return string
     */
    public function getPlaceholder()
    {
        return $this->container['placeholder'];
    }

    /**
     * Sets placeholder
     *
     * @param string $placeholder Placeholder text displayed until the user fills in a value
     *
     * @return $this
     */
    public function setPlaceholder($placeholder)
    {
        $this->container['placeholder'] = $placeholder;

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
     * @param string $description The description appears under the field.
     *
     * @return $this
     */
    public function setDescription($description)
    {
        $this->container['description'] = $description;

        return $this;
    }

    /**
     * Gets tooltip
     *
     * @return string
     */
    public function getTooltip()
    {
        return $this->container['tooltip'];
    }

    /**
     * Sets tooltip
     *
     * @param string $tooltip Tooltip text is displayed when the user hovers over the information icon.
     *
     * @return $this
     */
    public function setTooltip($tooltip)
    {
        $this->container['tooltip'] = $tooltip;

        return $this;
    }

    /**
     * Gets tab_index
     *
     * @return float
     */
    public function getTabIndex()
    {
        return $this->container['tab_index'];
    }

    /**
     * Sets tab_index
     *
     * @param float $tab_index Tab index defines the order of field display when the user uses the **TAB** key to navigate the form.
     *
     * @return $this
     */
    public function setTabIndex($tab_index)
    {
        $this->container['tab_index'] = $tab_index;

        return $this;
    }

    /**
     * Gets initial_focus
     *
     * @return bool
     */
    public function getInitialFocus()
    {
        return $this->container['initial_focus'];
    }

    /**
     * Sets initial_focus
     *
     * @param bool $initial_focus If true, the field becomes the initially focused element when the form is opened.
     *
     * @return $this
     */
    public function setInitialFocus($initial_focus)
    {
        $this->container['initial_focus'] = $initial_focus;

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
