# Installation

You can install the package via composer:

```bash
composer require daguilarm/livewire-tables
```

Or include in your `composer.json`:

```bash
"daguilarm/livewire-tables": "^1.0"
```

Publishing assets **is mandatory** for this package:

```bash
php artisan vendor:publish --provider="Daguilarm\LivewireTables\LivewireTablesServiceProvider"
```
