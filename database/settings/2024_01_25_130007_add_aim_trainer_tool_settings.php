<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddAimTrainerToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-aim-trainer.enabled', TRUE);
        $this->migrator->add('tool-aim-trainer.title', 'Aim Trainer');
        $this->migrator->add('tool-aim-trainer.summary', 'Aim Trainer is a free browser game that is specifically designed to improve the players aim.');
        $this->migrator->add('tool-aim-trainer.description', 'Aim Trainer is a free browser game that is specifically designed to improve the players aim.');

        $this->migrator->add("tool-aim-trainer.metaDescription", "Aim Trainer is a free browser game that is specifically designed to improve the players aim.");
        $this->migrator->add("tool-aim-trainer.metaKeywords", "");

        $this->migrator->add('tool-slugs.AimTrainer', 'aim-trainer');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-aim-trainer.enabled');
        $this->migrator->delete('tool-aim-trainer.title');
        $this->migrator->delete('tool-aim-trainer.summary');
        $this->migrator->delete('tool-aim-trainer.description');

        $this->migrator->delete('tool-aim-trainer.metaDescription');
        $this->migrator->delete('tool-aim-trainer.metaKeywords');

        $this->migrator->delete('tool-slugs.AimTrainer');
    }
}
