<?php

namespace App\Settings\Tools;

use Spatie\LaravelSettings\Settings;

class TemperatureConverterSettings extends BaseToolSetting {
    public static function group(): string {
        return 'tool-temperature-converter';
    }
}