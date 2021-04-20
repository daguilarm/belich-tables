<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Components\Filters;

use App\Models\User;
use Daguilarm\LivewireTables\Components\FilterComponent;
use Daguilarm\LivewireTables\Facades\LivewireTables;
use Illuminate\Database\Eloquent\Builder;

final class FilterByUser extends FilterComponent
{
    /**
     * Create a new field.
     */
    public function __construct(?string $name = null)
    {
        parent::__construct($name);

        $this->view = LivewireTables::include('includes.options.filters.user');
        $this->tableColumn = 'id';
        $this->name = $name ?? 'user';
    }

    /**
     * Set the filter query.
     *
     * @param string | int | null $value
     */
    public function query(Builder $model, $value): Builder
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
    public function values(): array
    {
        return User::select('users.id', 'users.name')
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
    }
}
