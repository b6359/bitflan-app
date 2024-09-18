<?php

namespace App\Settings\Tools;

use Spatie\LaravelSettings\Settings;

class TextRepeaterSettings extends BaseToolSetting {
    public static function group(): string {
        return 'tool-text-repeater';
    }
}