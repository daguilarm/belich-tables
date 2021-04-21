<?php

declare(strict_types=1);

namespace Daguilarm\LivewireTables\Views\Traits;

trait ColumnType
{
    public string $type;

    /**
     * Convert value to boolean.
     */
    public function toBoolean(): self
    {
        $this->type = 'bool';

        return $this;
    }

    /**
     * Convert value to float.
     */
    public function toFloat(): self
    {
        $this->type = 'float';

        return $this;
    }

    /**
     * Convert value to integer.
     */
    public function toInteger(): self
    {
        $this->type = 'int';

        return $this;
    }

    /**
     * Convert value to object.
     */
    public function toObject(): self
    {
        $this->type = 'object';

        return $this;
    }

    /**
     * Convert value to string.
     */
    public function toString(): self
    {
        $this->type = 'string';

        return $this;
    }

    /**
     * Resolve the column.
     *
     * @param bool | int | float | object | string | null $value
     */
    protected function resolveType($value = null): bool | int | float | object | string | null
    {
        return $value && isset($this->type)
            ? settype($value, $this->type)
            : $value;
    }
}
