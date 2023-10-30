<?php

namespace Fidum\LaravelTranslationFaker\Contracts\Collections;

use Illuminate\Support\Enumerable;

interface TranslationCollection extends Enumerable
{
    public function convert(ConverterCollection $converter): self;
}
