<?php

namespace Fidum\LaravelTranslationFaker\Managers;

use Fidum\LaravelTranslationFaker\Contracts\Printers\LanguageFilePrinter;
use Fidum\LaravelTranslationFaker\Printers\JsonLanguageFilePrinter;
use Fidum\LaravelTranslationFaker\Printers\PhpLanguageFilePrinter;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Manager;

/**
 * @method LanguageFilePrinter driver(string $driver)
 */
class LanguageFilePrinterManager extends Manager
{
    protected const DRIVERS = [
        'json' => JsonLanguageFilePrinter::class,
        'php' => PhpLanguageFilePrinter::class,
    ];

    public function __construct(Container $container)
    {
        parent::__construct($container);

        foreach (static::DRIVERS as $driver => $readerClass) {
            $this->extend($driver, fn (Container $app) => $app->get($readerClass));
        }
    }

    public function getDefaultDriver()
    {
        return array_key_first($this->customCreators);
    }

    public function isEnabled(string $driver)
    {
        return array_key_exists($driver, $this->customCreators);
    }

    public function getEnabledDrivers()
    {
        return array_keys($this->customCreators);
    }
}
