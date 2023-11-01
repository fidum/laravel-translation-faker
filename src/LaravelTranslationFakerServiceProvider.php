<?php

namespace Fidum\LaravelTranslationFaker;

use Fidum\LaravelTranslationFaker\Collections\ConverterCollection;
use Fidum\LaravelTranslationFaker\Collections\ReplacerCollection;
use Fidum\LaravelTranslationFaker\Commands\FakeTranslationCommand;
use Fidum\LaravelTranslationFaker\Contracts\Collections\ConverterCollection as ConverterCollectionContract;
use Fidum\LaravelTranslationFaker\Contracts\Collections\ReplacerCollection as ReplacerCollectionContract;
use Fidum\LaravelTranslationFaker\Contracts\Factories\LanguageOutputFactory as LanguageOutputFactoryContract;
use Fidum\LaravelTranslationFaker\Contracts\Finders\LanguageFileFinder as LanguageFileFinderContract;
use Fidum\LaravelTranslationFaker\Contracts\Finders\LanguageNamespaceFinder as LanguageNamespaceFinderContract;
use Fidum\LaravelTranslationFaker\Contracts\Printers\LanguageFilePrinter as LanguageFilePrinterContract;
use Fidum\LaravelTranslationFaker\Contracts\Readers\LanguageFileReader as LanguageFileReaderContract;
use Fidum\LaravelTranslationFaker\Factories\LanguageOutputFactory;
use Fidum\LaravelTranslationFaker\Finders\LanguageFileFinder;
use Fidum\LaravelTranslationFaker\Finders\LanguageNamespaceFinder;
use Fidum\LaravelTranslationFaker\Managers\LanguageFilePrinterManager;
use Fidum\LaravelTranslationFaker\Managers\LanguageFileReaderManager;
use Fidum\LaravelTranslationFaker\Managers\LanguageOutputFilenameFactoryManager;
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
        $this->app->bind(ConverterCollectionContract::class, ConverterCollection::class);

        $this->app->bind(LanguageFileFinderContract::class, LanguageFileFinder::class);

        $this->app->bind(LanguageFilePrinterContract::class, LanguageFilePrinter::class);

        $this->app->bind(LanguageFileReaderContract::class, LanguageFileReader::class);

        $this->app->scoped(LanguageFilePrinterManager::class, LanguageFilePrinterManager::class);

        $this->app->bind(LanguageOutputFactoryContract::class, LanguageOutputFactory::class);

        $this->app->scoped(LanguageOutputFilenameFactoryManager::class, LanguageOutputFilenameFactoryManager::class);

        $this->app->scoped(LanguageFileReaderManager::class, LanguageFileReaderManager::class);

        $this->app->bind(LanguageNamespaceFinderContract::class, LanguageNamespaceFinder::class);

        $this->app->bind(ReplacerCollectionContract::class, ReplacerCollection::class);
        $this->app->when(ReplacerCollection::class)
            ->needs('$items')
            ->giveConfig('translation-faker.replacers');
    }

    public function provides()
    {
        return [
            ConverterCollectionContract::class,
            LanguageFileFinderContract::class,
            LanguageFilePrinterContract::class,
            LanguageFileReaderContract::class,
            LanguageFilePrinterManager::class,
            LanguageFileReaderManager::class,
            LanguageNamespaceFinderContract::class,
            LanguageOutputFactoryContract::class,
            LanguageOutputFilenameFactoryManager::class,
            ReplacerCollectionContract::class,
        ];
    }
}
