<?php

namespace Fidum\LaravelTranslationFaker\Contracts\Readers;

use Illuminate\Support\Collection;
use Symfony\Component\Finder\SplFileInfo;

interface LanguageFileReader
{
    public function getTranslations(SplFileInfo $file): Collection;
}