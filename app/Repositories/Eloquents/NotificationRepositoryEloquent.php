<?php

namespace App\Repositories\Eloquents;

use App\Models\Notification;
use App\Repositories\Contracts\NotificationContract;
use Illuminate\Database\Eloquent\Model;


class NotificationRepositoryEloquent extends BaseRepositoryEloquent implements NotificationContract
{
    public function getModel(): Model
    {
        return new Notification;
    }
}
