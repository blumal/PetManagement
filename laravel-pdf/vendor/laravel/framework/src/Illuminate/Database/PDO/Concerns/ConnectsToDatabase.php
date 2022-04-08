<?php

namespace Illuminate\Database\PDO\Concerns;

use Illuminate\Database\PDO\Connection;
use InvalidArgumentException;
use PDO;

trait ConnectsToDatabase
{
    /**
     * Create a new database connection.
     *
<<<<<<< HEAD
     * @param  mixed[]  $params
     * @param  string|null  $username
     * @param  string|null  $password
     * @param  mixed[]  $driverOptions
=======
     * @param  array  $params
>>>>>>> origin/New-FakeMain
     * @return \Illuminate\Database\PDO\Connection
     *
     * @throws \InvalidArgumentException
     */
<<<<<<< HEAD
    public function connect(array $params, $username = null, $password = null, array $driverOptions = [])
=======
    public function connect(array $params)
>>>>>>> origin/New-FakeMain
    {
        if (! isset($params['pdo']) || ! $params['pdo'] instanceof PDO) {
            throw new InvalidArgumentException('Laravel requires the "pdo" property to be set and be a PDO instance.');
        }

        return new Connection($params['pdo']);
    }
}
