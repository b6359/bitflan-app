<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddTextRepeaterToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-text-repeater.enabled', TRUE);
        $this->migrator->add('tool-text-repeater.title', 'Text Repeater');
        $this->migrator->add('tool-text-repeater.summary', 'Text repeater is an online tool to generate a single word or string multiple times.');
        $this->migrator->add('tool-text-repeater.description', 'Text repeater is an online tool to generate a single word or string multiple times.');

        $this->migrator->add("tool-text-repeater.metaDescription", "Text repeater is an online tool to generate a single word or string multiple times.");
        $this->migrator->add("tool-text-repeater.metaKeywords", "");

        $this->migrator->add('tool-slugs.TextRepeater', 'text-repeater');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-text-repeater.enabled');
        $this->migrator->delete('tool-text-repeater.title');
        $this->migrator->delete('tool-text-repeater.summary');
        $this->migrator->delete('tool-text-repeater.description');

        $this->migrator->delete('tool-text-repeater.metaDescription');
        $this->migrator->delete('tool-text-repeater.metaKeywords');

        $this->migrator->delete('tool-slugs.TextRepeater');
    }
}
