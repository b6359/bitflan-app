<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddPasteAndShareTextToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-paste-and-share-text.enabled', TRUE);
        $this->migrator->add('tool-paste-and-share-text.title', 'Paste & Share Text');
        $this->migrator->add('tool-paste-and-share-text.summary', 'Online Text Sharing easy way to share text online.');
        $this->migrator->add('tool-paste-and-share-text.description', 'Online Text Sharing easy way to share text online.');

        $this->migrator->add("tool-paste-and-share-text.metaDescription", "Online Text Sharing easy way to share text online.");
        $this->migrator->add("tool-paste-and-share-text.metaKeywords", "");

        $this->migrator->add('tool-slugs.PasteAndShareText', 'paste-and-share-text');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-paste-and-share-text.enabled');
        $this->migrator->delete('tool-paste-and-share-text.title');
        $this->migrator->delete('tool-paste-and-share-text.summary');
        $this->migrator->delete('tool-paste-and-share-text.description');

        $this->migrator->delete('tool-paste-and-share-text.metaDescription');
        $this->migrator->delete('tool-paste-and-share-text.metaKeywords');

        $this->migrator->delete('tool-slugs.PasteAndShareText');
    }
}
