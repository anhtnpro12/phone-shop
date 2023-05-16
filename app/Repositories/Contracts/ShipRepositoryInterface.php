<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface ShipRepositoryInterface extends RepositoryInterface
{
    public function updateWhere($attributes = [], $conditions = []);
}
