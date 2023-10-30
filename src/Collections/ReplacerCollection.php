<?php

namespace Fidum\LaravelTranslationFaker\Collections;

use Fidum\LaravelTranslationFaker\Contracts\Collections\ConverterCollection as ConverterCollectionContract;
use Fidum\LaravelTranslationFaker\Contracts\Collections\ReplacerCollection as ReplacerCollectionContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ReplacerCollection extends Collection implements ReplacerCollectionContract
{
    public function toConverterCollection(string $locale): ConverterCollectionContract
    {
        if ($this->has($locale)) {
            return app(ConverterCollectionContract::class, [
                'items' => Arr::wrap($this->get($locale)),
            ]);
        }

        throw new \InvalidArgumentException("Please add '$locale' locale to replacer configuration.");
    }
}
