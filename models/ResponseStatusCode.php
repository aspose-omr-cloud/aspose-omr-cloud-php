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

class ResponseStatusCode
{
    /**
     * Possible values of this enum
     */
    const OK = 'Ok';
const PARTIALLY_NOT_FOUND = 'PartiallyNotFound';
const NO_ANY_RESULT_DATA = 'NoAnyResultData';
const RESULT_DATA_LOST = 'ResultDataLost';
const TASK_NOT_FOUND = 'TaskNotFound';
const NOT_READY = 'NotReady';
const ERROR = 'Error';
    /**
     * Gets allowable values of the enum
     * @return string[]
     */
    public static function getAllowableEnumValues()
    {
        return [
            self::OK,
self::PARTIALLY_NOT_FOUND,
self::NO_ANY_RESULT_DATA,
self::RESULT_DATA_LOST,
self::TASK_NOT_FOUND,
self::NOT_READY,
self::ERROR,        ];
    }
}
