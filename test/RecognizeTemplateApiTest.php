<?php declare(strict_types=1);
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

use PHPUnit\Framework\TestCase;

include_once "Common.php";

include_once "models/OmrRecognizeTask.php";
include_once "models/OMRResponse.php";
include_once "api/ApiClient.php";

include_once "api/RecognizeTemplate.php";

class RecognizeTemplateApiTest extends TestCase
{
    public function testGenerateTemplate(): void
    {
        $common = new Common();
        $common->init();
        $url = $common->GetURL();
        $apiClient = new ApiClient($url,$common->config);
        $instance = new RecognizeTemplate($apiClient);
        // get the omr file
        $omrFile = file_get_contents($common->GetResultFolderDir() . "\\" . "Aspose_test.omr");
        // set up recognition threshold
        $recognitionThreshold = 30;

        // get the filled template
        $image = file_get_contents($common->GetDataFolderDir() . "\\" . "Aspose_test.jpg");
        $images = [];
        array_push($images, base64_encode($image));

        // Set up request
        $task = new OmrRecognizeTask();
        $task->omrFile = base64_encode($omrFile);
        $task->recognitionThreshold = $recognitionThreshold;
        $task->images = $images;

        // call image recognition
        $templateId = $instance->postRecognizeTemplate($task);

        $this->assertNotNull($templateId);

        while (true) {
            $recognitionResult = $instance->getRecognizeTemplate($templateId);
            if($recognitionResult != null){
                $data = json_decode($recognitionResult, true);
                $class = new OMRResponse();
                foreach ($data as $key => $value) $class->{$key} = $value;
                if ($class->responseStatusCode == "Ok") {
                    break;
                }
            }

            echo("Wait, please! Your request is still being processed");
            sleep(5);
        }

        $this->assertNotNull($class);
        $this->assertTrue(count($class->results)>0);
        $this->assertTrue($class->error == null);
    }
}