<?php

namespace Fidum\LaravelTranslationFaker\Commands;

use Fidum\LaravelTranslationFaker\Contracts\Factories\LanguageOutputFactory;
use Fidum\LaravelTranslationFaker\Contracts\Finders\LanguageFileFinder;
use Fidum\LaravelTranslationFaker\Contracts\Printers\LanguageFilePrinter;
use Fidum\LaravelTranslationFaker\Finders\LanguageNamespaceFinder;
use Fidum\LaravelTranslationFaker\Readers\LanguageFileReader;
use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\SplFileInfo;

class FakeTranslationCommand extends Command
{
    public $signature = 'translation:fake
        {locale : The output locale to store faked language files.}
        {--b|baseLocale= : The base locale to copy language files from.}';

    public $description = 'My command';

    public function handle(
        LanguageFileFinder $finder,
        LanguageFilePrinter $printer,
        LanguageFileReader $reader,
        LanguageNamespaceFinder $namespaceFinder,
        LanguageOutputFactory $factory,
        Filesystem $filesystem,
    ): int {
        $locale = $this->argument('locale');
        $baseLocale = $this->option('baseLocale') ?: config('translation-faker.default');
        $replacers = Arr::wrap(config('translation-faker.replacers'));
        $namespaces = $namespaceFinder->execute();

        if (! array_key_exists($baseLocale, $replacers)) {
            $this->components->error("Please add $baseLocale base locale to replacer configuration.");

            return self::FAILURE;
        }

        $replacers = $replacers[$baseLocale];

        foreach ($namespaces as $path) {
            $files = $finder->execute($path, $baseLocale);

            /** @var SplFileInfo $file */
            foreach ($files as $file) {
                $outputPath = $factory->getPath($file, $baseLocale, $locale);
                $outputPathname = $factory->getPathname($file, $baseLocale, $locale);

                $this->components->task(
                    "Ensuring directory exists $outputPath",
                    fn () => $filesystem->ensureDirectoryExists($outputPath),
                    OutputInterface::VERBOSITY_DEBUG,
                );

                $translations = $reader
                    ->execute($file)
                    ->dot()
                    ->mapWithKeys(fn ($langLine, $langKey) => [$langKey => $this->convertToUmlaut($replacers, $langLine)])
                    ->undot();

                $this->components->task(
                    "Writing to $outputPathname",
                    fn () => $filesystem->put($outputPathname, $printer->execute($file, $translations)),
                    OutputInterface::VERBOSITY_DEBUG,
                );
            }
        }

        $this->components->info("Translations successfully generated from '$baseLocale' to '$locale'.");

        return self::SUCCESS;
    }

    private function convertToUmlaut(array $replacers, string $text): string
    {
        $str = Str::of($text)->explode(' ')->map(fn ($string) => Str::match('/:\w+/', $string)
            ? $string
            : Str::replace(array_keys($replacers), array_values($replacers), $string));

        return $str->implode(' ');
    }
}
