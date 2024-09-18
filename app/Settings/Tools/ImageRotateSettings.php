<?php

namespace App\Settings\Tools;

use Spatie\LaravelSettings\Settings;

class ImageRotateSettings extends BaseToolSetting {
    public static function group(): string {
        return 'tool-image-rotate';
    }
}