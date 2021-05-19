<?php

namespace App\Repositories\Contracts;

interface UserForgotPasswordContract extends BaseContract
{
    public function verifyCode($code, $email);
}
