<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model()
    {
        return User::class;
    }

    public function getList($perPage)
    {
        return $this->model::paginate($perPage);
    }


}
