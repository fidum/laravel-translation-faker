<?php

namespace Fidum\LaravelTranslationFaker\Readers;

use Fidum\LaravelTranslationFaker\Contracts\Collections\TranslationCollection as TranslationCollectionContract;
use Fidum\LaravelTranslationFaker\Contracts\Readers\LanguageFileReader as LanguageFileReaderContract;
use InvalidArgumentException;
use Symfony\Component\Finder\SplFileInfo;

class PhpLanguageFileReader implements LanguageFileReaderContract
{
    public function __construct(private TranslationCollectionContract $translations) {}

    public function execute(SplFileInfo $file): TranslationCollectionContract
    {
        $translations = include $file->getPathname();

        if (! is_array($translations)) {
            throw new InvalidArgumentException("Unable to extract an array from {$file->getPathname()}!");
        }

        return $this->translations->merge($translations);
    }
}
