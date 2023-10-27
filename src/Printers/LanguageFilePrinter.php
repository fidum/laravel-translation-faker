<?php

namespace Fidum\LaravelTranslationFaker\Printers;

use Fidum\LaravelTranslationFaker\Contracts\Printers\LanguageFilePrinter as LanguageFilePrinterContract;
use Fidum\LaravelTranslationFaker\Managers\LanguageFilePrinterManager;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Symfony\Component\Finder\SplFileInfo;

class LanguageFilePrinter implements LanguageFilePrinterContract
{
    protected const JSON_OPTIONS = JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE;

    public function __construct(protected LanguageFilePrinterManager $manager)
    {
    }

    public function execute(SplFileInfo $file, Collection $items): string
    {
        $extension = $file->getExtension();
        $translations = '';

        if ($this->manager->isEnabled($extension)) {
            $translations = $this->manager->driver($extension)->execute($file, $items);
        }

        if (! $translations) {
            throw new InvalidArgumentException("Unable to print any data from {$file->getPathname()}!");
        }

        return $translations;
    }
}
