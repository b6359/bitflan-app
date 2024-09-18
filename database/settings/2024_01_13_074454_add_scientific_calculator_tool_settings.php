<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddScientificCalculatorToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-scientific-calculator.enabled', TRUE);
        $this->migrator->add('tool-scientific-calculator.title', 'Scientific Calculator');
        $this->migrator->add('tool-scientific-calculator.summary', 'Scientific Calculator with double-digit precision that supports both button click and keyboard type.');
        $this->migrator->add('tool-scientific-calculator.description', 'Scientific Calculator with double-digit precision that supports both button click and keyboard type.');

        $this->migrator->add("tool-scientific-calculator.metaDescription", "Scientific Calculator with double-digit precision that supports both button click and keyboard type.");
        $this->migrator->add("tool-scientific-calculator.metaKeywords", "");

        $this->migrator->add('tool-slugs.ScientificCalculator', 'scientific-calculator');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-scientific-calculator.enabled');
        $this->migrator->delete('tool-scientific-calculator.title');
        $this->migrator->delete('tool-scientific-calculator.summary');
        $this->migrator->delete('tool-scientific-calculator.description');

        $this->migrator->delete('tool-scientific-calculator.metaDescription');
        $this->migrator->delete('tool-scientific-calculator.metaKeywords');

        $this->migrator->delete('tool-slugs.ScientificCalculator');
    }
}
