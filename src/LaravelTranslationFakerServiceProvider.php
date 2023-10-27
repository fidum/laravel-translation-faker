<?php

namespace Fidum\LaravelTranslationFaker;

use Fidum\LaravelTranslationFaker\Commands\FakeTranslationCommand;
use Fidum\LaravelTranslationFaker\Contracts\Finders\LanguageFileFinder as LanguageFileFinderContract;
use Fidum\LaravelTranslationFaker\Contracts\Finders\LanguageNamespaceFinder as LanguageNamespaceFinderContract;
use Fidum\LaravelTranslationFaker\Contracts\Printers\LanguageFilePrinter as LanguageFilePrinterContract;
use Fidum\LaravelTranslationFaker\Contracts\Readers\LanguageFileReader as LanguageFileReaderContract;
use Fidum\LaravelTranslationFaker\Finders\LanguageFileFinder;
use Fidum\LaravelTranslationFaker\Finders\LanguageNamespaceFinder;
use Fidum\LaravelTranslationFaker\Managers\LanguageFilePrinterManager;
use Fidum\LaravelTranslationFaker\Managers\LanguageFileReaderManager;
use Fidum\LaravelTranslationFaker\Printers\LanguageFilePrinter;
use Fidum\LaravelTranslationFaker\Readers\LanguageFileReader;
use Illuminate\Contracts\Support\DeferrableProvider;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelTranslationFakerServiceProvider extends PackageServiceProvider implements DeferrableProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-translation-faker')
            ->hasConfigFile()
            ->hasCommand(FakeTranslationCommand::class);
    }

    public function registeringPackage()
    {
        $this->app->bind(LanguageFileFinderContract::class, LanguageFileFinder::class);

        $this->app->bind(LanguageFilePrinterContract::class, LanguageFilePrinter::class);

        $this->app->bind(LanguageFileReaderContract::class, LanguageFileReader::class);

        $this->app->scoped(LanguageFilePrinterManager::class, LanguageFilePrinterManager::class);

        $this->app->scoped(LanguageFileReaderManager::class, LanguageFileReaderManager::class);

        $this->app->bind(LanguageNamespaceFinderContract::class, LanguageNamespaceFinder::class);
    }

    public function provides()
    {
        return [
            LanguageFileFinderContract::class,
            LanguageFilePrinterContract::class,
            LanguageFileReaderContract::class,
            LanguageFilePrinterManager::class,
            LanguageFileReaderManager::class,
            LanguageNamespaceFinderContract::class,
        ];
    }
}
