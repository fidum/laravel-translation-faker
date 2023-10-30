<?php

namespace Fidum\LaravelTranslationFaker\Printers;

use Fidum\LaravelTranslationFaker\Contracts\Collections\TranslationCollection as TranslationCollectionContract;
use Fidum\LaravelTranslationFaker\Contracts\Printers\LanguageFilePrinter as LanguageFilePrinterContract;
use Symfony\Component\Finder\SplFileInfo;

class JsonLanguageFilePrinter implements LanguageFilePrinterContract
{
    protected const JSON_OPTIONS = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;

    public function execute(SplFileInfo $file, TranslationCollectionContract $items): string
    {
        return $items->toJson(static::JSON_OPTIONS);
    }
}
