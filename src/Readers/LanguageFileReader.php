<?php

namespace Fidum\LaravelTranslationFaker\Readers;

use Fidum\LaravelTranslationFaker\Contracts\Collections\TranslationCollection as TranslationCollectionContract;
use Fidum\LaravelTranslationFaker\Contracts\Readers\LanguageFileReader as LanguageFileReaderContract;
use Fidum\LaravelTranslationFaker\Managers\LanguageFileReaderManager;
use InvalidArgumentException;
use Symfony\Component\Finder\SplFileInfo;

class LanguageFileReader implements LanguageFileReaderContract
{
    public function __construct(
        protected LanguageFileReaderManager $manager,
    ) {}

    public function execute(SplFileInfo $file): TranslationCollectionContract
    {
        $extension = $file->getExtension();

        if ($this->manager->isEnabled($extension)) {
            $translations = $this->manager->driver($extension)->execute($file);

            if ($translations->isEmpty()) {
                throw new InvalidArgumentException("Unable to extract any data from {$file->getPathname()}!");
            }

            return $translations;
        }

        throw new InvalidArgumentException("We do not support $extension file extension!");
    }
}
