# Aspose\Omr\OmrApi

All URIs are relative to *https://api.aspose.cloud/v1.1*

Method | HTTP request | Description
------------- | ------------- | -------------
[**postRunOmrTask**](OmrApi.md#postRunOmrTask) | **POST** /omr/{name}/runOmrTask | Run specific OMR task


# **postRunOmrTask**
> \Aspose\Omr\Model\OMRResponse postRunOmrTask($name, $actionName, $param, $storage, $folder)

Run specific OMR task


### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **name** | **string**| Name of the file to recognize. |
 **actionName** | **string**| Action name [&#39;CorrectTemplate&#39;, &#39;FinalizeTemplate&#39;, &#39;RecognizeImage&#39;] |
 **param** | [**\Aspose\Omr\Model\OMRFunctionParam**](../Model/OMRFunctionParam.md)| Function params, specific for each actionName | [optional]
 **storage** | **string**| Image&#39;s storage. | [optional]
 **folder** | **string**| Image&#39;s folder. | [optional]

### Return type

[**\Aspose\Omr\Model\OMRResponse**](../Model/OMRResponse.md)

### Authorization

Library uses OAUTH2 authorization internally

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: application/json

[[Back to top]](#) [[Back to API list]](../../README.md#documentation-for-api-endpoints) [[Back to Model list]](../../README.md#documentation-for-models) [[Back to README]](../../README.md)

