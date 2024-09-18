<?php

namespace App\Settings\Tools;

use Spatie\LaravelSettings\Settings;

class ScientificCalculatorSettings extends BaseToolSetting {
    public static function group(): string {
        return 'tool-scientific-calculator';
    }
}