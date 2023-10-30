<?php

namespace Fidum\LaravelTranslationFaker\Contracts\Readers;

use Fidum\LaravelTranslationFaker\Contracts\Collections\TranslationCollection as TranslationCollectionContract;
use Symfony\Component\Finder\SplFileInfo;

interface LanguageFileReader
{
    public function execute(SplFileInfo $file): TranslationCollectionContract;
}
