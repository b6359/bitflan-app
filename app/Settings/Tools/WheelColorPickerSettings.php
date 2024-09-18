<?php

namespace App\Settings\Tools;

use Spatie\LaravelSettings\Settings;

class WheelColorPickerSettings extends BaseToolSetting {
    public static function group(): string {
        return 'tool-wheel-color-picker';
    }
}