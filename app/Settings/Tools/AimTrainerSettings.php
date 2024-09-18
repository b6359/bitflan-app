<?php

namespace App\Settings\Tools;

use Spatie\LaravelSettings\Settings;

class AimTrainerSettings extends BaseToolSetting {
    public static function group(): string {
        return 'tool-aim-trainer';
    }
}