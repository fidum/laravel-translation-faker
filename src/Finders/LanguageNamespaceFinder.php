<?php

namespace Fidum\LaravelTranslationFaker\Finders;

use Fidum\LaravelTranslationFaker\Contracts\Finders\LanguageNamespaceFinder as LanguageNamespaceFinderContract;
use Illuminate\Contracts\Translation\Translator;
use Illuminate\Support\Collection;

readonly class LanguageNamespaceFinder implements LanguageNamespaceFinderContract
{
    public function __construct(protected Translator $translator) {}

    public function execute(): Collection
    {
        $namespacesCollection = new Collection();

        // Get Translator namespaces
        $loader = $this->translator->getLoader();

        foreach ($loader->namespaces() as $hint => $path) {
            if (str_starts_with($path, lang_path())) {
                $namespacesCollection->put($hint, $path);
            }
        }

        // Add default namespace
        $namespacesCollection->put('', lang_path());

        // Return namespaces collection after removing non existing paths
        return $namespacesCollection->filter(function ($path) {
            return file_exists($path) ? $path : false;
        });
    }
}
