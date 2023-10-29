<?php

namespace Fidum\LaravelTranslationFaker\Factories;

use Fidum\LaravelTranslationFaker\Contracts\Factories\LanguageOutputFilenameFactory as LanguageOutputFilenameFactoryContract;
use Symfony\Component\Finder\SplFileInfo;

class JsonLanguageOutputFilenameFactory implements LanguageOutputFilenameFactoryContract
{
    public function getFilename(SplFileInfo $file, string $baseLocale, string $locale): string
    {
        if ($file->getFilenameWithoutExtension() === $baseLocale) {
            return sprintf('%s.%s', $locale, $file->getExtension());
        }

        return $file->getFilename();
    }
}
