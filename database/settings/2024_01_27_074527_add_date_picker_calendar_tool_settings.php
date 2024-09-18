<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddDatePickerCalendarToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-date-picker-calendar.enabled', TRUE);
        $this->migrator->add('tool-date-picker-calendar.title', 'Date Picker Calendar');
        $this->migrator->add('tool-date-picker-calendar.summary', 'Date Picker Calendar allow the selection of a specific date and year.');
        $this->migrator->add('tool-date-picker-calendar.description', 'Date Picker Calendar allow the selection of a specific date and year.');

        $this->migrator->add("tool-date-picker-calendar.metaDescription", "Date Picker Calendar allow the selection of a specific date and year.");
        $this->migrator->add("tool-date-picker-calendar.metaKeywords", "");

        $this->migrator->add('tool-slugs.DatePickerCalendar', 'date-picker-calendar');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-date-picker-calendar.enabled');
        $this->migrator->delete('tool-date-picker-calendar.title');
        $this->migrator->delete('tool-date-picker-calendar.summary');
        $this->migrator->delete('tool-date-picker-calendar.description');

        $this->migrator->delete('tool-date-picker-calendar.metaDescription');
        $this->migrator->delete('tool-date-picker-calendar.metaKeywords');

        $this->migrator->delete('tool-slugs.DatePickerCalendar');
    }
}
