<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Facades;

use Illuminate\Support\Facades\Facade;

final class BelichTables extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'BelichTables';
    }
}
