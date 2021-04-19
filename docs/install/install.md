# Installation

You can install the package via composer:

    composer require daguilarm/livewire-tables

Or include in your `composer.json`:

    "daguilarm/livewire-tables": "^1.0"

Publishing assets **is mandatory** for this package:

    php artisan vendor:publish --provider="Daguilarm\LivewireTables\LivewireTablesServiceProvider"
