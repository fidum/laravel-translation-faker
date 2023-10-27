<?php

namespace Fidum\LaravelTranslationFaker;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Fidum\LaravelTranslationFaker\Commands\LaravelTranslationFakerCommand;

class LaravelTranslationFakerServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-translation-faker')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel-translation-faker_table')
            ->hasCommand(LaravelTranslationFakerCommand::class);
    }
}
