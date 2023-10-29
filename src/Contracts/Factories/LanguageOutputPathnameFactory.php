<?php

namespace Fidum\LaravelTranslationFaker\Contracts\Factories;

use Symfony\Component\Finder\SplFileInfo;

interface LanguageOutputPathnameFactory
{
    public function getPathname(SplFileInfo $file, string $baseLocale, string $locale): string;
}
