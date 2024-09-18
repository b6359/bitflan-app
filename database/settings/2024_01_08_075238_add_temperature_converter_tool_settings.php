<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddTemperatureConverterToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-temperature-converter.enabled', TRUE);
        $this->migrator->add('tool-temperature-converter.title', 'Temperature Converter');
        $this->migrator->add('tool-temperature-converter.summary', 'Type a value in any of the fields to convert between temperature measurements.');
        $this->migrator->add('tool-temperature-converter.description', 'Type a value in any of the fields to convert between temperature measurements.');

        $this->migrator->add("tool-temperature-converter.metaDescription", "Type a value in any of the fields to convert between temperature measurements.");
        $this->migrator->add("tool-temperature-converter.metaKeywords", "");

        $this->migrator->add('tool-slugs.TemperatureConverter', 'temperature-converter');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-temperature-converter.enabled');
        $this->migrator->delete('tool-temperature-converter.title');
        $this->migrator->delete('tool-temperature-converter.summary');
        $this->migrator->delete('tool-temperature-converter.description');

        $this->migrator->delete('tool-temperature-converter.metaDescription');
        $this->migrator->delete('tool-temperature-converter.metaKeywords');

        $this->migrator->delete('tool-slugs.TemperatureConverter');
    }
}
