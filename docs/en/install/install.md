# Installation

You can install the package via composer:

```bash
composer require daguilarm/belich-tables
```

Or include in your `composer.json`:

```bash
"daguilarm/belich-tables": "^1.0"
```

Publishing assets **is mandatory** for this package:

```bash
php artisan vendor:publish --provider="Daguilarm\BelichTables\BelichTablesServiceProvider"
```
