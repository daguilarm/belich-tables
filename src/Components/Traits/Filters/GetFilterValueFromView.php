<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Traits\Filters;

use Illuminate\Support\Collection;

class GetFilterValueFromView
{
    /**
     * Get the filter value from the view (from selection).
     *
     * @param array<string> $values
     */
    public function handle(Collection $filter, array $values): string | array | null
    {
        // Get the filter name
        $filterName = $this->getFilterName($filter);

        // Get current filter value from the list: [$values = $this->filterValues[]]
        $value = $values[$filterName] ?? null;

        // Get the filter value
        return $value ?? null;
    }

    /**
     * Get filter name.
     */
    private function getFilterName(Collection $filter): ?string
    {
        return $filter?->get('name');
    }
}
