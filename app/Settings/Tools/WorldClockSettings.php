<?php

namespace App\Settings\Tools;

use Spatie\LaravelSettings\Settings;

class WorldClockSettings extends BaseToolSetting {
    public static function group(): string {
        return 'tool-world-clock';
    }
}
