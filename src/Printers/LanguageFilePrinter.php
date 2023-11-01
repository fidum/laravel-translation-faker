<?php

namespace Fidum\LaravelTranslationFaker\Printers;

use Fidum\LaravelTranslationFaker\Contracts\Collections\TranslationCollection as TranslationCollectionContract;
use Fidum\LaravelTranslationFaker\Contracts\Printers\LanguageFilePrinter as LanguageFilePrinterContract;
use Fidum\LaravelTranslationFaker\Managers\LanguageFilePrinterManager;
use InvalidArgumentException;
use Symfony\Component\Finder\SplFileInfo;

class LanguageFilePrinter implements LanguageFilePrinterContract
{
    public function __construct(protected LanguageFilePrinterManager $manager) {}

    public function execute(SplFileInfo $file, TranslationCollectionContract $items): string
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
