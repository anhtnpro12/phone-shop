<?php
<<<<<<< HEAD
 
namespace app\Repositories;

class ClassName 
{
        
=======

namespace App\Repositories;

use App\Models\Role;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model()
    {
        return User::class;
    }

    public function getListUser()
    {
        return $this->model::all();
    }
>>>>>>> 3a6376576839e3134e58ce26039e3eb40c58bdd5
}
