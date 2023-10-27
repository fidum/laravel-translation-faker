<?php

namespace Fidum\LaravelTranslationFaker\Commands;

use Illuminate\Console\Command;

class LaravelTranslationFakerCommand extends Command
{
    public $signature = 'laravel-translation-faker';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
