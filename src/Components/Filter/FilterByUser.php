<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Filter;

use Daguilarm\BelichTables\Components\FilterComponent;
use Daguilarm\BelichTables\Facades\BelichTables;
use Illuminate\Database\Eloquent\Builder;

final class FilterByUser extends FilterComponent
{
    protected string $user_model = \App\Models\User::class;

    /**
     * Create a new field.
     */
    public function __construct(?string $uriKey = null)
    {
        parent::__construct($uriKey);

        // Set the view
        $this->view = BelichTables::include('sections.options.filters.user');
        // Set the default table column
        $this->tableColumn = 'id';
        // Set the unique key
        $this->uriKey = $uriKey ?? 'user';
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
        return app($this->user_model)
            ->select('users.id', 'users.name')
            ->orderBy('name')
            ->pluck('name', 'id')
            ->toArray();
    }

    /**
     * Set User model class.
     */
    public function userClass(string $class): self
    {
        $this->user_model = $class;

        return $this;
    }
}
