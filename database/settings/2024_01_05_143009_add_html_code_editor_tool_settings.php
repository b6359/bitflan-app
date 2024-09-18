<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddHtmlCodeEditorToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-html-code-editor.enabled', TRUE);
        $this->migrator->add('tool-html-code-editor.title', 'HTML Code Editor');
        $this->migrator->add('tool-html-code-editor.summary', 'Free online HTML code editor with instant live preview. Enter your code in the editor and see the preview changing as you type. Compose your documents easily without installing any program.');
        $this->migrator->add('tool-html-code-editor.description', 'Free online HTML code editor with instant live preview. Enter your code in the editor and see the preview changing as you type. Compose your documents easily without installing any program.');

        $this->migrator->add("tool-html-code-editor.metaDescription", "Free online HTML code editor with instant live preview. Enter your code in the editor and see the preview changing as you type. Compose your documents easily without installing any program.");
        $this->migrator->add("tool-html-code-editor.metaKeywords", "");

        $this->migrator->add('tool-slugs.HtmlCodeEditor', 'html-code-editor');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-html-code-editor.enabled');
        $this->migrator->delete('tool-html-code-editor.title');
        $this->migrator->delete('tool-html-code-editor.summary');
        $this->migrator->delete('tool-html-code-editor.description');

        $this->migrator->delete('tool-html-code-editor.metaDescription');
        $this->migrator->delete('tool-html-code-editor.metaKeywords');

        $this->migrator->delete('tool-slugs.HtmlCodeEditor');
    }
}
