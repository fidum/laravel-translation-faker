<?php

namespace Fidum\LaravelTranslationFaker\Managers;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Manager;

abstract class LanguageManager extends Manager
{
    public function __construct(Container $container)
    {
        parent::__construct($container);

        foreach (static::drivers() as $driver => $readerClass) {
            $this->extend($driver, fn (Container $app) => $app->get($readerClass));
        }
    }

    public function getDefaultDriver()
    {
        return array_key_first($this->customCreators);
    }

    public function getEnabledDrivers()
    {
        return array_keys($this->customCreators);
    }

    public function isEnabled(string $driver)
    {
        return array_key_exists($driver, $this->customCreators);
    }

    abstract protected static function drivers(): array;
}
