<?php

namespace Fidum\LaravelTranslationFaker\Contracts\Printers;

use Fidum\LaravelTranslationFaker\Contracts\Collections\TranslationCollection as TranslationCollectionContract;
use Symfony\Component\Finder\SplFileInfo;

interface LanguageFilePrinter
{
    public function execute(SplFileInfo $file, TranslationCollectionContract $items): string;
}
