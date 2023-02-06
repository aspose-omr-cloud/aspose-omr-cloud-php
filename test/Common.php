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

class Common
{
    const demoDataSubmoduleName = "aspose-omr-cloud-demo-data";
    const configFileName = "test_config.json";
    public $basePath = "";
    const DataFolderName = "Data";
    const ResultFolderName = "Temp";
    public $config = null;

    function init()
    {
        $currentDirParent = dirname(dirname(dirname(__FILE__)));

        $this->basePath = $currentDirParent . "\\" . self::demoDataSubmoduleName;

        $configFilePath = $currentDirParent .
            "\\" .
            self::demoDataSubmoduleName .
            "\\" .
            self::configFileName;

        $config = new Config($configFilePath);
        $this->config = $config;
    }

    function GetDataFolderDir() {
        return $this->basePath . "\\" . $this->config->dataFolder;
    }

    function GetResultFolderDir() {
        return $this->basePath . "\\" . $this->config->resultFolder;
    }

    function GetURL() {
        return $this->config->basePath;
    }
}