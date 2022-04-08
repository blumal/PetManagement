<?php

namespace Illuminate\Contracts\Queue;

interface QueueableCollection
{
    /**
     * Get the type of the entities being queued.
     *
     * @return string|null
     */
    public function getQueueableClass();

    /**
     * Get the identifiers for all of the entities.
     *
<<<<<<< HEAD
     * @return array<int, mixed>
=======
     * @return array
>>>>>>> origin/New-FakeMain
     */
    public function getQueueableIds();

    /**
     * Get the relationships of the entities being queued.
     *
<<<<<<< HEAD
     * @return array<int, string>
=======
     * @return array
>>>>>>> origin/New-FakeMain
     */
    public function getQueueableRelations();

    /**
     * Get the connection of the entities being queued.
     *
     * @return string|null
     */
    public function getQueueableConnection();
}
