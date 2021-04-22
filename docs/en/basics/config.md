# Config

The configuration file `./config/belich-tables.php`, includes the following options:

| Parameter | Options | Description |
| :---------- |:------------| :-----------| 
| exports | Daguilarm\BelichTables\Exports\Export::class | Defines the class used to export the content. It can be changed and customized by the user. |
| pdf_library| dompdf, mpdf | Defines the driver used to export the content. It requires the installation of the package selected by the user. |
| theme | tailwind | Define the frontend styling framework used. |
| loadingColor | rgba(147, 197, 253, 1) | Define the color for the loading indicador. |
| noResults | — | Default value when there is no results to show. |
