<?php

namespace App\Modules\Api\Http\Controllers\Auth;

use App\Facades\UserForgotPasswordFacade;
use App\Http\Controllers\Controller;
use App\Mail\ForgotPassword;
use App\Modules\Api\Http\Requests\Auth\SendCodeForgotPasswordRequest;
use App\Modules\Api\Http\Requests\Auth\VerifyCodeForgotPasswordByEmailRequest;
use App\Repositories\Facades\UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ForgotEmailPasswordController extends Controller
{

    public function sendCode(SendCodeForgotPasswordRequest $request)
    {
        $user = UserRepository::findByCondition($request->only('email'));
        DB::beginTransaction();
        try {
            $code = UserForgotPasswordFacade::getVerifyCode($user);
            Mail::to($user->email)->queue(new ForgotPassword(['code' => $code]));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);
    }


    public function verifyCode(VerifyCodeForgotPasswordByEmailRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = UserForgotPasswordFacade::verifyCode($request->email, $request->code);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse($data);
    }

}
