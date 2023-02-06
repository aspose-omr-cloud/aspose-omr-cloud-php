# Aspose.OMR Cloud SDK for PHP

**Aspose.OMR Cloud** is an easy-to-use and versatile online service for designing, rendering and recognizing hand-filled answer sheets, exam papers, surveys, ballots, and similar forms. With it, you can quickly develop web applications for optical mark recognition (OMR) that require minimal resources on the client side.

This software development kit (SDK) simplifies the interaction with Aspose.OMR Cloud services, allowing you to focus on business logic rather than the technical details. It handles all the routine operations such as establishing connections, sending API requests, and parsing responses, wrapping all these tasks into a few simple methods that can be used in PHP code.

## Contents of this package

The repository contains:

- Aspose.OMR Cloud SDK for PHP
- Demo project - a simple web application that demonstrates how to use Aspose.OMR Cloud SDK for PHP for generating and recognizing OMR forms.
- Demo data (_aspose-omr-cloud-demo-data_):
    - Configuration file (_aspose-omr-cloud-demo-data/test_config.json_);
    - Source code of the questionnaire, associated images, and a scanned image of the filled questionnaire for recognition test (_aspose-omr-cloud-demo-data/Data_);
    - The directory for storing a generated printable form, recognition pattern (.OMR) file, and recognition results (_aspose-omr-cloud-demo-data/Temp_).

## Licensing

Aspose.OMR Cloud SDK for PHP, demo site, documentation, and form templates are distributed under [MIT License](https://opensource.org/licenses/MIT).

## Prerequisites

- PHP 5.6 and later
- [Composer](https://getcomposer.org/)

### Windows environment

Make sure that local repository path and all paths to all required packages do not exceed 255 symbols.

Aspose.OMR Cloud use [Guzzle](http://guzzle3.readthedocs.io/getting-started/overview.html) library to perform REST requests. [Guzzle](http://guzzle3.readthedocs.io/getting-started/overview.html) framework uses cURL (libcurl) as transport library. On the Windows platform, you may encounter problems accessing **HTTPS** resources depending on the version of libcurl you are using.

- If you are using libcurl built with OpenSSL, download [CA Certificates](https://curl.haxx.se/docs/caextract.html) and update your php.ini:  

  ```
  [curl]
  curl.cainfo="<full path to cacert.pem file>"
  [openssl]
  openssl.cafile="<full path to cacert.pem file>"
  ```

- If you are using libcurl built with WinSSL, you are good to go because WinSSL uses the Windows certificate store.
   
OpenSSL and WinSSL-based versions of libcurl can be downloaded at https://curl.haxx.se/gknw.net/7.40.0/. Choose your platform (x86 or x64), OpenSSL (look for `ssl` string in the file name) or WinSSL (look for `winssl` string in the file name).

## Authorization

Aspose.OMR Cloud follows industry standards and best practices to keep your data secure. All communication with OCR REST API is done using JWT authentication, which provides an open-standard, highly secure way to exchange information. Time-limited JWT tokens are generated using _Client ID_ and _Client Secret_ credentials that are specific for each application.

1. Sign in to [Aspose Cloud API Dashboard](https://dashboard.aspose.cloud/).
2. Go to **Applications** page.
3. Create the storage for exchanging files by clicking the plus icon and following the required steps. You can either use your own cloud storage, create a new storage in our cloud, or reuse the existing one.
4. Give the application an easily recognizable name so it can be quickly found in a long list.
5. Click **Save** button.
6. Click the newly created application and copy the values from **Client Id** and **Client Secret** fields.

## Installation and usage

1. Clone or download the repository.
2. To install the bindings via [Composer](http://getcomposer.org/), add the following to `composer.json`:

   ```json
   {
     "repositories": [
       {
         "type": "git",
         "url": "https://github.com/aspose-omr-cloud/aspose-omr-cloud-php.git"
       }
     ],
     "require": {
       "aspose/aspose-omr-cloud": "*@dev"
     }
   }
   ```

   Then run `composer install`.

3. Run the demo project. The actual steps may vary depending on your platform.

The web application generates a printable OMR-ready form (_aspose-omr-cloud-demo-data/Temp/Aspose_test.png_) along with the recognition pattern file (_aspose-omr-cloud-demo-data/Temp/Aspose_test.omr_). The latter is used by Aspose.OMR recognition engine to match filled bubbles with template fields.

Then it recognizes the scanned image of the filled questionnaire and saves results in _aspose-omr-cloud-demo-data/Temp/Aspose_test.csv_ file.

### Configuring

The configuration file (_aspose-omr-cloud-demo-data/test_config.json_) contains the basic parameters for working with Aspose.OMR Cloud.

- **app_key** - the value from **Client Secret** field of the application (see _Authorization_).
- **app_sid** - the value from **Client Id** field of the application (see _Authorization_).
- **base_path** - root URL of Aspose.OMR Cloud service.
- **data_directory** - path to the directory with the source code of the questionnaire, associated images and scanned images of the filled questionnaires. Specify the path relative to the configuration file.
- **result_directory** - path to the directory for storing a generated printable form, recognition pattern and recognition results. Specify the path relative to the configuration file.

## How it works?

Aspose.OMR Cloud supports end-to-end OMR process - from designing a form to recognizing its filled hardcopies. The workflow includes the following stages:

![Stages of the OMR process](https://releases.aspose.com/images/aspose/aspose_omr_cloud_stages.png)

All resource-consuming tasks (generation and recognition of OMR forms) are done in the cloud, freeing up resources on the end user's device. All cloud tasks are queued, which prevents multiple simultaneous requests from interfering with each other and consuming too much processor time.

Aspose.OMR Cloud SDK for PHP implements wrapper classes that allow you to interact with the Aspose.OMR Cloud REST API without writing low-level HTTP requests and parsing responses. The demo project source code contains extensive comments on all major parts of the code, so you can easily understand the basics without having to consult the SDK reference documentation.

### Generating a printable form

To generate a printable form and a recognition pattern file, send the form sources and page configuration to the Aspose.OMR Cloud queue and get the results a few seconds later.

The processing time can vary from a few milliseconds to a couple of seconds, depending on the current load of the Aspose.OMR Cloud service.

#### GenerateTemplate

This class contains wrapper methods for generating the printable form from the source code and working with the form generation queue.

#### OmrGenerateTask

This class allows you to prepare a request for sending the form source code, associated images, and page layout to the generation queue.

##### Page layout

The paper size, orientation, font, and other layout settings are configured through `PageSettings` object which is passed to the `OmrGenerateTask` constructor.

##### Working with images

Aspose.OMR Cloud allows you to customize forms by adding images (such as your company logo) to them. In addition to describing the image element in the form's source code, each image file must be directly submitted to the generation queue.

Images are provided to the `OmrGenerateTask` constructor as a HashMap, where the key contains the image file name, and the value contains the contents of the image file as an array of bytes.

#### OMRResponse

Depending on the request type, this class contains:

- The current state of the queued form generation request, along with the printable OMR form and recognition pattern file, if the form has been generated.
- The current state of the queued form recognition request, along with recognition results, if the form has been recognized.

### Recognizing a filled form

To recognize the filled form, send its scanned image or photo along with the recognition pattern file to the Aspose.OMR Cloud queue and get the results a few seconds later.

The processing time can vary from a few milliseconds to a couple of seconds, depending on the current load of the Aspose.OMR Cloud service.

#### RecognizeTemplate

This class contains wrapper methods for recognizing the scanned or photographed form and working with the form recognition queue.

#### OmrRecognizeTask

This class allows you to prepare a request for sending the form image to the recognition queue.

The form must be accompanied by the recognition pattern (.OMR) file, which tells Aspose.OMR recognition engine how to match filled bubbles with template fields. Please note that the recognition template file must be taken from the same generation response as the printable form, otherwise the recognition results are not guaranteed to be correct.

##### Recognition accuracy threshold

A respondent can fill out the form with a pen, pencil or marker, and use various marks inside the bubbles - from a solid fill to small crosses or checks.

Recognition accuracy threshold (`recognitionThreshold`) parameter determines how marks are processed during recognition. You can provide a value from 0 to 100. Lower values allow even the lightest marks to be recognized, but may cause dirt or paper defects to be treated as marks. Higher values require a more solid fill and may cause pencil marks or small checkmarks to be ignored.

![Recognition accuracy threshold](https://releases.aspose.com/images/aspose/aspose_omr_recognition_threshold.png)

**Important:** Instruct respondents to use the same type of marks for all bubbles. Otherwise, recognition results may be inaccurate. If you plan to use your smartphone's camera instead of a scanner, we recommend a solid fill with a pen or marker.

## Resources

- [Aspose.OMR Cloud product family](https://products.aspose.cloud/omr/family/)
- [Technical documentation](https://docs.aspose.cloud/omr/)
- [Aspose.OMR Cloud API Reference](https://apireference.aspose.cloud/omr/)
- [Free Support Forum](https://forum.aspose.cloud/c/omr/8)
- [Other SDKs](https://github.com/aspose-omr-cloud)
