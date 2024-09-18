<?php

namespace App\Settings\Tools;

use Spatie\LaravelSettings\Settings;

class VirtualCoinFlipSettings extends BaseToolSetting {
    public static function group(): string {
        return 'tool-virtual-coin-flip';
    }
}