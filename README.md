![Package Logo](https://banners.beyondco.de/Belich%20Tables.png?theme=light&packageManager=composer+require&packageName=daguilarm%2Fbelich-tables&pattern=bamboo&style=style_1&description=Manage+your+tables+with+Laravel+Livewire&md=1&showWatermark=0&fontSize=100px&images=template)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/daguilarm/belich-tables.svg?style=flat-square)](https://packagist.org/packages/daguilarm/belich-tables)
[![StyleCI](https://styleci.io/repos/354914653/shield?style=plastic)](https://github.styleci.io/repos/354914653)
[![Total Downloads](https://img.shields.io/packagist/dt/daguilarm/belich-tables.svg?style=flat-square)](https://packagist.org/packages/daguilarm/belich-tables)
![GitHub last commit](https://img.shields.io/github/last-commit/daguilarm/belich-tables)

## Requirements

This package need at least:

- PHP ^8.0
- Laravel ^8.0
- Laravel Livewire ^2.0
- AlpineJS ^2.0
- TailwindCSS ^2.0

## Installation

You can install the package via composer:

    composer require daguilarm/belich-tables

Or include in your `composer.json`:

    "daguilarm/belich-tables": "^1.0"

## Publishing Assets

Publishing assets are mandatory for this package:

    php artisan vendor:publish --provider="Daguilarm\BelichTables\BelichTablesServiceProvider"

## Documentation

https://daguilarm.github.io/belich-tables/

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email damian.aguilarm@gmail.com instead of using the issue tracker.

## Credits

- [Damián Aguilar](https://github.com/daguilarm)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
