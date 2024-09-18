<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddCountDownTimerToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-count-down-timer.enabled', TRUE);
        $this->migrator->add('tool-count-down-timer.title', 'Count Down Timer');
        $this->migrator->add('tool-count-down-timer.summary', 'Countdown Timer that counts down in seconds, minutes and hours.');
        $this->migrator->add('tool-count-down-timer.description', 'Countdown Timer that counts down in seconds, minutes and hours.');

        $this->migrator->add("tool-count-down-timer.metaDescription", "Countdown Timer that counts down in seconds, minutes and hours.");
        $this->migrator->add("tool-count-down-timer.metaKeywords", "");

        $this->migrator->add('tool-slugs.CountDownTimer', 'count-down-timer');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-count-down-timer.enabled');
        $this->migrator->delete('tool-count-down-timer.title');
        $this->migrator->delete('tool-count-down-timer.summary');
        $this->migrator->delete('tool-count-down-timer.description');

        $this->migrator->delete('tool-count-down-timer.metaDescription');
        $this->migrator->delete('tool-count-down-timer.metaKeywords');

        $this->migrator->delete('tool-slugs.CountDownTimer');
    }
}
