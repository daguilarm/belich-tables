<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Table;

/**
 * This are testing methods.
 */
trait Testing
{
    /**
     * @var array<string>.
     */
    public array $totalResultsForTesting = [];

    /**
     * Get the total results.
     */
    public function typeSearchForTesting(string $search): self
    {
        if (app()->environment() === 'testing') {
            $this->search = $search;
        }

        return $this;
    }

    /**
     * Get the total results as array.
     */
    public function totalResultsForTesting(): self
    {
        if (app()->environment() === 'testing') {
            $this->totalResultsForTesting = $this->models()->get()->toArray();
        }

        return $this;
    }
}
