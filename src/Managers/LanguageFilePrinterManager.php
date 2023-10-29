<?php

namespace Fidum\LaravelTranslationFaker\Managers;

use Fidum\LaravelTranslationFaker\Contracts\Printers\LanguageFilePrinter;
use Fidum\LaravelTranslationFaker\Printers\JsonLanguageFilePrinter;
use Fidum\LaravelTranslationFaker\Printers\PhpLanguageFilePrinter;

/**
 * @method LanguageFilePrinter driver(string $driver)
 */
class LanguageFilePrinterManager extends LanguageManager
{
    protected static function drivers(): array
    {
        return [
            'json' => JsonLanguageFilePrinter::class,
            'php' => PhpLanguageFilePrinter::class,
        ];
    }
}
