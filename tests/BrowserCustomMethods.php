<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Tests;

use Facebook\WebDriver\WebDriverBy;
use Laravel\Dusk\Browser;

trait BrowserCustomMethods
{
    /**
     * Get table selector base on position.
     */
    public function getTablePositionSelector(int $position): string
    {
        return sprintf('table > tbody > tr:nth-child(%s)', $position);
    }

    /**
     * Get the total rows for the table.
     */
    public function getTotalTableRows(Browser $browser): int
    {
        $rows = $browser
            ->driver
            ->findElements(WebDriverBy::cssSelector('table > tbody > tr'));

        return count($rows);
    }
}
