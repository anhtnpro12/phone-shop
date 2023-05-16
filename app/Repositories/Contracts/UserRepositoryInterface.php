<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function model();

    public function getList($perPage);

    // public function create($attributes = []);

    // public function updateWhere($attributes = [], $conditions = []);

    // public function find($id, $column = ['*']);

    // public function update(array $attributes, $id);

    // public function delete($id);
}
