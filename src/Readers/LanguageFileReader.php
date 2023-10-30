<?php

namespace Fidum\LaravelTranslationFaker\Readers;

use Fidum\LaravelTranslationFaker\Contracts\Collections\TranslationCollection as TranslationCollectionContract;
use Fidum\LaravelTranslationFaker\Contracts\Readers\LanguageFileReader as LanguageFileReaderContract;
use Fidum\LaravelTranslationFaker\Managers\LanguageFileReaderManager;
use Illuminate\Support\Collection;
use InvalidArgumentException;
use Symfony\Component\Finder\SplFileInfo;

class LanguageFileReader implements LanguageFileReaderContract
{
    public function __construct(
        protected LanguageFileReaderManager $manager,
        protected TranslationCollectionContract $translations,
    ) {}

    public function execute(SplFileInfo $file): TranslationCollectionContract
    {
        $extension = $file->getExtension();
        $translations = new Collection();

        if ($this->manager->isEnabled($extension)) {
            $translations = $this->manager->driver($extension)->execute($file);

            if ($translations->isEmpty()) {
                throw new InvalidArgumentException("Unable to extract any data from {$file->getPathname()}!");
            }
        }

        return $this->translations->merge($translations);
    }
}
