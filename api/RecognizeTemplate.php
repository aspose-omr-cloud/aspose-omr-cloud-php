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

class RecognizeTemplate
{
    public $apiClient;

    function __construct($client)
    {
        $this->apiClient = $client;
    }

    function cancelRecognizeTemplate($id)
    {
        $postBody = null;

        // create path and map variables
        $path = "RecognizeTemplate/CancelRecognizeTemplate";

        // query params
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        if ($id != null) {
            $queryParams["id"] = $id;
        }

        $contentTypes = [];

        $contentType =
            count($contentTypes) > 0 ? $contentTypes[0] : "application/json";
        $authNames = [];

        if (str_starts_with($contentType,"multipart/form-data")) {
            $hasFields = false;
            $mp = null;
            if ($hasFields && $mp != null) $postBody = $mp;
        }

        $response = $this->apiClient->invokeAPI($path, 'DELETE', $queryParams,
            $postBody, $headerParams, $formParams, $contentType, $authNames);
        if (curl_getinfo($response->clientRes, CURLINFO_HTTP_CODE) >= 400) {
            throw new Exception(curl_getinfo($response->clientRes, CURLINFO_HTTP_CODE), $response);
        } else if ($response->bodyRes != null) {
            return ;
        } else {
            return;
        }
    }

    function getRecognizeTemplate($id)
    {
        $postBody = null;

        // create path and map variables
        $path = "RecognizeTemplate/GetRecognizeTemplate";

        // query params
        $queryParams = [];
        $headerParams = [];
        $formParams = [];
        if ($id != null) {
            $queryParams["id"] = $id;
        }

        $contentTypes = [];

        $contentType =
            count($contentTypes) > 0 ? $contentTypes[0] : "application/json";
        $authNames = [];

        if (str_starts_with($contentType,"multipart/form-data")) {
            $hasFields = false;
            $mp = null;
            if ($hasFields && $mp != null) $postBody = $mp;
        }

        $response = $this->apiClient->invokeAPI($path, 'GET', $queryParams,
            $postBody, $headerParams, $formParams, $contentType, $authNames);

        if (curl_getinfo($response->clientRes, CURLINFO_HTTP_CODE) >= 400) {
            throw new Exception(curl_getinfo($response->clientRes, CURLINFO_HTTP_CODE), $response);
        } else if ($response->bodyRes != null) {
            return $response->bodyRes;
        }
        else {
            return null;
        }
    }

    function postRecognizeTemplate($body)
    {
        $postBody = json_encode($body);

        // verify required params are set

        // create path and map variables
        $path = "RecognizeTemplate/PostRecognizeTemplate";

        // query params
        $queryParams = [];
        $headerParams = [];
        $formParams = [];

        $contentTypes = ["application/json"];

        $contentType =
            count($contentTypes) > 0 ? $contentTypes[0] : "application/json";
        $authNames = [];

        if (str_starts_with($contentType,"multipart/form-data")) {
            $hasFields = false;
            $mp = null;
            if ($hasFields && $mp != null) $postBody = $mp;
        }
        $response = $this->apiClient->invokeAPI($path, 'POST', $queryParams,
            $postBody, $headerParams, $formParams, $contentType, $authNames);

        $result = "";
        if (curl_getinfo($response->clientRes, CURLINFO_HTTP_CODE) >= 400) {
            throw new Exception(curl_getinfo($response->clientRes, CURLINFO_HTTP_CODE), $response);
        } else if ($response->bodyRes != null) {
            $result = $response->bodyRes;
        }
        return $result;
    }
}