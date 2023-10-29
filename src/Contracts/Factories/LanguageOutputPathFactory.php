<?php

namespace Fidum\LaravelTranslationFaker\Contracts\Factories;

use Symfony\Component\Finder\SplFileInfo;

interface LanguageOutputPathFactory
{
    public function getPath(SplFileInfo $file, string $baseLocale, string $locale): string;
}
