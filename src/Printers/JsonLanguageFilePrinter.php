<?php

namespace Fidum\LaravelTranslationFaker\Printers;

use Fidum\LaravelTranslationFaker\Contracts\Printers\LanguageFilePrinter as LanguageFilePrinterContract;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\SplFileInfo;

class JsonLanguageFilePrinter implements LanguageFilePrinterContract
{
    protected const JSON_OPTIONS = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;

    public function execute(SplFileInfo $file, Collection $items): string
    {
        return json_encode($items, static::JSON_OPTIONS);
    }
}
