<?php
/*
Copyright (c) 2018 Aspose Pty Ltd. All Rights Reserved.

Licensed under the MIT (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

      https://github.com/aspose-omr-cloud/aspose-omr-cloud-php/blob/master/LICENSE

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.



    Aspose.OMR for Cloud API Reference

    Aspose.OMR for Cloud helps performing optical mark recognition in the cloud

    OpenAPI spec version: 1.1
    
    Generated by: https://github.com/swagger-api/swagger-codegen.git
*/

/**
 * OmrApi
 * PHP version 5
 *
 * @category Class
 * @package  Aspose\Omr
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Aspose\Omr\Api;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\MultipartStream;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Promise;
use Aspose\Omr\ApiException;
use Aspose\Omr\Configuration;
use Aspose\Omr\HeaderSelector;
use Aspose\Omr\ObjectSerializer;

/**
 * OmrApi Class Doc Comment
 *
 * @category Class
 * @package  Aspose\Omr
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class OmrApi
{
    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var Configuration
     */
    protected $config;

    /**
     * @param   string  $appKey AppKey
     * @param   string  $appSid AppSid
     * @param   string  $basePath Base Path
     * @param   string  $accessToken Access Token
     * @param Configuration $config
     * @param ClientInterface $client
     * @param HeaderSelector $selector
     */
    public function __construct(
        $appKey = null,
        $appSid = null,
        $basePath = null,
        $accessToken = null,
        Configuration $config = null,
        ClientInterface $client = null,
        HeaderSelector $selector = null
    ) {
        $this->config = $config ?: new Configuration();
        $this->client = $client ?: new Client();
        $this->headerSelector = $selector ?: new HeaderSelector();
        if ($basePath)
            $this->config->setHost($basePath);
        if ($appKey)
            $this->config->setAppKey($appKey);
        if ($appSid)
            $this->config->setAppSid($appSid);
        if ($accessToken)
            $this->config->setAccessToken($accessToken);
    }

    /**
     * @return Configuration
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Operation postRunOmrTask
     *
     * Run specific OMR task
     *
     * @param string $name Name of the file to recognize. (required)
     * @param string $actionName Action name [&#39;CorrectTemplate&#39;, &#39;FinalizeTemplate&#39;, &#39;RecognizeImage&#39;] (required)
     * @param \Aspose\Omr\Model\OMRFunctionParam $param Function params, specific for each actionName (optional)
     * @param string $storage Image&#39;s storage. (optional)
     * @param string $folder Image&#39;s folder. (optional)
     * @throws \Aspose\Omr\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return \Aspose\Omr\Model\OMRResponse
     */
    public function postRunOmrTask($name, $actionName, $param = null, $storage = null, $folder = null)
    {
        list($response) = $this->postRunOmrTaskWithHttpInfo($name, $actionName, $param, $storage, $folder);
        return $response;
    }

    /**
     * Operation postRunOmrTaskWithHttpInfo
     *
     * Run specific OMR task
     *
     * @param string $name Name of the file to recognize. (required)
     * @param string $actionName Action name [&#39;CorrectTemplate&#39;, &#39;FinalizeTemplate&#39;, &#39;RecognizeImage&#39;] (required)
     * @param \Aspose\Omr\Model\OMRFunctionParam $param Function params, specific for each actionName (optional)
     * @param string $storage Image&#39;s storage. (optional)
     * @param string $folder Image&#39;s folder. (optional)
     * @throws \Aspose\Omr\ApiException on non-2xx response
     * @throws \InvalidArgumentException
     * @return array of \Aspose\Omr\Model\OMRResponse, HTTP status code, HTTP response headers (array of strings)
     */
    public function postRunOmrTaskWithHttpInfo($name, $actionName, $param = null, $storage = null, $folder = null)
    {
        return $this->postRunOmrTaskWithHttpInfoInternal($name, $actionName, $param, $storage, $folder);
    }
    protected function postRunOmrTaskWithHttpInfoInternal($name, $actionName, $param, $storage, $folder)
    {
        $returnType = '\Aspose\Omr\Model\OMRResponse';
        $this->updateAuth();
        $request = $this->postRunOmrTaskRequest($name, $actionName, $param, $storage, $folder);

        try {

            try {
                $response = $this->client->send($request, $this->additionalRequestOptions([]));
            } catch (RequestException $e) {
                $statusCode = $e->getCode();
                if (($statusCode == 401 || $statusCode == 403) && $retriesCount > 0
                                && $this->config->getAppSid() && $this->config->getAppKey()) {
                    if ($this->config->getDebug())
                        file_put_contents($this->config->getDebugFile(), "postRunOmrTask: exception {$statusCode}. Will retry and re-acquire token \n");

                    // Clear access token
                    $this->config->setAccessToken('');
                    return $this->postRunOmrTaskWithHttpInfoInternal($retriesCount - 1, $name, $actionName, $param, $storage, $folder);
                } else throw new ApiException(
                    "[{$statusCode}] {$e->getMessage()}",
                    $statusCode,
                    $e->getResponse() ? $e->getResponse()->getHeaders() : null
                );
            }

            $statusCode = $response->getStatusCode();

            if ($statusCode < 200 || $statusCode > 299) {
                throw new ApiException(
                    "[$statusCode] Error connecting to the API ({$request->getUri()})",
                    $statusCode,
                    $response->getHeaders(),
                    $response->getBody()
                );
            }

            $responseBody = $response->getBody();
            if ($returnType === '\SplFileObject') {
                $content = $responseBody; //stream goes to serializer
            } else {
                $content = $responseBody->getContents();
                if ($returnType !== 'string') {
                    $content = json_decode($content);
                }
            }

            return [
                ObjectSerializer::deserialize($content, $returnType, []),
                $response->getStatusCode(),
                $response->getHeaders()
            ];

        } catch (ApiException $e) {
            switch ($e->getCode()) {
                case 200:
                    $data = ObjectSerializer::deserialize($e->getResponseBody(), '\Aspose\Omr\Model\OMRResponse', $e->getResponseHeaders());
                    $e->setResponseObject($data);
                    break;
            }
            throw $e;
        }
    }

    /**
     * Operation postRunOmrTaskAsync
     *
     * Run specific OMR task
     *
     * @param string $name Name of the file to recognize. (required)
     * @param string $actionName Action name [&#39;CorrectTemplate&#39;, &#39;FinalizeTemplate&#39;, &#39;RecognizeImage&#39;] (required)
     * @param \Aspose\Omr\Model\OMRFunctionParam $param Function params, specific for each actionName (optional)
     * @param string $storage Image&#39;s storage. (optional)
     * @param string $folder Image&#39;s folder. (optional)
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function postRunOmrTaskAsync($name, $actionName, $param = null, $storage = null, $folder = null)
    {
        return $this->postRunOmrTaskAsyncWithHttpInfo($name, $actionName, $param, $storage, $folder)->then(function ($response) {
            return $response[0];
        });
    }

    /**
     * Operation postRunOmrTaskAsyncWithHttpInfo
     *
     * Run specific OMR task
     *
     * @param string $name Name of the file to recognize. (required)
     * @param string $actionName Action name [&#39;CorrectTemplate&#39;, &#39;FinalizeTemplate&#39;, &#39;RecognizeImage&#39;] (required)
     * @param \Aspose\Omr\Model\OMRFunctionParam $param Function params, specific for each actionName (optional)
     * @param string $storage Image&#39;s storage. (optional)
     * @param string $folder Image&#39;s folder. (optional)
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Promise\PromiseInterface
     */
    public function postRunOmrTaskAsyncWithHttpInfo($name, $actionName, $param = null, $storage = null, $folder = null)
    {
        return $this->postRunOmrTaskAsyncWithHttpInfoInternal(2, $name, $actionName, $param, $storage, $folder);
    }
    protected function postRunOmrTaskAsyncWithHttpInfoInternal($retriesCount, $name, $actionName, $param, $storage, $folder)
    {
        $returnType = '\Aspose\Omr\Model\OMRResponse';
        
        return $this->updateAuthAsync()
            ->then(function($token) use ($retriesCount, $returnType, $name, $actionName, $param, $storage, $folder) {
                 if ($this->config->getDebug())
                    file_put_contents($this->config->getDebugFile(), "postRunOmrTask: using token {$token}\n");
                $request = $this->postRunOmrTaskRequest($name, $actionName, $param, $storage, $folder);
                return $this->client->sendAsync($request, $this->additionalRequestOptions([]))->then(function ($response) use ($returnType) {
                $responseBody = $response->getBody();
                if ($returnType === '\SplFileObject') {
                    $content = $responseBody; //stream goes to serializer
                } else {
                    $content = $responseBody->getContents();
                    if ($returnType !== 'string') {
                        $content = json_decode($content);
                    }
                }

                return [
                    ObjectSerializer::deserialize($content, $returnType, []),
                    $response->getStatusCode(),
                    $response->getHeaders()
                ];
            }, function ($exception) use ($retriesCount, $name, $actionName, $param, $storage, $folder) {
                $response = $exception->getResponse();
                $statusCode = $response->getStatusCode();
                if (($statusCode == 401 || $statusCode == 403) && $retriesCount > 0
                                                && $this->config->getAppSid() && $this->config->getAppKey()) {
                    if ($this->config->getDebug())
                        file_put_contents($this->config->getDebugFile(), "postRunOmrTask: exception {$statusCode}. Will retry and re-acquire token \n");

                    // Clear access token
                    $this->config->setAccessToken('');
                    return $this->postRunOmrTaskAsyncWithHttpInfoInternal($retriesCount - 1, $name, $actionName, $param, $storage, $folder);
                } else
                    throw new ApiException(
                        "[$statusCode] Error connecting to the API ({$exception->getRequest()->getUri()})",
                        $statusCode,
                        $response->getHeaders(),
                        $response->getBody()
                    );
            });
        });    
    }

    /**
     * Create request for operation 'postRunOmrTask'
     *
     * @param string $name Name of the file to recognize. (required)
     * @param string $actionName Action name [&#39;CorrectTemplate&#39;, &#39;FinalizeTemplate&#39;, &#39;RecognizeImage&#39;] (required)
     * @param \Aspose\Omr\Model\OMRFunctionParam $param Function params, specific for each actionName (optional)
     * @param string $storage Image&#39;s storage. (optional)
     * @param string $folder Image&#39;s folder. (optional)
     * @throws \InvalidArgumentException
     * @return \GuzzleHttp\Psr7\Request
     */
    protected function postRunOmrTaskRequest($name, $actionName, $param = null, $storage = null, $folder = null)
    {
        // verify the required parameter 'name' is set
        if ($name === null) {
            throw new \InvalidArgumentException('Missing the required parameter $name when calling postRunOmrTask');
        }
        // verify the required parameter 'actionName' is set
        if ($actionName === null) {
            throw new \InvalidArgumentException('Missing the required parameter $actionName when calling postRunOmrTask');
        }

        $resourcePath = '/omr/{name}/runOmrTask';
        $formParams = [];
        $queryParams = [];
        $headerParams = [];
        $httpBody = '';
        $multipart = false;

        // query params
        if ($actionName !== null) {
            $queryParams['actionName'] = ObjectSerializer::toQueryValue($actionName);
        }
        // query params
        if ($storage !== null) {
            $queryParams['storage'] = ObjectSerializer::toQueryValue($storage);
        }
        // query params
        if ($folder !== null) {
            $queryParams['folder'] = ObjectSerializer::toQueryValue($folder);
        }

        // path params
        if ($name !== null) {
            $resourcePath = str_replace('{' . 'name' . '}', ObjectSerializer::toPathValue($name), $resourcePath);
        }

        // body params
        $_tempBody = null;
        if (isset($param)) {
            $_tempBody = $param;
        }

        if ($multipart) {
            $headers= $this->headerSelector->selectHeadersForMultipart(
                ['application/json']
            );
        } else {
            $headers = $this->headerSelector->selectHeaders(
                ['application/json'],
                ['application/json']
            );
        }

        // for model (json/xml)
        if (isset($_tempBody)) {
            $httpBody = $_tempBody; // $_tempBody is the method argument, if present

        } elseif (count($formParams) > 0) {
            if ($multipart) {
                $multipartContents = [];
                foreach ($formParams as $formParamName => $formParamValue) {
                    $multipartContents[] = [
                        'name' => $formParamName,
                        'contents' => $formParamValue
                    ];
                }
                $httpBody = new MultipartStream($multipartContents); // for HTTP post (form)

            } elseif ($headers['Content-Type'] === 'application/json') {
                $httpBody = \GuzzleHttp\json_encode($formParams);

            } else {
                $httpBody = \GuzzleHttp\Psr7\build_query($formParams); // for HTTP post (form)
            }
        }


        $query = \GuzzleHttp\Psr7\build_query($queryParams);
        $url = $this->config->getHost() . $resourcePath . ($query ? '?' . $query : '');

        $defaultHeaders = [];
        if ($this->config->getUserAgent()) {
            $defaultHeaders['User-Agent'] = $this->config->getUserAgent();
        }
        
        if ($this->config->getAccessToken()) {
            $headers['Authorization'] = 'Bearer ' . $this->config->getAccessToken();
        }
        
        $headers = array_merge(
            $defaultHeaders,
            $headerParams,
            $headers
        );

        return new Request(
            'POST',
            $url,
            $headers,
            $httpBody
        );
    }
    
    private function authOptions() {
        return $this->additionalRequestOptions([
            'form_params' => [
                'grant_type' => 'client_credentials',
                'client_id' => $this->config->getAppSid(),
                'client_secret' => $this->config->getAppKey()
            ],
            'auth' => [$this->config->getAppSid(), $this->config->getAppKey(), 'basic']
        ]);
    }
    private function updateAuth() {
        if ($this->config->getAppSid() && $this->config->getAppKey()) {
            if ($this->config->getHost() && !$this->config->getAuthTokenUrl()) {
                if (! $this->config->getHost())
                    throw new \InvalidArgumentException("BasePath is empty");

                $url_components = parse_url($this->config->getHost());

                $api_host = sprintf("%s://%s", $url_components['scheme'], $url_components['host']);
                if (in_array('port', $url_components))
                    $api_host = sprintf("%s:%s", $api_host, $url_components['port']);
                $this->config->setAuthTokenUrl($api_host . "/oauth2/token");
            }
            if ($this->config->getAccessToken())
                return $this->config->getAccessToken();
            else {
                if ($this->config->getDebug())
                    file_put_contents($this->config->getDebugFile(), "Requesting new access token from {$this->config->getAuthTokenUrl()} \n");
               
                $response = $this->client->request('POST', $this->config->getAuthTokenUrl(), $this->authOptions());
                $result = json_decode($response->getBody()->getContents(), true);
                $this->config->setAccessToken($result["access_token"]);

                if ($this->config->getDebug())
                    file_put_contents($this->config->getDebugFile(), "got token {$result["access_token"]} \n");

                return $result["access_token"];
            }
        } else {
            if (! $this->config->getAccessToken())
                throw new \InvalidArgumentException("AccessToken is empty");

            return $this->config->getAccessToken();
        }
    }

    private function updateAuthAsync() {
        if ($this->config->getAppSid() && $this->config->getAppKey()) {
            if ($this->config->getHost() && !$this->config->getAuthTokenUrl()) {
                if (! $this->config->getHost())
                    throw new \InvalidArgumentException("BasePath is empty");

                $url_components = parse_url($this->config->getHost());

                $api_host = sprintf("%s://%s", $url_components['scheme'], $url_components['host']);
                if (in_array('port', $url_components))
                    $api_host = sprintf("%s:%s", $api_host, $url_components['port']);
                $this->config->setAuthTokenUrl($api_host . "/oauth2/token");
            }
            if ($this->config->getAccessToken())
                return Promise\promise_for($this->config->getAccessToken());
            else {
                if ($this->config->getDebug())
                    file_put_contents($this->config->getDebugFile(), "Requesting new access token from {$this->config->getAuthTokenUrl()} \n");
                
                return $this->client->requestAsync('POST', $this->config->getAuthTokenUrl(), $this->authOptions())
                    ->then(function ($response) {
                        $result = json_decode($response->getBody()->getContents(), true);
                        $this->config->setAccessToken($result["access_token"]);

                        if ($this->config->getDebug())
                            file_put_contents($this->config->getDebugFile(), "got token {$result["access_token"]} \n");

                        return $result["access_token"];
                    });
            }
        } else {
            if (! $this->config->getAccessToken())
                throw new \InvalidArgumentException("AccessToken is empty");

            return Promise\promise_for($this->config->getAccessToken());
        }
    }

    private function additionalRequestOptions($options) {
        if ($this->config->getDebug()) {
            //$options['debug'] = fopen($this->config->getDebugFile(), 'w+');
            $options['debug'] = $this->config->getDebug();
        }
        return $options;
    }

}
