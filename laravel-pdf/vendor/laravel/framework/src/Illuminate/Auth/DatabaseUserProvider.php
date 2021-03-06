<?php

namespace Illuminate\Auth;

use Closure;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Hashing\Hasher as HasherContract;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Database\ConnectionInterface;
<<<<<<< HEAD
=======
use Illuminate\Support\Str;
>>>>>>> origin/New-FakeMain

class DatabaseUserProvider implements UserProvider
{
    /**
     * The active database connection.
     *
     * @var \Illuminate\Database\ConnectionInterface
     */
<<<<<<< HEAD
    protected $connection;
=======
    protected $conn;
>>>>>>> origin/New-FakeMain

    /**
     * The hasher implementation.
     *
     * @var \Illuminate\Contracts\Hashing\Hasher
     */
    protected $hasher;

    /**
     * The table containing the users.
     *
     * @var string
     */
    protected $table;

    /**
     * Create a new database user provider.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Database\ConnectionInterface  $connection
=======
     * @param  \Illuminate\Database\ConnectionInterface  $conn
>>>>>>> origin/New-FakeMain
     * @param  \Illuminate\Contracts\Hashing\Hasher  $hasher
     * @param  string  $table
     * @return void
     */
<<<<<<< HEAD
    public function __construct(ConnectionInterface $connection, HasherContract $hasher, $table)
    {
        $this->connection = $connection;
=======
    public function __construct(ConnectionInterface $conn, HasherContract $hasher, $table)
    {
        $this->conn = $conn;
>>>>>>> origin/New-FakeMain
        $this->table = $table;
        $this->hasher = $hasher;
    }

    /**
     * Retrieve a user by their unique identifier.
     *
     * @param  mixed  $identifier
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveById($identifier)
    {
<<<<<<< HEAD
        $user = $this->connection->table($this->table)->find($identifier);
=======
        $user = $this->conn->table($this->table)->find($identifier);
>>>>>>> origin/New-FakeMain

        return $this->getGenericUser($user);
    }

    /**
     * Retrieve a user by their unique identifier and "remember me" token.
     *
     * @param  mixed  $identifier
     * @param  string  $token
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByToken($identifier, $token)
    {
        $user = $this->getGenericUser(
<<<<<<< HEAD
            $this->connection->table($this->table)->find($identifier)
=======
            $this->conn->table($this->table)->find($identifier)
>>>>>>> origin/New-FakeMain
        );

        return $user && $user->getRememberToken() && hash_equals($user->getRememberToken(), $token)
                    ? $user : null;
    }

    /**
     * Update the "remember me" token for the given user in storage.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  string  $token
     * @return void
     */
    public function updateRememberToken(UserContract $user, $token)
    {
<<<<<<< HEAD
        $this->connection->table($this->table)
=======
        $this->conn->table($this->table)
>>>>>>> origin/New-FakeMain
                ->where($user->getAuthIdentifierName(), $user->getAuthIdentifier())
                ->update([$user->getRememberTokenName() => $token]);
    }

    /**
     * Retrieve a user by the given credentials.
     *
     * @param  array  $credentials
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    public function retrieveByCredentials(array $credentials)
    {
        if (empty($credentials) ||
           (count($credentials) === 1 &&
            array_key_exists('password', $credentials))) {
            return;
        }

        // First we will add each credential element to the query as a where clause.
        // Then we can execute the query and, if we found a user, return it in a
        // generic "user" object that will be utilized by the Guard instances.
<<<<<<< HEAD
        $query = $this->connection->table($this->table);

        foreach ($credentials as $key => $value) {
            if (str_contains($key, 'password')) {
=======
        $query = $this->conn->table($this->table);

        foreach ($credentials as $key => $value) {
            if (Str::contains($key, 'password')) {
>>>>>>> origin/New-FakeMain
                continue;
            }

            if (is_array($value) || $value instanceof Arrayable) {
                $query->whereIn($key, $value);
            } elseif ($value instanceof Closure) {
                $value($query);
            } else {
                $query->where($key, $value);
            }
        }

<<<<<<< HEAD
        // Now we are ready to execute the query to see if we have a user matching
        // the given credentials. If not, we will just return null and indicate
        // that there are no matching users from the given credential arrays.
=======
        // Now we are ready to execute the query to see if we have an user matching
        // the given credentials. If not, we will just return nulls and indicate
        // that there are no matching users for these given credential arrays.
>>>>>>> origin/New-FakeMain
        $user = $query->first();

        return $this->getGenericUser($user);
    }

    /**
     * Get the generic user.
     *
     * @param  mixed  $user
     * @return \Illuminate\Auth\GenericUser|null
     */
    protected function getGenericUser($user)
    {
        if (! is_null($user)) {
            return new GenericUser((array) $user);
        }
    }

    /**
     * Validate a user against the given credentials.
     *
     * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
     * @param  array  $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        return $this->hasher->check(
            $credentials['password'], $user->getAuthPassword()
        );
    }
}
