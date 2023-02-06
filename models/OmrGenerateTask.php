<?php
/*
 * Copyright (c) 2022 Aspose Pty Ltd. All Rights Reserved.
 *
 * Licensed under the MIT (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *      https://github.com/aspose-omr-cloud/aspose-omr-cloud-dotnet/blob/master/LICENSE
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

class OmrGenerateTask
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'OmrGenerateTask';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'markup_file' => 'string',
'settings' => '\Aspose\Omr\Cloud\Sdk\Model\PageSettings',
'images' => 'map[string,string]',
'output_format' => '\Aspose\Omr\Cloud\Sdk\Model\FileExtension'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'markup_file' => 'byte',
'settings' => null,
'images' => 'byte',
'output_format' => null    ];

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
        'markup_file' => 'markupFile',
'settings' => 'settings',
'images' => 'images',
'output_format' => 'outputFormat'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'markup_file' => 'setMarkupFile',
'settings' => 'setSettings',
'images' => 'setImages',
'output_format' => 'setOutputFormat'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'markup_file' => 'getMarkupFile',
'settings' => 'getSettings',
'images' => 'getImages',
'output_format' => 'getOutputFormat'    ];

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
        $this->container['markup_file'] = isset($data['markup_file']) ? $data['markup_file'] : null;
        $this->container['settings'] = isset($data['settings']) ? $data['settings'] : null;
        $this->container['images'] = isset($data['images']) ? $data['images'] : null;
        $this->container['output_format'] = isset($data['output_format']) ? $data['output_format'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['markup_file'] === null) {
            $invalidProperties[] = "'markup_file' can't be null";
        }
        if ($this->container['settings'] === null) {
            $invalidProperties[] = "'settings' can't be null";
        }
        if ($this->container['images'] === null) {
            $invalidProperties[] = "'images' can't be null";
        }
        if ($this->container['output_format'] === null) {
            $invalidProperties[] = "'output_format' can't be null";
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
     * Gets markup_file
     *
     * @return string
     */
    public function getMarkupFile()
    {
        return $this->container['markup_file'];
    }

    /**
     * Sets markup_file
     *
     * @param string $markup_file markup_file
     *
     * @return $this
     */
    public function setMarkupFile($markup_file)
    {
        $this->container['markup_file'] = $markup_file;

        return $this;
    }

    /**
     * Gets settings
     *
     * @return \Aspose\Omr\Cloud\Sdk\Model\PageSettings
     */
    public function getSettings()
    {
        return $this->container['settings'];
    }

    /**
     * Sets settings
     *
     * @param \Aspose\Omr\Cloud\Sdk\Model\PageSettings $settings settings
     *
     * @return $this
     */
    public function setSettings($settings)
    {
        $this->container['settings'] = $settings;

        return $this;
    }

    /**
     * Gets images
     *
     * @return map[string,string]
     */
    public function getImages()
    {
        return $this->container['images'];
    }

    /**
     * Sets images
     *
     * @param map[string,string] $images images
     *
     * @return $this
     */
    public function setImages($images)
    {
        $this->container['images'] = $images;

        return $this;
    }

    /**
     * Gets output_format
     *
     * @return \Aspose\Omr\Cloud\Sdk\Model\FileExtension
     */
    public function getOutputFormat()
    {
        return $this->container['output_format'];
    }

    /**
     * Sets output_format
     *
     * @param \Aspose\Omr\Cloud\Sdk\Model\FileExtension $output_format output_format
     *
     * @return $this
     */
    public function setOutputFormat($output_format)
    {
        $this->container['output_format'] = $output_format;

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
