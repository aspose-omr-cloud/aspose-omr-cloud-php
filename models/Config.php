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

class Config
{
    public $basePath="";
    public $dataFolder = "";
    public $resultFolder = "";
    public $authUrl = "";
    public $clientId = "";
    public $clientSecret = "";
    function __construct ($configFilePath){
        $o = file_get_contents($configFilePath);
        $cf = json_decode($o,true);
        $this->basePath = $cf["base_path"];
        $this->dataFolder = $cf["data_folder"];
        $this->resultFolder = $cf["result_folder"];
        $this->authUrl = $cf["auth_url"];
        $this->clientId = $cf["client_id"];
        $this->clientSecret = $cf["client_secret"];
    }
}
?>