<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Repository\Eloquent\BaseRepository as PrettusBaseRepository;

class BaseRepository extends PrettusBaseRepository implements RepositoryInterface
{
    /**
     * Model
     *
     * @return string
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * Clean expired invites or accepted invites
     */
    public function getTable()
    {
        return $this->model->getTable();
    }

    /**
     * Update record(s) satisfy conditions
     */
    public function updateWhere($attributes = [], $conditions = [])
    {
        return $this->model->where($conditions)->update($attributes);
    }

    public function sum(string $column)
    {
        return $this->model->sum($column);
    }
}
