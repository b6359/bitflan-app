<?php

namespace App\Settings\Tools;

use Spatie\LaravelSettings\Settings;

class ImageToGrayscaleSettings extends BaseToolSetting {
    public static function group(): string {
        return 'tool-image-to-grayscale';
    }
}