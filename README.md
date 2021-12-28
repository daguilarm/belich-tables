![Package Logo](https://banners.beyondco.de/Belich%20Tables.png?theme=light&packageManager=composer+require&packageName=daguilarm%2Fbelich-tables&pattern=bamboo&style=style_1&description=Manage+your+tables+with+Laravel+Livewire&md=1&showWatermark=0&fontSize=100px&images=template)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/daguilarm/belich-tables.svg?style=flat-square)](https://packagist.org/packages/daguilarm/belich-tables)
[![StyleCI](https://styleci.io/repos/361343056/shield?style=plastic)](https://github.styleci.io/repos/361343056)
![GitHub last commit](https://img.shields.io/github/last-commit/daguilarm/belich-tables)
<!-- [![Total Downloads](https://img.shields.io/packagist/dt/daguilarm/belich-tables.svg?style=flat-square)](https://packagist.org/packages/daguilarm/belich-tables) -->

# Belich Tables: a datatable package for Laravel Livewire

Belich Tables is a Laravel package base on Livewire and AlpineJS that allows you to create scaffold datatables with search, column sort, filters, pagination, etc...

## Important 
This repository is not longer update... sorry I have no time.

## Requirements

This package need at least:

- PHP ^8.0
- Laravel ^8.0
- Laravel Livewire ^2.0 | ^2.5
- AlpineJS ^2.0 | ^3.0
- TailwindCSS ^2.0

## Installation

You can install the package via composer:

    composer require daguilarm/belich-tables

Or include in your `composer.json`:

    "daguilarm/belich-tables": "^1.2"

Or if you want to test...

    "daguilarm/belich-tables": "@dev"

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
