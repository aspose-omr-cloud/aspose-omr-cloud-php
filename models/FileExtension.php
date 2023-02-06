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

class FileExtension
{
    /**
     * Possible values of this enum
     */
    const PNG = 'Png';
const PDF = 'Pdf';
const CSV = 'Csv';
const JSON = 'Json';
const TXT = 'Txt';
const INTERNAL = 'Internal';
const JPG = 'Jpg';
const OMR = 'Omr';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::PNG,
self::PDF,
self::CSV,
self::JSON,
self::TXT,
self::INTERNAL,
self::JPG,
self::OMR,        ];
    }
}
