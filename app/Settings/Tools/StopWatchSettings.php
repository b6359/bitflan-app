<?php

namespace App\Settings\Tools;

use Spatie\LaravelSettings\Settings;

class StopWatchSettings extends BaseToolSetting {
    public static function group(): string {
        return 'tool-stop-watch';
    }
}