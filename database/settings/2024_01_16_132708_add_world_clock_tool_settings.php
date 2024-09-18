<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddWorldClockToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-world-clock.enabled', TRUE);
        $this->migrator->add('tool-world-clock.title', 'World Clock');
        $this->migrator->add('tool-world-clock.summary', 'The time zone abbreviations and acronyms worldwide.');
        $this->migrator->add('tool-world-clock.description', 'The time zone abbreviations and acronyms worldwide.');

        $this->migrator->add("tool-world-clock.metaDescription", "The time zone abbreviations and acronyms worldwide.");
        $this->migrator->add("tool-world-clock.metaKeywords", "");

        $this->migrator->add('tool-slugs.WorldClock', 'world-clock');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-world-clock.enabled');
        $this->migrator->delete('tool-world-clock.title');
        $this->migrator->delete('tool-world-clock.summary');
        $this->migrator->delete('tool-world-clock.description');

        $this->migrator->delete('tool-world-clock.metaDescription');
        $this->migrator->delete('tool-world-clock.metaKeywords');

        $this->migrator->delete('tool-slugs.WorldClock');
    }
}
