<?php

namespace Fidum\LaravelTranslationFaker\Managers;

use Fidum\LaravelTranslationFaker\Contracts\Factories\LanguageOutputFilenameFactory;
use Fidum\LaravelTranslationFaker\Factories\JsonLanguageOutputFilenameFactory;

/**
 * @method LanguageOutputFilenameFactory driver(string $driver)
 */
class LanguageOutputFilenameFactoryManager extends LanguageManager
{
    protected static function drivers(): array
    {
        return [
            'json' => JsonLanguageOutputFilenameFactory::class,
        ];
    }
}
