<?php

namespace Illuminate\Database\Eloquent;

use Illuminate\Database\RecordsNotFoundException;
use Illuminate\Support\Arr;

<<<<<<< HEAD
/**
 * @template TModel of \Illuminate\Database\Eloquent\Model
 */
=======
>>>>>>> origin/New-FakeMain
class ModelNotFoundException extends RecordsNotFoundException
{
    /**
     * Name of the affected Eloquent model.
     *
<<<<<<< HEAD
     * @var class-string<TModel>
=======
     * @var string
>>>>>>> origin/New-FakeMain
     */
    protected $model;

    /**
     * The affected model IDs.
     *
<<<<<<< HEAD
     * @var array<int, int|string>
=======
     * @var int|array
>>>>>>> origin/New-FakeMain
     */
    protected $ids;

    /**
     * Set the affected Eloquent model and instance ids.
     *
<<<<<<< HEAD
     * @param  class-string<TModel>  $model
     * @param  array<int, int|string>|int|string  $ids
=======
     * @param  string  $model
     * @param  int|array  $ids
>>>>>>> origin/New-FakeMain
     * @return $this
     */
    public function setModel($model, $ids = [])
    {
        $this->model = $model;
        $this->ids = Arr::wrap($ids);

        $this->message = "No query results for model [{$model}]";

        if (count($this->ids) > 0) {
            $this->message .= ' '.implode(', ', $this->ids);
        } else {
            $this->message .= '.';
        }

        return $this;
    }

    /**
     * Get the affected Eloquent model.
     *
<<<<<<< HEAD
     * @return class-string<TModel>
=======
     * @return string
>>>>>>> origin/New-FakeMain
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * Get the affected Eloquent model IDs.
     *
<<<<<<< HEAD
     * @return array<int, int|string>
=======
     * @return int|array
>>>>>>> origin/New-FakeMain
     */
    public function getIds()
    {
        return $this->ids;
    }
}
