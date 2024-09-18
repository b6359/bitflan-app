<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddImageRotateToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-image-rotate.enabled', TRUE);
        $this->migrator->add('tool-image-rotate.title', 'Image Rotate');
        $this->migrator->add('tool-image-rotate.summary', 'Rotate only images with portrait or landscape orientation at once.');
        $this->migrator->add('tool-image-rotate.description', 'Rotate only images with portrait or landscape orientation at once.');

        $this->migrator->add("tool-image-rotate.metaDescription", "Rotate only images with portrait or landscape orientation at once.");
        $this->migrator->add("tool-image-rotate.metaKeywords", "");

        $this->migrator->add('tool-slugs.ImageRotate', 'image-rotate');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-image-rotate.enabled');
        $this->migrator->delete('tool-image-rotate.title');
        $this->migrator->delete('tool-image-rotate.summary');
        $this->migrator->delete('tool-image-rotate.description');

        $this->migrator->delete('tool-image-rotate.metaDescription');
        $this->migrator->delete('tool-image-rotate.metaKeywords');

        $this->migrator->delete('tool-slugs.ImageRotate');
    }
}
