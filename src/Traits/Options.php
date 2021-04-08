<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Traits;

use Illuminate\Support\Arr;

trait Options
{
    /**
     * @var array
     */
    protected array $options = [];

    /**
     * @var array
     */
    protected array $optionDefaults = [
        'bootstrap' => [
            'classes' => [
                'buttons' => [
                    'export' => 'btn',
                ],
                'table' => 'table table-bordered table-striped',
                'thead' => null,
            ],
            'container' => true,
            'responsive' => true,
        ],
        'tailwindcss' => [
            'classes' => [
                'buttons' => [
                    'export' => 'btn',
                ],
                'table' => 'table table-bordered table-striped',
                'thead' => null,
            ],
            'container' => true,
            'responsive' => true,
        ],
    ];

    /**
     * Get the option
     */
    public function getOption(string $option): ?string
    {
        return Arr::dot($this->optionDefaults)[$option] ?? null;
    }

    /**
     * @param  array  $overrides
     */
    protected function setOptions(array $overrides = []): void
    {
        foreach ($overrides as $key => $value) {
            data_set($this->optionDefaults, $key, $value);
        }
    }
}
