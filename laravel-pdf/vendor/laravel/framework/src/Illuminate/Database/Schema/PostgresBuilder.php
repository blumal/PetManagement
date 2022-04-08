<?php

namespace Illuminate\Database\Schema;

<<<<<<< HEAD
use Illuminate\Database\Concerns\ParsesSearchPath;

class PostgresBuilder extends Builder
{
    use ParsesSearchPath {
        parseSearchPath as baseParseSearchPath;
    }

=======
class PostgresBuilder extends Builder
{
>>>>>>> origin/New-FakeMain
    /**
     * Create a database in the schema.
     *
     * @param  string  $name
     * @return bool
     */
    public function createDatabase($name)
    {
        return $this->connection->statement(
            $this->grammar->compileCreateDatabase($name, $this->connection)
        );
    }

    /**
     * Drop a database from the schema if the database exists.
     *
     * @param  string  $name
     * @return bool
     */
    public function dropDatabaseIfExists($name)
    {
        return $this->connection->statement(
            $this->grammar->compileDropDatabaseIfExists($name)
        );
    }

    /**
     * Determine if the given table exists.
     *
     * @param  string  $table
     * @return bool
     */
    public function hasTable($table)
    {
<<<<<<< HEAD
        [$database, $schema, $table] = $this->parseSchemaAndTable($table);
=======
        [$schema, $table] = $this->parseSchemaAndTable($table);
>>>>>>> origin/New-FakeMain

        $table = $this->connection->getTablePrefix().$table;

        return count($this->connection->select(
<<<<<<< HEAD
            $this->grammar->compileTableExists(), [$database, $schema, $table]
=======
            $this->grammar->compileTableExists(), [$schema, $table]
>>>>>>> origin/New-FakeMain
        )) > 0;
    }

    /**
     * Drop all tables from the database.
     *
     * @return void
     */
    public function dropAllTables()
    {
        $tables = [];

<<<<<<< HEAD
        $excludedTables = $this->grammar->escapeNames(
            $this->connection->getConfig('dont_drop') ?? ['spatial_ref_sys']
        );
=======
        $excludedTables = $this->connection->getConfig('dont_drop') ?? ['spatial_ref_sys'];
>>>>>>> origin/New-FakeMain

        foreach ($this->getAllTables() as $row) {
            $row = (array) $row;

<<<<<<< HEAD
            if (empty(array_intersect($this->grammar->escapeNames($row), $excludedTables))) {
                $tables[] = $row['qualifiedname'] ?? reset($row);
=======
            $table = reset($row);

            if (! in_array($table, $excludedTables)) {
                $tables[] = $table;
>>>>>>> origin/New-FakeMain
            }
        }

        if (empty($tables)) {
            return;
        }

        $this->connection->statement(
            $this->grammar->compileDropAllTables($tables)
        );
    }

    /**
     * Drop all views from the database.
     *
     * @return void
     */
    public function dropAllViews()
    {
        $views = [];

        foreach ($this->getAllViews() as $row) {
            $row = (array) $row;

<<<<<<< HEAD
            $views[] = $row['qualifiedname'] ?? reset($row);
=======
            $views[] = reset($row);
>>>>>>> origin/New-FakeMain
        }

        if (empty($views)) {
            return;
        }

        $this->connection->statement(
            $this->grammar->compileDropAllViews($views)
        );
    }

    /**
     * Drop all types from the database.
     *
     * @return void
     */
    public function dropAllTypes()
    {
        $types = [];

        foreach ($this->getAllTypes() as $row) {
            $row = (array) $row;

            $types[] = reset($row);
        }

        if (empty($types)) {
            return;
        }

        $this->connection->statement(
            $this->grammar->compileDropAllTypes($types)
        );
    }

    /**
     * Get all of the table names for the database.
     *
     * @return array
     */
    public function getAllTables()
    {
        return $this->connection->select(
<<<<<<< HEAD
            $this->grammar->compileGetAllTables(
                $this->parseSearchPath(
                    $this->connection->getConfig('search_path') ?: $this->connection->getConfig('schema')
                )
            )
=======
            $this->grammar->compileGetAllTables((array) $this->connection->getConfig('schema'))
>>>>>>> origin/New-FakeMain
        );
    }

    /**
     * Get all of the view names for the database.
     *
     * @return array
     */
    public function getAllViews()
    {
        return $this->connection->select(
<<<<<<< HEAD
            $this->grammar->compileGetAllViews(
                $this->parseSearchPath(
                    $this->connection->getConfig('search_path') ?: $this->connection->getConfig('schema')
                )
            )
=======
            $this->grammar->compileGetAllViews((array) $this->connection->getConfig('schema'))
>>>>>>> origin/New-FakeMain
        );
    }

    /**
     * Get all of the type names for the database.
     *
     * @return array
     */
    public function getAllTypes()
    {
        return $this->connection->select(
            $this->grammar->compileGetAllTypes()
        );
    }

    /**
     * Get the column listing for a given table.
     *
     * @param  string  $table
     * @return array
     */
    public function getColumnListing($table)
    {
<<<<<<< HEAD
        [$database, $schema, $table] = $this->parseSchemaAndTable($table);
=======
        [$schema, $table] = $this->parseSchemaAndTable($table);
>>>>>>> origin/New-FakeMain

        $table = $this->connection->getTablePrefix().$table;

        $results = $this->connection->select(
<<<<<<< HEAD
            $this->grammar->compileColumnListing(), [$database, $schema, $table]
=======
            $this->grammar->compileColumnListing(), [$schema, $table]
>>>>>>> origin/New-FakeMain
        );

        return $this->connection->getPostProcessor()->processColumnListing($results);
    }

    /**
<<<<<<< HEAD
     * Parse the database object reference and extract the database, schema, and table.
     *
     * @param  string  $reference
     * @return array
     */
    protected function parseSchemaAndTable($reference)
    {
        $searchPath = $this->parseSearchPath(
            $this->connection->getConfig('search_path') ?: $this->connection->getConfig('schema') ?: 'public'
        );

        $parts = explode('.', $reference);

        $database = $this->connection->getConfig('database');

        // If the reference contains a database name, we will use that instead of the
        // default database name for the connection. This allows the database name
        // to be specified in the query instead of at the full connection level.
        if (count($parts) === 3) {
            $database = $parts[0];
            array_shift($parts);
        }

        // We will use the default schema unless the schema has been specified in the
        // query. If the schema has been specified in the query then we can use it
        // instead of a default schema configured in the connection search path.
        $schema = $searchPath[0];

        if (count($parts) === 2) {
            $schema = $parts[0];
            array_shift($parts);
        }

        return [$database, $schema, $parts[0]];
    }

    /**
     * Parse the "search_path" configuration value into an array.
     *
     * @param  string|array|null  $searchPath
     * @return array
     */
    protected function parseSearchPath($searchPath)
    {
        return array_map(function ($schema) {
            return $schema === '$user'
                ? $this->connection->getConfig('username')
                : $schema;
        }, $this->baseParseSearchPath($searchPath));
=======
     * Parse the table name and extract the schema and table.
     *
     * @param  string  $table
     * @return array
     */
    protected function parseSchemaAndTable($table)
    {
        $table = explode('.', $table);

        if (is_array($schema = $this->connection->getConfig('schema'))) {
            if (in_array($table[0], $schema)) {
                return [array_shift($table), implode('.', $table)];
            }

            $schema = head($schema);
        }

        return [$schema ?: 'public', implode('.', $table)];
>>>>>>> origin/New-FakeMain
    }
}
