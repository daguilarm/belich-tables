# Creating Tables

The tables are the elements that will allow us to show the data from a **Laravel** model. For it you will need a new **Livewire** component that extends the **TableComponent**, in this component, you need to define a list of a columns, a base query, the filters and the configuration parameters.

Combining all these parameters, we will be able to configure the table according to our requirements.

## Basic requirements

The table, will need to extend the class `Daguilarm\LivewireTables\Components\TableComponent` this class establishes some parameters by default and forces you to include a series of classes in your table. These three classes are:

### Query 

The `query()` method...
