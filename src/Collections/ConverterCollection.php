<?php

namespace Fidum\LaravelTranslationFaker\Collections;

use Fidum\LaravelTranslationFaker\Contracts\Collections\ConverterCollection as ConverterCollectionContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ConverterCollection extends Collection implements ConverterCollectionContract
{
    public function convert(string $text): string
    {
        $sorted = $this->sortKeysByLength();
        $keys = $sorted->keys()->toArray();
        $pattern = sprintf('/:([a-zA-Z0-9_]+)|(%s)/', implode('|', array_map('preg_quote', $keys)));

        return Str::replaceMatches($pattern, function ($match) use ($sorted) {
            return $sorted->get($match[0]) ?? $match[0];
        }, $text);
    }

    private function sortKeysByLength(): static
    {
        return $this->sort(fn ($a, $b) => [Str::length($b) - Str::length($a), $a]);
    }
}
