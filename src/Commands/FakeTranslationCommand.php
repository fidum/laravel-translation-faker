<?php

namespace Fidum\LaravelTranslationFaker\Commands;

use Fidum\LaravelTranslationFaker\Contracts\Collections\ReplacerCollection;
use Fidum\LaravelTranslationFaker\Contracts\Factories\LanguageOutputFactory;
use Fidum\LaravelTranslationFaker\Contracts\Finders\LanguageFileFinder;
use Fidum\LaravelTranslationFaker\Contracts\Printers\LanguageFilePrinter;
use Fidum\LaravelTranslationFaker\Finders\LanguageNamespaceFinder;
use Fidum\LaravelTranslationFaker\Readers\LanguageFileReader;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\SplFileInfo;

class FakeTranslationCommand extends Command
{
    public $signature = 'translation:fake
        {locale : The output locale to store faked language files.}
        {--b|baseLocale= : The base locale to copy language files from.}';

    public $description = 'Generates pseudo language files from another locale to make it easy to see what still needs translating.';

    public function handle(
        Filesystem $filesystem,
        LanguageFileFinder $languageFileFinder,
        LanguageFilePrinter $printer,
        LanguageFileReader $reader,
        LanguageNamespaceFinder $namespaceFinder,
        LanguageOutputFactory $factory,
        ReplacerCollection $replacers,
    ): int {
        $locale = $this->argument('locale');
        $baseLocale = $this->option('baseLocale') ?: config('translation-faker.default');
        $converter = $replacers->toConverterCollection($baseLocale);

        foreach ($namespaceFinder->execute() as $path) {
            $files = $languageFileFinder->execute($path, $baseLocale);

            /** @var SplFileInfo $file */
            foreach ($files as $file) {
                $outputPath = $factory->getPath($file, $baseLocale, $locale);
                $outputPathname = $factory->getPathname($file, $baseLocale, $locale);

                $this->components->task(
                    "Ensuring directory exists $outputPath",
                    fn () => $filesystem->ensureDirectoryExists($outputPath),
                    OutputInterface::VERBOSITY_VERBOSE,
                );

                $translations = $reader->execute($file)->convert($converter);

                $this->components->task(
                    "Writing to $outputPathname",
                    fn () => $filesystem->put($outputPathname, $printer->execute($file, $translations)),
                    OutputInterface::VERBOSITY_VERBOSE,
                );
            }
        }

        $this->components->info("Translations successfully generated from '$baseLocale' to '$locale'.");

        return self::SUCCESS;
    }
}
