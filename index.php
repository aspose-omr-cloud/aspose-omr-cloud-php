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

include_once "models\Config.php";
include_once "models\OmrRecognizeTask.php";
include_once "models\OmrGenerateTask.php";
include_once "models\PageSettings.php";
include_once "models\OMRResponse.php";

include_once "api\ApiClient.php";
include_once "api\GenerateTemplate.php";
include_once "api\RecognizeTemplate.php";

class Demo
{
    const configFileName = "test_config.json";

    /// <summary>
    /// Name of the sub-module with demo data and the configuration file
    /// </summary>
    const demoDataSubmoduleName = "aspose-omr-cloud-demo-data";

    /// <summary>
    /// File names for template sources, printable form, recognition pattern and results
    /// </summary>
    const templateGenerationFileName = "Aspose_test.txt";
    const templateImageName = "Aspose_test.jpg";
    const omrFileName = "Aspose_test.omr";
    const resultFileName = "Aspose_test.csv";
    const templateLogosImagesNames = ["logo1.jpg", "logo2.png"];

    public static $apiClient = null;

    /// <summary>
    /// Declare an object to hold an instance of GenerateTemplateApi class
    /// </summary>
    public static $generateApi = null;

    /// <summary>
    /// Declare an object to hold an instance of RecognizeTemplateApi class
    /// </summary>
    public static $recognizeApi = null;

    /// <summary>
    /// Declare an object to hold the parsed configuration data
    /// </summary>
    public static $config = Config::class;

    static function init()
    {
        /// <summary>
        /// Get the parent of working directory of the application
        /// </summary>
        $currentDirParent = dirname(dirname(__FILE__));

        /// <summary>
        /// Get the absolute path to the configuration file
        /// </summary>
        $configFilePath = $currentDirParent .
            "\\" .
            self::demoDataSubmoduleName .
            "\\" .
            self::configFileName;

        /// <summary>
        /// Parse the configuration file
        /// </summary>
        self::$config = new Config($configFilePath);
        self::$config->dataFolder = $currentDirParent .
            "\\" .
            self::demoDataSubmoduleName .
            "\\" .
            self::$config->dataFolder;
        self::$config->resultFolder = $currentDirParent .
            "\\" .
            self::demoDataSubmoduleName .
            "\\" .
            self::$config->resultFolder;

        /// <summary>
        /// TODO ??? (Base)
        /// </summary>
        self::$apiClient = new ApiClient(self::$config->basePath, self::$config);

        /// <summary>
        /// Create an instance of GenerateTemplateApi class
        /// </summary>
        self::$generateApi = new GenerateTemplate(self::$apiClient);

        /// <summary>
        /// Create an instance of RecognizeTemplateApi class
        /// </summary>
        self::$recognizeApi = new RecognizeTemplate(self::$apiClient);

    }

    static function RunDemo()
    {
        #phpinfo();
        self::init();

        /// <summary>
        /// STEP 1: Queue the template source file for generation
        /// </summary>
        echo("    Generate template...<br/>");
        $templateId = self::generateTemplate();

        /// <summary>
        /// STEP 2: Fetch generated printable form and recognition pattern
        /// </summary>
        echo("    Get generation result by ID...<br/>");
        $generationResult = self::getGenerationResultById($templateId);

        /// <summary>
        /// STEP 3: Save the printable form and recognition pattern into result_folder
        /// </summary>
        echo("    Save generation result...<br/>");
        self::saveGenerationResult($generationResult);
        /// <summary>
        /// STEP 4: Queue the scan / photo of the filled form for recognition
        /// </summary>
        echo("Recognize image...<br/>");
        $recognizeTemplateId = self::recognizeImage(
            self::$config->dataFolder . "\\" . self::templateImageName,
            self::$config->resultFolder . "\\" . self::omrFileName);
        /// <summary>
        /// STEP 5: Fetch recognition results
        /// </summary>
        echo("Get recognition result by ID...<br/>");
        $recognitionResponse =
            self::getRecognitionResultById($recognizeTemplateId);

        /// <summary>
        /// STEP 6: Save the recognition results into result_folder
        /// </summary>
        echo("Save recognition result...<br/>");
        self::saveRecognitionResult($recognitionResponse);
    }

    /// <summary>
    /// Generate the template from the provided sources
    /// </summary>
    /// <returns>Response from generation queue</returns>
    static function generateTemplate()
    {
        $markupFile = file_get_contents(self::$config->dataFolder . "\\" . self::templateGenerationFileName);

        $images = [];
        for ($i = 0; $i < count(self::templateLogosImagesNames); $i++) {
            $logo = base64_encode(
                file_get_contents(self::$config->dataFolder . "\\" . self::templateLogosImagesNames[$i]));
            $images[self::templateLogosImagesNames[$i]] = $logo;
        }

        $settings = new PageSettings();

        $task = new OmrGenerateTask();
        $task->markupFile = base64_encode($markupFile);
        $task->settings = $settings;
        $task->images = $images;
        return self::$generateApi->postGenerateTemplate($task);
    }

    /// <summary>
    /// Fetch generated printable form and recognition pattern by ID
    /// If the request is still being processed, wait for 5 seconds and try again
    /// </summary>
    /// <param name="templateId">Generated template ID</param>
    /// <returns>OMRResponse</returns>
    static function getGenerationResultById($templateId)
    {
        while (true) {
            $generationResult = self::$generateApi->getGenerateTemplate($templateId);
            $data = json_decode($generationResult, true);

            $class = new OMRResponse();
            foreach ($data as $key => $value) $class->{$key} = $value;
            if ($class->responseStatusCode == "Ok") {
                break;
            }
            echo("Wait, please! Your request is still being processed<br/>");
            sleep(5);
        }
        return $class;
    }

    /// <summary>
    /// Save the printable form and recognition pattern
    /// </summary>
    /// <param name="generationResult">Response from GetGenerationResultById method</param>
    static function saveGenerationResult($generationResult)
    {
        if ($generationResult->error == null) {
            for ($i = 0; $i < count($generationResult->results); $i++) {
                $type = $generationResult->results[$i]["type"];
                $name = "Aspose_test" . "." . strtolower($type);
                $path = self::$config->resultFolder . "\\" . $name;
                file_put_contents($path, base64_decode($generationResult->results[$i]["data"]));
            }
        } else {
            echo("Error : " . $generationResult->error . "<br/>");
        }
    }

    /// <summary>
    /// Recognize the image of the filled form
    /// </summary>
    /// <param name="imagePath">Path to the scanned or photographed image of the filled form</param>
    /// <param name="omrFilePath">Path to the recognition pattern file (.OMR)</param>
    /// <returns>Response from recognition queue</returns>
    static function recognizeImage($imagePath, $omrFilePath)
    {
        // get the omr file
        $omrFile = file_get_contents($omrFilePath);
        // set up recognition threshold
        $recognitionThreshold = 30;

        // get the filled template
        $image = file_get_contents($imagePath);
        $images = [];
        array_push($images, base64_encode($image));

        // Set up request
        $task = new OmrRecognizeTask();
        $task->omrFile = base64_encode($omrFile);
        $task->recognitionThreshold = $recognitionThreshold;
        $task->images = $images;

        // call image recognition
        return self::$recognizeApi->postRecognizeTemplate($task);
    }
    /// <summary>
    /// Fetch recognition result by ID
    /// If the request is still being processed, wait for 5 seconds and try again
    /// </summary>
    /// <param name="templateId">Template ID</param>
    /// <returns>OMRResponse</returns>
    static function getRecognitionResultById($templateId)
    {
        while (true) {
            $generationResult = self::$recognizeApi->getRecognizeTemplate($templateId);
            $data = json_decode($generationResult, true);

            $class = new OMRResponse();
            foreach ($data as $key => $value) $class->{$key} = $value;
            if ($class->responseStatusCode == "Ok") {
                break;
            }
            echo("Wait, please! Your request is still being processed<br/>");
            sleep(5);
        }
        return $class;
    }
    /// <summary>
    /// Save the recognition results
    /// </summary>
    /// <param name="recognitionResult">Response from GetRecognitionResultById method</param>
    static function saveRecognitionResult($recognitionResult)
    {
        if ($recognitionResult->error == null) {
            $path = self::$config->resultFolder . "\\" . self::resultFileName;
                file_put_contents($path, base64_decode($recognitionResult->results[0]["data"]));
        } else {
            echo("Error : " . $recognitionResult->error . "<br/>");
        }
    }
}

Demo::RunDemo();