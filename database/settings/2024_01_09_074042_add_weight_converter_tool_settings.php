<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddWeightConverterToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-weight-converter.enabled', TRUE);
        $this->migrator->add('tool-weight-converter.title', 'Weight Converter');
        $this->migrator->add('tool-weight-converter.summary', 'Type a value in any of the fields to convert between weight measurements.');
        $this->migrator->add('tool-weight-converter.description', 'Type a value in any of the fields to convert between weight measurements.');

        $this->migrator->add("tool-weight-converter.metaDescription", "Type a value in any of the fields to convert between weight measurements.");
        $this->migrator->add("tool-weight-converter.metaKeywords", "");

        $this->migrator->add('tool-slugs.WeightConverter', 'weight-converter');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-weight-converter.enabled');
        $this->migrator->delete('tool-weight-converter.title');
        $this->migrator->delete('tool-weight-converter.summary');
        $this->migrator->delete('tool-weight-converter.description');

        $this->migrator->delete('tool-weight-converter.metaDescription');
        $this->migrator->delete('tool-weight-converter.metaKeywords');

        $this->migrator->delete('tool-slugs.WeightConverter');
    }
}
