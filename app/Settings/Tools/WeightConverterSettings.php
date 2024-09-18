<?php

namespace App\Settings\Tools;

use Spatie\LaravelSettings\Settings;

class WeightConverterSettings extends BaseToolSetting {
    public static function group(): string {
        return 'tool-weight-converter';
    }
}