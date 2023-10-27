<?php

namespace Fidum\LaravelTranslationFaker\Readers;

use Fidum\LaravelTranslationFaker\Contracts\Readers\LanguageFileReader as LanguageFileReaderContract;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Symfony\Component\Finder\SplFileInfo;

class JsonLanguageFileReader implements LanguageFileReaderContract
{
    public function execute(SplFileInfo $file): Collection
    {
        $translations = json_decode($file->getContents(), true);

        if (! is_array($translations)) {
            throw new InvalidArgumentException("Unable to extract an array from {$file->getPathname()}!");
        }

        return new Collection($translations);
    }
}
