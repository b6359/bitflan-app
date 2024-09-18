<?php

namespace App\Settings\Tools;

use Spatie\LaravelSettings\Settings;

class CountDownTimerSettings extends BaseToolSetting {
    public static function group(): string {
        return 'tool-count-down-timer';
    }
}