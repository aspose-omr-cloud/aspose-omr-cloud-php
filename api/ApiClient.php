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

class ApiResult{
    public $clientRes;
    public $bodyRes;
    function __construct($clientRes,$bodyRes)
    {
        $this->clientRes = $clientRes;
        $this->bodyRes= $bodyRes;
    }
}
class ApiClient
{
    public $basePath = "";
    public $config = Config::class;

    function __construct($url,$config)
    {
        $this->basePath = $url;
        $this->config = $config;
    }
// We don't use a Map<String, String> for queryParams.
    // If collectionFormat is 'multi' a key might appear multiple times.
    function generateToken()
    {
        $client = curl_init();

        $url = $this->config->authUrl;// + queryString;
        $data = array(
            'grant_type' => 'client_credentials',
            'client_id' => $this->config->clientId,
            'client_secret' => $this->config->clientSecret
        );

        curl_setopt($client, CURLOPT_URL, $url);


        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($client, CURLOPT_POST, 1);
        curl_setopt($client, CURLOPT_POSTFIELDS, $data);
        $res = curl_exec($client);
        curl_close($client);
        $apRes = new ApiResult($client,$res);
        $body = $apRes->bodyRes;
        $data = json_decode($body, true);
        return $data["token_type"] . " " . $data["access_token"];
    }
    // We don't use a Map<String, String> for queryParams.
    // If collectionFormat is 'multi' a key might appear multiple times.
    function invokeAPI(
        $path,
        $method,
        $queryParams,
        $body,
        $headerParams,
        $formParams,
        $contentType,
        $authNames)
    {
//    var ps = queryParams
//        .where((p) => p.value != null)
//        .map((p) => '${p.name}=${p.value}');
//    String queryString = ps.isNotEmpty ? '?' + ps.join('&') : '';
        $client = curl_init();

        $url = $this->basePath . $path;// + queryString;
        if($queryParams != null){
            $url = sprintf("%s?%s", $url, http_build_query($queryParams));
        }
        curl_setopt($client, CURLOPT_URL, $url);

        if ($headerParams == null || count($headerParams)==0) {
            array_push($headerParams,"Content-Type: ".$contentType);
        }
        array_push($headerParams,"Authorization: ".$this->generateToken());

        curl_setopt($client, CURLOPT_HTTPHEADER, $headerParams);

        curl_setopt($client, CURLOPT_RETURNTRANSFER, 1);
        $msgBody = $contentType == "application/x-www-form-urlencoded"
            ? $formParams
            : $body;
        switch ($method) {
            case "POST":
            {
                curl_setopt($client, CURLOPT_POST, 1);
                if ($msgBody)
                    curl_setopt($client, CURLOPT_POSTFIELDS, $msgBody);
                $res = curl_exec($client);
                curl_close($client);
                return new ApiResult($client,$res);
            }
            case "PUT":
            {
                curl_setopt($client, CURLOPT_POST, 1);
                if ($msgBody)
                    curl_setopt($client, CURLOPT_PUT, $msgBody);
                $res = curl_exec($client);
                curl_close($client);
                return new ApiResult($client,$res);
            }
            case "DELETE":
            {
                curl_setopt($client, CURLOPT_CUSTOMREQUEST, 'DELETE');
                $res = curl_exec($client);
                curl_close($client);
                return new ApiResult($client,$res);
            }
            case "PATCH":
            {
                curl_setopt($client, CURLOPT_CUSTOMREQUEST, 'PATCH');
                if ($msgBody)
                    curl_setopt($client, CURLOPT_POSTFIELDS, $msgBody);
                $res = curl_exec($client);
                curl_close($client);
                return new ApiResult($client,$res);
            }
            default:
            {
                curl_setopt($client, CURLOPT_CUSTOMREQUEST, 'GET');
                $res = curl_exec($client);
                curl_close($client);
                return new ApiResult($client,$res);
            }

        }
    }
}