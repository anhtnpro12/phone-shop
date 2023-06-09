<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function updateWhere($attributes = [], $conditions = []);
}
