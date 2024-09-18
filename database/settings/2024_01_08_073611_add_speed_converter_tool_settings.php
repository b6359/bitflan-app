<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddSpeedConverterToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-speed-converter.enabled', TRUE);
        $this->migrator->add('tool-speed-converter.title', 'Speed Converter');
        $this->migrator->add('tool-speed-converter.summary', 'Type a value in any of the fields to convert between speed measurements.');
        $this->migrator->add('tool-speed-converter.description', 'Type a value in any of the fields to convert between speed measurements.');

        $this->migrator->add("tool-speed-converter.metaDescription", "Type a value in any of the fields to convert between speed measurements.");
        $this->migrator->add("tool-speed-converter.metaKeywords", "");

        $this->migrator->add('tool-slugs.SpeedConverter', 'speed-converter');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-speed-converter.enabled');
        $this->migrator->delete('tool-speed-converter.title');
        $this->migrator->delete('tool-speed-converter.summary');
        $this->migrator->delete('tool-speed-converter.description');

        $this->migrator->delete('tool-speed-converter.metaDescription');
        $this->migrator->delete('tool-speed-converter.metaKeywords');

        $this->migrator->delete('tool-slugs.SpeedConverter');
    }
}
