<?php

namespace Illuminate\Database\PDO;

use Doctrine\DBAL\Driver\AbstractSQLServerDriver;

class SqlServerDriver extends AbstractSQLServerDriver
{
    /**
<<<<<<< HEAD
     * Create a new database connection.
     *
     * @param  mixed[]  $params
     * @param  string|null  $username
     * @param  string|null  $password
     * @param  mixed[]  $driverOptions
     * @return \Illuminate\Database\PDO\SqlServerConnection
     */
    public function connect(array $params, $username = null, $password = null, array $driverOptions = [])
=======
     * @return \Doctrine\DBAL\Driver\Connection
     */
    public function connect(array $params)
>>>>>>> origin/New-FakeMain
    {
        return new SqlServerConnection(
            new Connection($params['pdo'])
        );
    }
<<<<<<< HEAD

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'pdo_sqlsrv';
    }
=======
>>>>>>> origin/New-FakeMain
}
