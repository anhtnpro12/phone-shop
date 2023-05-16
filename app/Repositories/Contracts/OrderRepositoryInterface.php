<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface OrderRepositoryInterface extends RepositoryInterface
{
    public function updateWhere($attributes = [], $conditions = []);
}
