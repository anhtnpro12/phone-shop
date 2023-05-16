<?php

namespace App\Repositories;

use App\Models\OrderItems;
use App\Repositories\Contracts\OrderItemsRepositoryInterface;

class OrderItemsRepository extends BaseRepository implements OrderItemsRepositoryInterface
{
    public function model()
    {
        return OrderItems::class;
    }
}
