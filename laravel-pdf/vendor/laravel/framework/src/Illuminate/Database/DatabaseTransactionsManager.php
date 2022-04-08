<?php

namespace Illuminate\Database;

class DatabaseTransactionsManager
{
    /**
     * All of the recorded transactions.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $transactions;

    /**
     * Create a new database transactions manager instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->transactions = collect();
    }

    /**
     * Start a new database transaction.
     *
     * @param  string  $connection
     * @param  int  $level
     * @return void
     */
    public function begin($connection, $level)
    {
        $this->transactions->push(
            new DatabaseTransactionRecord($connection, $level)
        );
    }

    /**
     * Rollback the active database transaction.
     *
     * @param  string  $connection
     * @param  int  $level
     * @return void
     */
    public function rollback($connection, $level)
    {
<<<<<<< HEAD
        $this->transactions = $this->transactions->reject(
            fn ($transaction) => $transaction->connection == $connection && $transaction->level > $level
        )->values();
=======
        $this->transactions = $this->transactions->reject(function ($transaction) use ($connection, $level) {
            return $transaction->connection == $connection &&
                   $transaction->level > $level;
        })->values();
>>>>>>> origin/New-FakeMain
    }

    /**
     * Commit the active database transaction.
     *
     * @param  string  $connection
     * @return void
     */
    public function commit($connection)
    {
        [$forThisConnection, $forOtherConnections] = $this->transactions->partition(
<<<<<<< HEAD
            fn ($transaction) => $transaction->connection == $connection
=======
            function ($transaction) use ($connection) {
                return $transaction->connection == $connection;
            }
>>>>>>> origin/New-FakeMain
        );

        $this->transactions = $forOtherConnections->values();

        $forThisConnection->map->executeCallbacks();
    }

    /**
     * Register a transaction callback.
     *
     * @param  callable  $callback
     * @return void
     */
    public function addCallback($callback)
    {
        if ($current = $this->transactions->last()) {
            return $current->addCallback($callback);
        }

<<<<<<< HEAD
        $callback();
=======
        call_user_func($callback);
>>>>>>> origin/New-FakeMain
    }

    /**
     * Get all the transactions.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
}
