<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddWheelColorPickerToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-wheel-color-picker.enabled', TRUE);
        $this->migrator->add('tool-wheel-color-picker.title', 'Wheel Color Picker');
        $this->migrator->add('tool-wheel-color-picker.summary', 'Dive into the world of gooey fun! Spin the wheel to craft your unique slime masterpiece.');
        $this->migrator->add('tool-wheel-color-picker.description', 'Dive into the world of gooey fun! Spin the wheel to craft your unique slime masterpiece.');

        $this->migrator->add("tool-wheel-color-picker.metaDescription", "Dive into the world of gooey fun! Spin the wheel to craft your unique slime masterpiece.");
        $this->migrator->add("tool-wheel-color-picker.metaKeywords", "");

        $this->migrator->add('tool-slugs.WheelColorPicker', 'wheel-color-picker');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-wheel-color-picker.enabled');
        $this->migrator->delete('tool-wheel-color-picker.title');
        $this->migrator->delete('tool-wheel-color-picker.summary');
        $this->migrator->delete('tool-wheel-color-picker.description');

        $this->migrator->delete('tool-wheel-color-picker.metaDescription');
        $this->migrator->delete('tool-wheel-color-picker.metaKeywords');

        $this->migrator->delete('tool-slugs.WheelColorPicker');
    }
}
