<?php

namespace Fidum\LaravelTranslationFaker\Readers;

use Fidum\LaravelTranslationFaker\Collections\PhpTranslationCollection;
use Fidum\LaravelTranslationFaker\Contracts\Collections\TranslationCollection as TranslationCollectionContract;
use Fidum\LaravelTranslationFaker\Contracts\Readers\LanguageFileReader as LanguageFileReaderContract;
use InvalidArgumentException;
use Symfony\Component\Finder\SplFileInfo;

class PhpLanguageFileReader implements LanguageFileReaderContract
{
    public function execute(SplFileInfo $file): TranslationCollectionContract
    {
        $translations = include $file->getPathname();

        if (! is_array($translations)) {
            throw new InvalidArgumentException("Unable to extract an array from {$file->getPathname()}!");
        }

        return PhpTranslationCollection::wrap($translations);
    }
}
