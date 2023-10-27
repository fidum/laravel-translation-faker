<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Locale
    |--------------------------------------------------------------------------
    |
    | This is the default base locale used to copy the language files from. If
    | you change this value make sure to provide a matching "replacers" config
    | for that locale below.
    |
    */
    'default' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Locale Replacers
    |--------------------------------------------------------------------------
    |
    | The following lists the "replacers" that find the keys listed below and
    | replaces them with their mapped value. Please avoid using colon ':' in
    | this configuration as it may mess with our placeholder detection. Any
    | locales you want to use as the base language must be configured here.
    |
    | Note: This is case sensitive, so please provide replaces for different
    | cases as needed.
    |
    */
    'replacers' => [
        'en' => [
            'A' => 'Ä',
            'a' => 'ä',
            'E' => 'Ë',
            'e' => 'ë',
            'I' => 'Ï',
            'i' => 'ï',
            'O' => 'Ö',
            'o' => 'ö',
            'U' => 'Ü',
            'u' => 'ü',
        ],
    ],
];
