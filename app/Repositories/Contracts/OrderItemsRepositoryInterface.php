<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface OrderItemsRepositoryInterface extends RepositoryInterface
{
    public function updateWhere($attributes = [], $conditions = []);
}
