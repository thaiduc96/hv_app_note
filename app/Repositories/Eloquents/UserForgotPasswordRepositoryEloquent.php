<?php

namespace App\Repositories\Eloquents;

use App\Models\UserForgotPassword;
use App\Repositories\Contracts\UserForgotPasswordContract;
use Illuminate\Database\Eloquent\Model;


class UserForgotPasswordRepositoryEloquent extends BaseRepositoryEloquent implements UserForgotPasswordContract
{
    public function getModel(): Model
    {
        return new UserForgotPassword;
    }

    public function verifyCode($code, $email)
    {
        return $this->model->filter([
            'code' => $code,
            'target' => $email
        ])
            ->where('expired_at', '>=' ,now())
            ->first();
    }
}
