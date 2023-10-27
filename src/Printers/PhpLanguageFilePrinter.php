<?php

namespace Fidum\LaravelTranslationFaker\Printers;

use Fidum\LaravelTranslationFaker\Contracts\Printers\LanguageFilePrinter as LanguageFilePrinterContract;
use Illuminate\Support\Collection;
use Symfony\Component\Finder\SplFileInfo;

class PhpLanguageFilePrinter implements LanguageFilePrinterContract
{
    public function execute(SplFileInfo $file, Collection $items): string
    {
        $body = $this->build($items->toArray(), 1);

        return $this->print($body);
    }

    protected function build(array $array, int $indent): string
    {
        $lines = [];

        foreach ($array as $key => $value) {
            $indentedKey = str_repeat(' ', $indent * 4).var_export($key, true);

            if (is_array($value)) {
                $lines[] = $indentedKey.' => [';
                $lines[] = $this->build($value, $indent + 1);
                $lines[] = str_repeat(' ', $indent * 4).'],';
            } else {
                $lines[] = $indentedKey.' => '.var_export($value, true).',';
            }
        }

        return implode(PHP_EOL, $lines);
    }

    protected function print($body): string
    {
        return implode(PHP_EOL, [
            '<?php',
            '',
            'return [',
            $body,
            '];',
        ]);
    }
}
