<?php

namespace App\Repositories\Eloquents;

use App\Models\NotificationUser;
use App\Repositories\Contracts\NotificationUserContract;
use Illuminate\Database\Eloquent\Model;


class NotificationUserRepositoryEloquent extends BaseRepositoryEloquent implements NotificationUserContract
{
    public function getModel(): Model
    {
        return new NotificationUser;
    }
}
