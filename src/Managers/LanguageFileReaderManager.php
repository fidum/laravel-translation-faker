<?php

namespace Fidum\LaravelTranslationFaker\Managers;

use Fidum\LaravelTranslationFaker\Contracts\Readers\LanguageFileReader;
use Fidum\LaravelTranslationFaker\Readers\JsonLanguageFileReader;
use Fidum\LaravelTranslationFaker\Readers\PhpLanguageFileReader;

/**
 * @method LanguageFileReader driver(string $driver)
 */
class LanguageFileReaderManager extends LanguageManager
{
    protected static function drivers(): array
    {
        return [
            'json' => JsonLanguageFileReader::class,
            'php' => PhpLanguageFileReader::class,
        ];
    }
}
