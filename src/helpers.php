<?php

declare(strict_types=1);

/**
 * Get the route base on the action.
 */
if (! function_exists('routeAction')) {
    function routeAction(string $root, string $action, int $id): string
    {
        return route(sprintf('%s.%s', $root, $action), $id);
    }
}
