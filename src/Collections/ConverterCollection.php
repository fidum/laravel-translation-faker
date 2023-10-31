<?php

namespace Fidum\LaravelTranslationFaker\Collections;

use Fidum\LaravelTranslationFaker\Contracts\Collections\ConverterCollection as ConverterCollectionContract;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ConverterCollection extends Collection implements ConverterCollectionContract
{
    public function convert(string $text): string
    {
        $sorted = $this->sortBy(fn ($value, $key) => [Str::length($key), $key]);
        $keys = $sorted->keys()->toArray();

        $pattern = sprintf(
            '/(:[A-z0-9_]+)|(<[^>]*>)|(%s)/',
            implode('|', array_map('preg_quote', $keys))
        );

        return preg_replace_callback($pattern, fn ($match) => collect([
            'placeholder' => $match[1] ?? null,
            'htmlTag' => $match[2] ?? null,
            'replaceable' => $sorted->get($match[0]) ?: $match[0]
        ])->filter()->first(), $text);
    }
}
