<?php

namespace Fidum\LaravelTranslationFaker\Contracts\Printers;

use Illuminate\Support\Collection;
use Symfony\Component\Finder\SplFileInfo;

interface LanguageFilePrinter
{
    public function execute(SplFileInfo $file, Collection $items): string;
}
