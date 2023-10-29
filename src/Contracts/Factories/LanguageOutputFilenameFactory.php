<?php

namespace Fidum\LaravelTranslationFaker\Contracts\Factories;

use Symfony\Component\Finder\SplFileInfo;

interface LanguageOutputFilenameFactory
{
    public function getFilename(SplFileInfo $file, string $baseLocale, string $locale): string;
}
