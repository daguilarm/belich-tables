<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Facades;

use Illuminate\Support\Facades\Facade;

final class LivewireTables extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'LivewireTables';
    }
}
