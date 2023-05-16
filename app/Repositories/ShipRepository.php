<?php

namespace App\Repositories;

use App\Models\Ship;
use App\Repositories\Contracts\ShipRepositoryInterface;

class ShipRepository extends BaseRepository implements ShipRepositoryInterface
{
    public function model()
    {
        return Ship::class;
    }
}
