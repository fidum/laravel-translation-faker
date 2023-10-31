# Generates pseudo language files from another locale to make it easy to see what still needs translating.

[![Latest Version on Packagist](https://img.shields.io/packagist/v/fidum/laravel-translation-faker.svg?style=for-the-badge)](https://packagist.org/packages/fidum/laravel-translation-faker)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/fidum/laravel-translation-faker/run-tests.yml?branch=main&label=tests&style=for-the-badge)](https://github.com/fidum/laravel-translation-faker/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/fidum/laravel-translation-faker/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=for-the-badge)](https://github.com/fidum/laravel-translation-faker/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/fidum/laravel-translation-faker.svg?style=for-the-badge)](https://packagist.org/packages/fidum/laravel-translation-faker)
[![Twitter Follow](https://img.shields.io/badge/follow-%40danmasonmp-1DA1F2?logo=twitter&style=for-the-badge)](https://twitter.com/danmasonmp)

Having a fake language that reads in your native language can make it easier to keep tracking of what is 
missing translation as you make changes to your project.

## Installation

You can install the package via composer:

```bash
composer require fidum/laravel-translation-faker
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="translation-faker-config"
```

[Click here to see the contents of the config file](config/translation-faker.php).

You should read through the config, which serves as additional documentation and make changes as needed.

## Usage

Just simply run the command with the first argument being the fake locale name you want to use.

```sh
$ php artisan translation:fake --help

Usage:
  translation:fake [options] [--] <locale>

Arguments:
  locale                         The output locale to store faked language files.

Options:
  -b, --baseLocale[=BASELOCALE]  The base locale to copy language files from.
  ...
  -v|vv|vvv, --verbose           Increase the verbosity of messages: 1 for normal output, 2 for more verbose output and 3 for debug
```

If you are going to display this fake language on your system and are planning to also use the locale
to control date / currency formats then I recommend that you use a real locale as your fake language.

For example, below our fake language will be generated using the danish `da` locale:
```sh
$ php artisan translation:fake da

   INFO  Translations successfully generated from 'en' to 'da'.  

```

By default the locale the command will come from will be from the`translation-faker.default` value 
(which is defaulted to `en`).

If you want to use a different base locale when running the command then you can provide it using the 
`--baseLocale=de` or shorthand `--bde`.

```sh
$ php artisan translation:fake da --baseLocale=de

   INFO  Translations successfully generated from 'de' to 'da'.  

```
**Note:** You must configure your replacer for the custom locale in `translation-faker.replacers` config.

You can get more verbose output using the `-v` option:
```sh
$ php artisan translation:fake da -v

Ensuring directory exists lang/ ......................................................................................................... 0ms DONE
Writing to lang/da.json ................................................................................................................. 0ms DONE
Ensuring directory exists lang/da/ ...................................................................................................... 0ms DONE
Writing to lang/da/example.php .......................................................................................................... 0ms DONE
Ensuring directory exists lang/da/folder/ ............................................................................................... 0ms DONE
Writing to lang/da/folder/example.php ................................................................................................... 0ms DONE

INFO  Translations successfully generated from 'en' to 'da'.  

```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Dan Mason](https://github.com/fidum)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
