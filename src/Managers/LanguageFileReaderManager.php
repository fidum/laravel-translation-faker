<?php

namespace Fidum\LaravelTranslationFaker\Managers;

use Fidum\LaravelTranslationFaker\Contracts\Readers\LanguageFileReader;
use Fidum\LaravelTranslationFaker\Readers\JsonLanguageFileReader;
use Fidum\LaravelTranslationFaker\Readers\PhpLanguageFileReader;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Manager;

/**
 * @method LanguageFileReader driver(string $driver)
 */
class LanguageFileReaderManager extends Manager
{
    private const DRIVERS = [
        'json' => JsonLanguageFileReader::class,
        'php' => PhpLanguageFileReader::class,
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
