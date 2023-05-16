<?php

namespace App\Repositories\Contracts;

use Prettus\Repository\Contracts\RepositoryInterface;

interface PaymentRepositoryInterface extends RepositoryInterface
{
    public function updateWhere($attributes = [], $conditions = []);
}
