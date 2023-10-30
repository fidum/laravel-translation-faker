<?php

namespace Fidum\LaravelTranslationFaker\Contracts\Collections;

use Fidum\LaravelTranslationFaker\Contracts\Collections\ConverterCollection as ConverterCollectionContract;
use Illuminate\Support\Enumerable;

interface ReplacerCollection extends Enumerable
{
    public function toConverterCollection(string $locale): ConverterCollectionContract;
}
