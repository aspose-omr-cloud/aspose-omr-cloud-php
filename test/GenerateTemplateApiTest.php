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

include_once "models/OmrGenerateTask.php";
include_once "models/PageSettings.php";
include_once "models/OMRResponse.php";
include_once "api/ApiClient.php";

include_once "api/GenerateTemplate.php";

class GenerateTemplateApiTest extends TestCase
{
    public function testGenerateTemplate(): void
    {
        $common = new Common();
        $common->init();
        $url = $common->GetURL();
        $apiClient = new ApiClient($url,$common->config);
        $instance = new GenerateTemplate($apiClient);
        $templateLogosImagesNames = ["logo1.jpg", "logo2.png"];
        $markupFile = file_get_contents($common->GetDataFolderDir() . "\\" . "Aspose_test.txt");

        $images = [];
        for ($i = 0; $i < count($templateLogosImagesNames); $i++) {
            $logo = base64_encode(
                file_get_contents($common->GetDataFolderDir() . "\\" . $templateLogosImagesNames[$i]));
            $images[$templateLogosImagesNames[$i]] = $logo;
        }

        $settings = new PageSettings();

        $task = new OmrGenerateTask();
        $task->markupFile = base64_encode($markupFile);
        $task->settings = $settings;
        $task->images = $images;

        $templateId = $instance->postGenerateTemplate($task);

        $this->assertNotNull($templateId);

        while (true) {
            $generationResult = $instance->getGenerateTemplate($templateId);
            if($generationResult != null){
                $data = json_decode($generationResult, true);
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
        $this->assertTrue(count($class->results)>1);
        $this->assertTrue($class->error == null);
    }
}