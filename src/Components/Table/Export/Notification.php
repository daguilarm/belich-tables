<?php

declare(strict_types=1);

namespace Daguilarm\BelichTables\Components\Table\Export;

use Illuminate\Support\Str;

trait Notification
{
    /**
     * Download notification.
     */
    public function fileDownloadNotification(bool $response): void
    {
        if ($response) {
            // Success message
            session()->flash('message', ['success', trans('belich-tables::strings.messages.download.success'), Str::random(20)]);
        } else {
            // Error message
            session()->flash('message', ['danger', trans('belich-tables::strings.messages.download.error'), Str::random(20)]);;
        }
    }
}
