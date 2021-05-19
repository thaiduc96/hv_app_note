<?php

namespace App\Repositories\Eloquents;

use App\Models\User;
use App\Repositories\Contracts\UserContract;
use Illuminate\Database\Eloquent\Model;

class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserContract
{
    public function getModel(): Model
    {
        return new User;
    }

}
