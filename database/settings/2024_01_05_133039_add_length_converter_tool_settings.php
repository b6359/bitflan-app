<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddLengthConverterToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-length-converter.enabled', TRUE);
        $this->migrator->add('tool-length-converter.title', 'Length Converter');
        $this->migrator->add('tool-length-converter.summary', 'Type a value in any of the fields to convert between Length measurements.');
        $this->migrator->add('tool-length-converter.description', 'Type a value in any of the fields to convert between Length measurements.');

        $this->migrator->add("tool-length-converter.metaDescription", "Type a value in any of the fields to convert between Length measurements.");
        $this->migrator->add("tool-length-converter.metaKeywords", "");

        $this->migrator->add('tool-slugs.LengthConverter', 'length-converter');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-length-converter.enabled');
        $this->migrator->delete('tool-length-converter.title');
        $this->migrator->delete('tool-length-converter.summary');
        $this->migrator->delete('tool-length-converter.description');

        $this->migrator->delete('tool-length-converter.metaDescription');
        $this->migrator->delete('tool-length-converter.metaKeywords');

        $this->migrator->delete('tool-slugs.LengthConverter');
    }
}
