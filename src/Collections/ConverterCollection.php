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

        // Create a regex pattern that matches placeholders and HTML tags
        $pattern = sprintf(
            '/(:[A-z0-9_]+)|(<[^>]*>)|(%s)/',
            implode('|', array_map('preg_quote', $keys))
        );

        return preg_replace_callback($pattern, function ($match) use ($sorted) {
            // If it's a placeholder, leave it as is
            if (! empty($match[1])) {
                return $match[1];
            }

            // If it's an HTML tag, preserve it
            if (! empty($match[2])) {
                return $match[2];
            }

            // Otherwise, perform the replacements
            return $sorted->get($match[0]) ?: $match[0];
        }, $text);
    }
}
