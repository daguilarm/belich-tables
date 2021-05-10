# Attributes

The attributes that you can use in a **Table Component** are described below. These attributes have been classified by groups, in order to facilitate their management.

**All the attributes have protected properties**.

## Export attributes

| Attribute | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $export | [] | `protected array $export = ['pdf', 'csv', 'xls']`| Defines the file formats that are allowed to be downloaded. If you leave it in blank, the export option will be canceled. |
| $exportAllowedFormats | csv, xls, xlsx, pdf | `protected array $exportAllowedFormats = ['csv', 'pdf']`| Defines the file formats supported when exporting. |
| $exportFileName | data | `protected string $exportFileName = 'data'`| Defines the file name for the exported file. |

## Table attributes

| Attribute | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $refresh | false | `protected bool $refresh = false`| Defines if the table will be refreshing at a certain interval of time. |
| $refreshInSeconds | 2 seconds | `protected int $refreshInSeconds`| Defines the interval of time, in seconds. |
| $showCheckboxes | true | `protected bool $showCheckboxes = true`| Show or hide the checkboxes fields in the table. |
| $showOffline | true | `protected bool $showOffline = true`| Show or hide the offline message when there is no internet connection. |
| $showLoading | true | `protected bool $showLoading = true`| Show or hide the loading indicador after each change. |
| $showTableHead | true | `protected bool $showTableHead = true`| Show or hide the table head. |
| $showTableFooter | false | `protected bool $showTableFooter = false`| Show or hide the table footer. |

## Pagination attributes

| Attribute | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $showPagination | true | `protected bool $showPagination = true`| show or hide the pagination. |
| $paginationTheme | tailwind | `protected string $paginationTheme = 'talwind'`| Defines The pagination theme used by Laravel. By default will use the selection from the config file. |

## Per page attributes

| Attribute | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $showPerPage | true | `protected bool $showPerPage = true`| Show the selector with the per page options. |
| $perPageOptions | 10, 25, 50, 100 | `protected array $perPageOptions = [10, 25, 50, 100]` | Define the interval of values for the attribute. |
| $perPage | 25 | `protected int $perPage = 25`| Set the current value for the attribute. |

## Search attributes

| Attribute | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $showSearch | true | `protected bool $showSearch = true`| Show or hide the search box. |
| $searchUpdateMethod | debounce | `protected string $searchUpdateMethod = 'debounce'`| Select the search update method between: `debounce` or `lazy`. |
| $searchDebounce | 350 ms | `protected int $searchDebounce = 350` | Amount of time in ms to wait to send the search query and refresh the table. |
| $clearSearchButton | true | `protected bool $clearSearchButton = true`| Show or hide a button to clear the search box. |

## Sort attributes

| Attribute | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $sortField | id | `protected string $sortField = 'id'`| The default sort field for the table. |
| $sortDirection | asc | `protected string $sortDirection = 'asc'`| The default sort direction for the table. |

## Other attributes

| Attribute | Default | Example | Description |
| :---------- |:------------ |:------------| :-----------| 
| $newResource | disabled | `protected string $newResource = '../../dashboard/users/create'`| Set the url path for create a new resource. |
