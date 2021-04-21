# Attributes

The attributes that you can use in a Table Component are described below. These attributes have been classified by groups, in order to facilitate their management.

## Export attributes

| Method | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $exportAllowedFormats | csv, xls, xlsx, pdf | `public array $exportAllowedFormats = ['csv', 'pdf']`| Defines the file formats supported when exporting. |
| $exportFileName | data | `public string $exportFileName = 'data'`| Defines the file name for the exported file. |

## Table attributes

| Method | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $refresh | false | `public bool $refresh = false`| Defines if the table will be refreshing at a certain interval of time. |
| $refreshInSeconds | 2 seconds | `public int $refreshInSeconds`| Defines the interval of time, in seconds. |
| $showCheckboxes | true | `public bool $showCheckboxes = true`| Show or hide the checkboxes fields in the table. |
| $showOffline | true | `public bool $showOffline = true`| Show or hide the offline message when there is no internet connection. |
| $showLoading | true | `public bool $showLoading = true`| Show or hide the loading indicador after each change. |
| $showTableHead | true | `public bool $showTableHead = true`| Show or hide the table head. |
| $showTableFooter | false | `public bool $showTableFooter = false`| Show or hide the table footer. |

## Pagination attributes

| Method | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $showPagination | true | `public bool $showPagination = true`| show or hide the pagination. |
| $paginationTheme | tailwind | `public string $paginationTheme = 'talwind'`| Defines The pagination theme used by Laravel. By default will use the selection from the config file. |

## Per page attributes

| Method | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $showPerPage | true | `public bool $showPerPage = true`| Show the selector with the per page options. |
| $perPageOptions | 10, 25, 50, 100 | `public array $perPageOptions = [10, 25, 50, 100]` | Define the interval of values for the attribute. |
| $perPage | 25 | `public int $perPage = 25`| Set the current value for the attribute. |

## Search attributes

| Method | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $showSearch | true | `public bool $showSearch = true`| Show or hide the search box. |
| $searchUpdateMethod | debounce | `public string $searchUpdateMethod = 'debounce'`| Select the search update method between: `debounce` or `lazy`. |
| $searchDebounce | 350 ms | `public int $searchDebounce = 350` | Amount of time in ms to wait to send the search query and refresh the table. |
| $clearSearchButton | true | `public bool $clearSearchButton = true`| Show or hide a button to clear the search box. |

## Sort attributes

| Method | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $sortField | id | `public string $sortField = 'id'`| The default sort field for the table. |
| $sortDirection | asc | `public string $sortDirection = 'asc'`| The default sort direction for the table. |
