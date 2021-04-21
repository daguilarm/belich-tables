# Attributes

The attributes that you can use in a table component are described below:

| Method | Values | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $exportAllowedFormats | csv, xls, xlsx, pdf | `public array $exportAllowedFormats = ['pdf']`| Defines the file formats supported when exporting. |


$exportAllowedFormats = ['csv', 'xls', 'xlsx', 'pdf'] -> export allowedFormats

$exportFileName = 'data' -> file name when exporting the DB.


$refresh = false -> refresh the table each seconds.

$refreshInSeconds = 5 -> The table will refresh each 5 seconds. 


$showCheckboxes = true -> show the checkboxes in the table.

$showOffline = true -> offline message when there is no connection.

$showLoading = true -> show the loading indicador.


$paginationTheme = 'tailwind' -> The pagination theme used by Laravel

$showPagination = true -> show or hide pagination.


$showPerPage = true -> show the selector with the per page options.

$perPageOptions = [10, 25, 50, 100] -> Per page option displayed.

$perPage = 25 -> Per page option selected.


$showSearch = true -> show or hide the search box.

$searchDebounce = 350 -> Amount of time in ms to wait to send the search query and refresh the table.

$clearSearchButton = true -> Show or hide a button to clear the search box.


$sortField = 'id' -> The default sort field for the table.

$sortDirection = 'asc' -> The default sort direction for the table.


$showTableHead = true -> Show or hide the table head.

$showTableFooter = false  -> Show or hide the table footer.
