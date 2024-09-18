<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddVirtualCoinFlipToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-virtual-coin-flip.enabled', TRUE);
        $this->migrator->add('tool-virtual-coin-flip.title', 'Virtual Coin Flip');
        $this->migrator->add('tool-virtual-coin-flip.summary', 'Coin Flip is an online heads or tails coin toss simulator.');
        $this->migrator->add('tool-virtual-coin-flip.description', 'Coin Flip is an online heads or tails coin toss simulator.');

        $this->migrator->add("tool-virtual-coin-flip.metaDescription", "Coin Flip is an online heads or tails coin toss simulator.");
        $this->migrator->add("tool-virtual-coin-flip.metaKeywords", "");

        $this->migrator->add('tool-slugs.VirtualCoinFlip', 'virtual-coin-flip');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-virtual-coin-flip.enabled');
        $this->migrator->delete('tool-virtual-coin-flip.title');
        $this->migrator->delete('tool-virtual-coin-flip.summary');
        $this->migrator->delete('tool-virtual-coin-flip.description');

        $this->migrator->delete('tool-virtual-coin-flip.metaDescription');
        $this->migrator->delete('tool-virtual-coin-flip.metaKeywords');

        $this->migrator->delete('tool-slugs.VirtualCoinFlip');
    }
}
