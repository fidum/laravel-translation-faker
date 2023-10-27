<?php

namespace Fidum\LaravelTranslationFaker\Contracts\Finders;

use Illuminate\Support\Collection;

interface Finder
{
    public function execute(): Collection;
}
