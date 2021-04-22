# Relationships

In principle, any relation that we set in the table should be visible and work correctly. The problem arises when ordering the results using relational tables. 

Every time you define a column like `sortable()` and later you try to order the results, this is where the problems begin to occur, since each type of relationship requires a different response from the database, and therefore, each of the responses must be defined.

At the moment, **Belich Tables** only work with this relationships:

- HasOne.
- BelongsTo.
- ~~HasMany~~
- ~~BelongsToMany~~

