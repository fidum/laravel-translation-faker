<?php

namespace Fidum\LaravelTranslationFaker\Factories;

use Fidum\LaravelTranslationFaker\Contracts\Factories\LanguageOutputFactory as LanguageOutputFactoryContract;
use Fidum\LaravelTranslationFaker\Managers\LanguageOutputFilenameFactoryManager;
use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

class LanguageOutputFactory implements LanguageOutputFactoryContract
{
    public function __construct(protected LanguageOutputFilenameFactoryManager $manager) {}

    public function getFilename(SplFileInfo $file, string $baseLocale, string $locale): string
    {
        $extension = $file->getExtension();

        if ($this->manager->isEnabled($extension)) {
            return $this->manager->driver($extension)->getFilename($file, $baseLocale, $locale);
        }

        return $file->getFilename();
    }

    public function getPath(SplFileInfo $file, string $baseLocale, string $locale): string
    {
        $filename = $this->getFilename($file, $baseLocale, $locale);
        $pathname = $this->getPathname($file, $baseLocale, $locale);

        return Str::of($pathname)->before($filename)->toString();
    }

    public function getPathname(SplFileInfo $file, string $baseLocale, string $locale): string
    {
        $filename = $this->getFilename($file, $baseLocale, $locale);

        return Str::of($file->getPathname())
            ->replace(
                [DIRECTORY_SEPARATOR.$baseLocale.DIRECTORY_SEPARATOR, $file->getFilename()],
                [DIRECTORY_SEPARATOR.$locale.DIRECTORY_SEPARATOR, $filename],
            )
            ->toString();
    }
}
