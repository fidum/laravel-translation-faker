<?php

namespace Fidum\LaravelTranslationFaker\Collections;

use Fidum\LaravelTranslationFaker\Contracts\Collections\ConverterCollection as ConverterCollectionContract;
use Fidum\LaravelTranslationFaker\Contracts\Collections\TranslationCollection as TranslationCollectionContract;
use Illuminate\Support\Collection;

class JsonTranslationCollection extends Collection implements TranslationCollectionContract
{
    public function convert(ConverterCollectionContract $converter): TranslationCollectionContract
    {
        return $this->mapWithKeys(fn ($langLine, $langKey) => [
            $langKey => $converter->convert($langLine),
        ]);
    }
}
