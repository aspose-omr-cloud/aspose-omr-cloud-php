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

class OmrRecognizeTask
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'OmrRecognizeTask';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'images' => 'string[]',
'omr_file' => 'string',
'output_format' => '\Aspose\Omr\Cloud\Sdk\Model\FileExtension',
'recognition_threshold' => 'int'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'images' => 'byte',
'omr_file' => 'byte',
'output_format' => null,
'recognition_threshold' => 'int32'    ];

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
        'images' => 'images',
'omr_file' => 'omrFile',
'output_format' => 'outputFormat',
'recognition_threshold' => 'recognitionThreshold'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'images' => 'setImages',
'omr_file' => 'setOmrFile',
'output_format' => 'setOutputFormat',
'recognition_threshold' => 'setRecognitionThreshold'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'images' => 'getImages',
'omr_file' => 'getOmrFile',
'output_format' => 'getOutputFormat',
'recognition_threshold' => 'getRecognitionThreshold'    ];

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
        $this->container['images'] = isset($data['images']) ? $data['images'] : null;
        $this->container['omr_file'] = isset($data['omr_file']) ? $data['omr_file'] : null;
        $this->container['output_format'] = isset($data['output_format']) ? $data['output_format'] : null;
        $this->container['recognition_threshold'] = isset($data['recognition_threshold']) ? $data['recognition_threshold'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['images'] === null) {
            $invalidProperties[] = "'images' can't be null";
        }
        if ($this->container['omr_file'] === null) {
            $invalidProperties[] = "'omr_file' can't be null";
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
     * Gets images
     *
     * @return string[]
     */
    public function getImages()
    {
        return $this->container['images'];
    }

    /**
     * Sets images
     *
     * @param string[] $images images
     *
     * @return $this
     */
    public function setImages($images)
    {
        $this->container['images'] = $images;

        return $this;
    }

    /**
     * Gets omr_file
     *
     * @return string
     */
    public function getOmrFile()
    {
        return $this->container['omr_file'];
    }

    /**
     * Sets omr_file
     *
     * @param string $omr_file omr_file
     *
     * @return $this
     */
    public function setOmrFile($omr_file)
    {
        $this->container['omr_file'] = $omr_file;

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
     * Gets recognition_threshold
     *
     * @return int
     */
    public function getRecognitionThreshold()
    {
        return $this->container['recognition_threshold'];
    }

    /**
     * Sets recognition_threshold
     *
     * @param int $recognition_threshold recognition_threshold
     *
     * @return $this
     */
    public function setRecognitionThreshold($recognition_threshold)
    {
        $this->container['recognition_threshold'] = $recognition_threshold;

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
