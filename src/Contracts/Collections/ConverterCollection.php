<?php

namespace Fidum\LaravelTranslationFaker\Contracts\Collections;

use Illuminate\Support\Enumerable;

interface ConverterCollection extends Enumerable
{
    public function convert(string $text): string;
}
