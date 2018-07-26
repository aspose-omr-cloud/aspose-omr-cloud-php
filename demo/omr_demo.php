<?php
namespace Aspose\Omr\Demo;
use Aspose\Omr as AsposeOmr;
use Aspose\Storage as AsposeStorage;
use GuzzleHttp\Promise as Promise;

require_once('vendor/autoload.php');
/**
 * @summary Storage helper class
 */
class Storage
{
    /**
     * @var AsposeStorage\Api\StorageApi Storage API
     */
    private $storageApi;

    /**
     * Storage constructor.
     * @param string    $appKey Application Key
     * @param string    $appSid Application SID
     * @param string    $basePath   Base Path URL
     */
    public function __construct($appKey, $appSid, $basePath) {
        $url_components = parse_url($basePath);
        /**
         * Format $api_host string in the form scheme://host<:port>
         */
        $api_host = sprintf("%s://%s", $url_components['scheme'], $url_components['host']);
        if (in_array('port', $url_components))
            $api_host = sprintf("%s:%s", $api_host, $url_components['port']);
        $api_path = $url_components['path'];

        $config = new AsposeStorage\Configuration();
        $config->setAppKey($appKey)->setAppSid($appSid)->setBasePath($api_path)->setHost($api_host);
        $this->storageApi = new AsposeStorage\Api\StorageApi($config);
    }
    /**
     * @summary Uploads file to storage
     * @param string    $localFilePath  Local file path
     * @param string    $remoteFilePath Remote file path
     */
    public function uploadFile($localFilePath, $remoteFilePath = '')  {
        if (!$localFilePath)
            throw new \Exception("Undefined local file path");

        if (! $remoteFilePath)
            $remoteFilePath = basename($localFilePath);

        print("Uploading ". basename($localFilePath) . " to {$remoteFilePath}\n");
        $response = $this->storageApi->putCreate(new AsposeStorage\Model\Requests\PutCreateRequest($remoteFilePath, $localFilePath));
        return $response->getStatus() == 'OK';
    }

    /**
     * @summary Uploads file to storage asynchronously
     * @param string    $localFilePath  Local file path
     * @param string    $remoteFilePath Remote file path
     */
    public function uploadFileAsync($localFilePath, $remoteFilePath = '')  {
        if (!$localFilePath)
            throw new \Exception("Undefined local file path");

        if (! $remoteFilePath)
            $remoteFilePath = basename($localFilePath);

        print("Uploading ". basename($localFilePath) . " to {$remoteFilePath}\n");
        return $this->storageApi->putCreateAsync(new AsposeStorage\Model\Requests\PutCreateRequest($remoteFilePath, $localFilePath))
            ->then(function (AsposeStorage\Model\UploadResponse $response) use ($remoteFilePath) {
                if ($response->getStatus() != 'OK')
                    throw new \Exception("Upload file {$remoteFilePath} failed");
                return Promise\promise_for($response->getStatus() == 'OK');
            });
    }

    /**
     * @summary Checks if file exists on storage
     * @param string    $path   Remote file path
     */

    public function isExist($path) {
        $response = $this->storageApi->getIsExist(new AsposeStorage\Model\Requests\GetIsExistRequest($path));
        return $response->getStatus() == 'OK' && $response->getFileExist()->getIsExist();
    }

    /**
     * @summary Checks if folder exists on storage
     * @param string    $path   Remote folder path
     */

    public function isFolderExist($path) {
        $response = $this->storageApi->getIsExist(new AsposeStorage\Model\Requests\GetIsExistRequest($path));
        return $response->getStatus() == 'OK' && $response->getFileExist()->getIsFolder() && $response->getFileExist()->getIsExist();
    }

    /**
     * @summary Downloads file from storage
     * @param string    $filePath   Remote file path
     */
    public function downloadFile($filePath)  {
        $response = $this->storageApi->getDownload(new AsposeStorage\Model\Requests\GetDownloadRequest($filePath));
        var_dump($response);
    }

    /**
     * @summary Creates remote folder
     * @param string    $path   Remote folder path
     */
    public function createFolder($folderPath)  {
        $response = $this->storageApi->putCreateFolder(new AsposeStorage\Model\Requests\PutCreateFolderRequest($folderPath));
        return $response->getStatus() == "OK";
    }
}

/**
 * @summary OMR Demo class
 */
class OmrDemo
{
    /**
     * @var Storage $storage    Storage API
     */
    private $storage;

    /**
     * @var AsposeOmr\Api\OmrApi    $omrApi    OMR API
     */
    private $omrApi;

    /**
     * @var object $config Configuratrion array
     */
    private $config = null;
    /**
     * @var string $dataFolder Data Folder path
     */
    private $dataFolder = null;

    /**
     * OmrDemo constructor.
     */
    public function __construct() {
        /**
        * File with dictionary for configuration in JSON format
        * The config file should be looked like:
        *  {
        *     "app_key"  : "xxxxx",
        *     "app_sid"   : "xxx-xxx-xxx-xxx-xxx",
        *     "base_path" : "https://api.aspose.cloud/v1.1",
        *     "data_folder" : "Data"
        *  }
        * Provide your own app_key and app_sid, which you can receive by registering at Aspose Cloud Dashboard (https://dashboard.aspose.cloud/)
        */
        if (null == self::$templateDstName)
            self::$templateDstName = self::$templateName . '.txt';

        $this->loadConfig();

        $this->omrApi = new AsposeOmr\Api\OmrApi($this->config->app_key, $this->config->app_sid, $this->config->base_path);
        $this->storage = new Storage($this->config->app_key, $this->config->app_sid, $this->config->base_path);
    }


    private static $configFileName = "test_config.json";
    private static $demoDataSubmoduleName = "aspose-omr-cloud-demo-data";

    private static $pathToOutput = "./Temp";
    private static $logosFolderName = "Logos";
    private static $logoFiles = ["logo1.jpg", "logo2.png"];
    private static $userImages = ['photo.jpg', 'scan.jpg'];
    private static $templateName = 'Aspose_test';
    private static $templateDstName = null;

    /**
     *
     * @summary Load config from local file system
     */
    private function loadConfig() {
        $dataFolderBase = realpath(dirname(__FILE__));;
        $dataFolderBaseOld = '';
        $configFileRelativePath = self::join_paths(self::$demoDataSubmoduleName, self::$configFileName);
        $configFilePath = null;

        while (!file_exists(self::join_paths($dataFolderBase, $configFileRelativePath)) && $dataFolderBaseOld !== $dataFolderBase) {
            $dataFolderBaseOld = $dataFolderBase;
            $dataFolderBase = realpath(self::join_paths($dataFolderBase, '..'));
        }
        if (!file_exists(self::join_paths($dataFolderBase, $configFileRelativePath)))
            throw new \Exception("Config file not found: ". self::$configFileName);
        else $configFilePath = self::join_paths($dataFolderBase, $configFileRelativePath);
        $this->config = json_decode(file_get_contents($configFilePath));
        if (!property_exists($this->config, 'app_key') || !property_exists($this->config, 'app_sid')
            || !property_exists($this->config, 'base_path') || !property_exists($this->config, 'data_folder'))
            throw new \Exception("Config file has wrong format ");
        $this->dataFolder = self::join_paths(dirname($configFilePath), $this->config->data_folder);
    }

    /**
     *
     * @summary Joins path items
     * @param array $paths Path elements
     * @returns string  Path string
     */
    private static function join_paths(...$paths) {
        return preg_replace('~[/\\\\]+~', DIRECTORY_SEPARATOR, implode(DIRECTORY_SEPARATOR, $paths));
    }

    /**
     *
     * @summary Retrieves full file path, located in data folder
     * @param string    $fileName File name
     * @returns string Full path to fileName
     */
    private function dataFilePath($fileName) {
        return self::join_paths($this->dataFolder, $fileName);
    }

    /**
     *
     * @summary Checks Aspose Response
     * @param AsposeOmr\Model\AsposeResponse    $response   Aspose Response object
     * @param string    $text   Optional string
     * @returns AsposeOmr\Model\AsposeResponse unchanged $response object
     */
    private function checkReponse($response, $text = '') {
        if ($response->getStatus() != "OK")
            throw new \Exception("Request failed {$text} : " . $response->getStatus());
        return $response;
    }

    /**
     *
     * @summary Checks OMR Response
     * @param AsposeOmr\Model\OMRResponse   $response   OMR Response object
     * @param string    $text   Optional string
     * @returns AsposeOmr\Model\OMRResponse unchanged $response object
     */
    private function checkOMRReponse(AsposeOmr\Model\OMRResponse $response, $text = '') {

        $this->checkReponse((object)$response, $text);
        if ($response->getErrorCode() != 0)
            throw new \Exception("OMR Request {$text} failed : " . $response->getErrorText());
        return $response;
    }

    /**
     *
     * @summary Serialize files to JSON object
     * @param array $filePaths  array of input file paths
     * @returns string JSON string
     */
    private function serializeFiles(array $filePaths) {
        $files = [];
        foreach ($filePaths as $filePath)
            $files[] = [ 'Name' => basename($filePath)
            , 'Size' => filesize($filePath)
            , 'Data' => base64_encode(file_get_contents($filePath))];
        return json_encode(['Files' => $files]);
    }

    /**
     *
     * @summary Deserialize file encoded in fileInfo to folder dstPath
     * @param AsposeOmr\Model\FileInfo  $fileInfo   File information object
     * @param string $dstPath Destination path
     * @returns string file paths on local file system
     */
    private function deserializeFile(AsposeOmr\Model\FileInfo $fileInfo, $dstPath) {
        if (!file_exists($dstPath))
            mkdir($dstPath);

        $dstFileName = self::join_paths($dstPath, $fileInfo->getName());
        file_put_contents($dstFileName, base64_decode($fileInfo->getData()));
        return $dstFileName;
    }

    /**
     *
     * @summary Deserialize files from files to folder dstPath
     * @param array     $files      Files array of fileInfo objects
     * @param string    $dstPath   Destination path
     * @returns array   Array of file paths on local file system
     */
    private function deserializeFiles(array $files, $dstPath) {
        $result = [];
        foreach ($files as $file)
            $result[] = $this->deserializeFile($file, $dstPath);
        return $result;
    }

    /**
     *
     * @summary Uploads demo files to the Storage
     */
    public function uploadDemoFiles() {
        if (! $this->storage->isFolderExist(self::$logosFolderName)) {
            if (! $this->storage->createFolder(self::$logosFolderName))
                throw new \Exception("Unable to create folder" . self::$logosFolderName);
        }
        foreach (self::$logoFiles as $fileName){
            $filePath = $this->dataFilePath($fileName);
            $remoteFilePath = self::$logosFolderName . '/' . $fileName;

            if (! $this->storage->uploadFile($filePath, $remoteFilePath))
                throw new \Exception("Unable to upload file {$filePath}");
        }
    }

    /**
     *
     * @summary Generates template
     * @param string    $templateFilePath   Template file path on local file system
     */
    public function generateTemplate($templateFilePath) {
        if (! $this->storage->uploadFile($templateFilePath))
            throw new \Exception("Unable to upload file {$templateFilePath}");
        $templateName = basename($templateFilePath);
        $param = new AsposeOmr\Model\OMRFunctionParam();
        $param->setFunctionParam(json_encode(array('ExtraStoragePath' => self::$logosFolderName)));
        $response = $this->omrApi->postRunOmrTask($templateName, "GenerateTemplate", $param);
        return $this->checkOMRReponse($response, 'GenerateTemplate');
    }

    /**
     *
     * @summary Corrects template
     * @param string    $templateFile   Template file path on local file system
     * @param string    $imageFilePath  Image file path on local file system
     */
    public function correctTemplate($templateFilePath, $imageFilePath) {
        if (! $this->storage->uploadFile($imageFilePath))
            throw new \Exception("Unable to upload file {$imageFilePath}");
        $imageName = basename($imageFilePath);
        $param = new AsposeOmr\Model\OMRFunctionParam();
        $param->setFunctionParam($this->serializeFiles([$templateFilePath]));
        $response = $this->omrApi->postRunOmrTask($imageName, "CorrectTemplate", $param);
        return $this->checkOMRReponse($response, 'CorrectTemplate');
    }
    /**
     *
     * @summary Finalizes template
     * @param string $templateId    Template Identifier
     * @param string $correctedTemplateFilePath Corrected template file path on local file system
     */
    public function finalizeTemplate($templateId, $correctedTemplateFilePath) {
        if (! $this->storage->uploadFile($correctedTemplateFilePath))
            throw new \Exception("Unable to upload file {$correctedTemplateFilePath}");
        $correctedTemplateFileName = basename($correctedTemplateFilePath);
        $param = new AsposeOmr\Model\OMRFunctionParam();
        $param->setFunctionParam($templateId);
        $response = $this->omrApi->postRunOmrTask($correctedTemplateFileName, "FinalizeTemplate", $param);
        return $this->checkOMRReponse($response, 'FinalizeTemplate');
    }

    /**
     *
     * @summary Recognizes image
     * @param string    $templateId Template Identifier
     * @param string    $imagePath  Image file path on local file system
     */
    public function recognizeImage($templateId, $imagePath) {
        if (! $this->storage->uploadFile($imagePath))
            throw new \Exception("Unable to upload file {$imagePath}");
        $imageName = basename($imagePath);
        $param = new AsposeOmr\Model\OMRFunctionParam();
        $param->setFunctionParam($templateId);
        $response = $this->omrApi->postRunOmrTask($imageName, "RecognizeImage", $param);
        return $this->checkOMRReponse($response, 'RecognizeImage');
    }

    /**
     *
     * @summary Recognizes image asynchronously
     * @param string    $templateId Template Identifier
     * @param string    $imagePath  Image file path on local file system
     */
    public function recognizeImageAsync($templateId, $imagePath) {
        $imageName = basename($imagePath);
        return $this->storage->uploadFileAsync($imagePath)
            ->then(function($response) use ($imageName, $templateId){
                $param = new AsposeOmr\Model\OMRFunctionParam();
                $param->setFunctionParam($templateId);
                return $this->omrApi->postRunOmrTask($imageName, "RecognizeImage", $param);
            })
            ->then(function($response){
                return Promise\promise_for($this->checkOMRReponse($response, 'RecognizeImage'));
            });
    }

    /**
     *
     * @summary Validates image (Correct and Finalize)
     * @param string    $templateFilePath   Template file path
     * @param string    $imageFilePath  Image file path on local file system
     * @return AsposeOmr\Model\OMRResponse Finalize Template Response
     */
    public function validateTemplate($templateFilePath, $imageFilePath) {
        /**
         * @var AsposeOmr\Model\OMRResponse $correctTemplateResponse
         * @var string $filePath
         */
        print("\nCorrect Template ...\n");
        $correctTemplateResponse = $this->correctTemplate($templateFilePath, $imageFilePath);
        $correctedTemplateFilePath = null;

        foreach ($this->deserializeFiles($correctTemplateResponse->getPayload()->getResult()->getResponseFiles(), self::$pathToOutput) as $filePath)
            if (strtolower(pathinfo($filePath, PATHINFO_EXTENSION)) == 'omrcr') $correctedTemplateFilePath = $filePath;

        print("\nFinalize Template ...\n");
        return $this->finalizeTemplate($correctTemplateResponse->getPayload()->getResult()->getTemplateId(), $correctedTemplateFilePath);
    }


    public function demo() {
        /**
         * @var AsposeOmr\Model\OMRResponse $generateTemplateResponse
         * @var AsposeOmr\Model\OMRResponse $finalizeTemplateResponse
         * @var string $filePath
         * @var string $templateId
         * @var string @userImageFileName
         */
        print("Upload Demo Files  ...\n");
        $this->uploadDemoFiles();

        print("\nGenerate Template ...\n");
        $generateTemplateResponse = $this->generateTemplate(self::dataFilePath(self::$templateDstName));

        $templateFilePath = '';
        $imageFilePath = '';
        foreach ($this->deserializeFiles($generateTemplateResponse->getPayload()->getResult()->getResponseFiles(), self::$pathToOutput) as $filePath) {
            $fileExtension = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
            if ($fileExtension == 'omr') $templateFilePath = $filePath;
            else if ($fileExtension == 'png') $imageFilePath = $filePath;
        }

        $finalizeTemplateResponse = $this->validateTemplate($templateFilePath, $imageFilePath);
        $templateId = $finalizeTemplateResponse->getPayload()->getResult()->getTemplateId();

        print("\nRecognize Images ...\n");
        /*
        * We will use Async interface here to demonstrate simultaneous recognition
        */
        $recognizeImagePromises = [];
        foreach (self::$userImages as $userImageFileName) {
            $recognizeImagePromises[] = $this->recognizeImageAsync($templateId, self::dataFilePath($userImageFileName));
        }
        /*
         * Wait for all promises to complete, then display result
         */
        Promise\all($recognizeImagePromises)->then(function (array $responses){
            print("\n------ R E S U L T ------\n");
            /**
             * @var AsposeOmr\Model\OMRResponse $recognizeImageResponse
            */
            foreach ($responses as $recognizeImageResponse) {
                foreach ($this->deserializeFiles($recognizeImageResponse->getPayload()->getResult()->getResponseFiles(), self::$pathToOutput) as $filePath) {
                    if (strtolower(pathinfo($filePath, PATHINFO_EXTENSION)) == 'dat')
                        print("Output file {$filePath}\n");
                }
            }
        }, function ($exception) {
            print("\nRecognizeImage Exception: {$exception->getMessage()} \n");
        })
        ->wait();
    }
}

print("Starting OMR Demo\n");
$demo = new OmrDemo();
$demo->demo();
?>