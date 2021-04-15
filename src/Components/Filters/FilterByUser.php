<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Filters;

use App\Models\User;
use Daguilarm\LivewireTables\Components\FilterComponent;
use Illuminate\Database\Eloquent\Builder;

class FilterByUser extends FilterComponent
{
    /**
     * Create a new field.
     */
    public function __construct($name)
    {
        parent::__construct($name);

        $this->view = 'livewire-tables::'.config('livewire-tables.theme').'.includes.options.filters.user';
        $this->tableColumn = 'id';
    }

    /**
     * Set the filter query.
     */
    public function query(Builder $model, ?string $value): Builder
    {
        return $model->where(
            $this->tableColumn,
            $value
        );
    }

    /**
     * Set the filter query.
     */
    public function values(): array
    {
        return User::all()
            ->pluck('name', 'id')
            ->toArray();
    }
}
