<?php

/**
 * Get the route base on the action.
 */
if (! function_exists('routeAction')) {
    function routeAction(string $root, string $action, string | object $model): string
    {
        return route(sprintf('%s.%s', $root, $action), $model);
    }
}
