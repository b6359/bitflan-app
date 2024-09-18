<?php

namespace App\Settings\Tools;

use Spatie\LaravelSettings\Settings;

class PasteAndShareTextSettings extends BaseToolSetting {
    public static function group(): string {
        return 'tool-paste-and-share-text';
    }
}