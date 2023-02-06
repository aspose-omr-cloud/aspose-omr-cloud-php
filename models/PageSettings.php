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

include_once "models\FontStyle.php";
include_once "models\PaperSize.php";
include_once "models\Color.php";
include_once "models\Orientation.php";
include_once "models\BubbleSize.php";
include_once "models\FileExtension.php";

class PageSettings
{
    public $fontFamily = "Segoe UI";

    public $fontStyle = FontStyle::REGULAR;

    public $fontSize = 12;

    public $paperSize = PaperSize::A4;

    public $bubbleColor = Color::BLACK;

    public $pageMarginLeft = 210;

    public $orientation = Orientation::VERTICAL;

    public $bubbleSize = BubbleSize::NORMAL;

    public $outputFormat = FileExtension::PNG;

}
