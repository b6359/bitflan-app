<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddStopWatchToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-stop-watch.enabled', TRUE);
        $this->migrator->add('tool-stop-watch.title', 'Stop Watch');
        $this->migrator->add('tool-stop-watch.summary', 'Fast Stopwatch and Online Countdown timer always available when you need it.');
        $this->migrator->add('tool-stop-watch.description', 'Fast Stopwatch and Online Countdown timer always available when you need it.');

        $this->migrator->add("tool-stop-watch.metaDescription", "Fast Stopwatch and Online Countdown timer always available when you need it.");
        $this->migrator->add("tool-stop-watch.metaKeywords", "");

        $this->migrator->add('tool-slugs.StopWatch', 'stop-watch');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-stop-watch.enabled');
        $this->migrator->delete('tool-stop-watch.title');
        $this->migrator->delete('tool-stop-watch.summary');
        $this->migrator->delete('tool-stop-watch.description');

        $this->migrator->delete('tool-stop-watch.metaDescription');
        $this->migrator->delete('tool-stop-watch.metaKeywords');

        $this->migrator->delete('tool-slugs.StopWatch');
    }
}
