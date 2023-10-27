<?php

namespace Fidum\LaravelTranslationFaker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Fidum\LaravelTranslationFaker\LaravelTranslationFaker
 */
class LaravelTranslationFaker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Fidum\LaravelTranslationFaker\LaravelTranslationFaker::class;
    }
}
