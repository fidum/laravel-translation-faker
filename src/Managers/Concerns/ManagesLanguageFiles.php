<?php

namespace Fidum\LaravelTranslationFaker\Managers\Concerns;

trait ManagesLanguageFiles
{
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
