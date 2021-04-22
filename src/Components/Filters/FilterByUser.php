<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Filters;

use App\Models\User;
use Daguilarm\BelichTables\Components\FilterComponent;
use Daguilarm\BelichTables\Facades\BelichTables;
use Illuminate\Database\Eloquent\Builder;

final class FilterByUser extends FilterComponent
{
    /**
     * Create a new field.
     */
    public function __construct(?string $name = null)
    {
        parent::__construct($name);

        $this->view = BelichTables::include('includes.options.filters.user');
        $this->tableColumn = 'id';
        $this->name = $name ?? 'user';
    }

    /**
     * Set the filter query.
     *
     * @param int | float | string | null $value
     */
    public function apply(Builder $model, $value): Builder
    {
        return $model->where(
            $this->getColumn($model),
            $value,
        );
    }

    /**
     * Set the filter query.
     *
     * @return  array<string>
     */
    public function options(): array
    {
        return User::select('users.id', 'users.name')
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
    }
}
