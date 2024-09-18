<?php

namespace App\Settings\Tools;

use Spatie\LaravelSettings\Settings;

class HtmlCodeEditorSettings extends BaseToolSetting {
    public static function group(): string {
        return 'tool-html-code-editor';
    }
}