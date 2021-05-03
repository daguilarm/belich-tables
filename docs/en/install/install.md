# Installation

You can install the package via composer:

```bash
composer require daguilarm/belich-tables
```

Or include in your `composer.json`:

```bash
"daguilarm/belich-tables": "^1.2"
```

or if you want to test...

```bash
"daguilarm/belich-tables": "@dev"
```

Publishing assets is mandatory for this package:

```bash
php artisan vendor:publish --provider="Daguilarm\BelichTables\BelichTablesServiceProvider"
```
