<?php

namespace App\Services;

use App\Exceptions\CustomException;
use App\Facades\UserFacade;
use App\Repositories\Facades\UserForgotPasswordRepository;
use App\Repositories\Facades\UserRepository;

class UserForgotPasswordService
{

    public function getVerifyCode($user, $type = SEND_EMAIL)
    {
        UserForgotPasswordRepository::deleteByCondition([
            'user_id' => $user->id
        ]);
        $random = mt_rand(100000, 999999);
        UserForgotPasswordRepository::create([
            'code' => $random,
            'target' => $type == SEND_EMAIL ? $user->email : $user->phone,
            'sending_method' => $type,
            'user_id' => $user->id
        ]);
        return $random;
    }
    public function verifyCode($email, $code){
        $code = UserForgotPasswordRepository::verifyCode($code, $email);
        if (empty($code)) {
            throw new CustomException(
                trans('message.forgot_password_otp_wrong')
            );
        }

        $user = UserRepository::findOrFail($code->user_id);

        if (empty($user)) {
            throw new CustomException(
                trans('message.user_not_found')
            );
        }
        $code->delete();

        $token = UserFacade::loginByUser($user);
        return UserFacade::getUserLogin(GUARD_API,$token);
    }

}
