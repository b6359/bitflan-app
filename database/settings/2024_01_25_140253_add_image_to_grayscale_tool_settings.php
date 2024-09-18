<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class AddImageToGrayscaleToolSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('tool-image-to-grayscale.enabled', TRUE);
        $this->migrator->add('tool-image-to-grayscale.title', 'Image to Grayscale');
        $this->migrator->add('tool-image-to-grayscale.summary', 'Grayscale image is an online free tool to convert images into Grayscale.');
        $this->migrator->add('tool-image-to-grayscale.description', 'Grayscale image is an online free tool to convert images into Grayscale.');

        $this->migrator->add("tool-image-to-grayscale.metaDescription", "Grayscale image is an online free tool to convert images into Grayscale.");
        $this->migrator->add("tool-image-to-grayscale.metaKeywords", "");

        $this->migrator->add('tool-slugs.ImageToGrayscale', 'image-to-grayscale');
    }

    public function down() : void
    {
        $this->migrator->delete('tool-image-to-grayscale.enabled');
        $this->migrator->delete('tool-image-to-grayscale.title');
        $this->migrator->delete('tool-image-to-grayscale.summary');
        $this->migrator->delete('tool-image-to-grayscale.description');

        $this->migrator->delete('tool-image-to-grayscale.metaDescription');
        $this->migrator->delete('tool-image-to-grayscale.metaKeywords');

        $this->migrator->delete('tool-slugs.ImageToGrayscale');
    }
}
