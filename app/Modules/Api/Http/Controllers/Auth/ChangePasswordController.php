<?php

namespace App\Modules\Api\Http\Controllers\Auth;

use App\Helpers\AuthHelper;
use App\Http\Controllers\Controller;
use App\Modules\Api\Http\Requests\Auth\ChangePasswordRequest;
use App\Repositories\Facades\UserRepository;
use Illuminate\Support\Facades\DB;


class ChangePasswordController extends Controller
{
    public function changePassword(ChangePasswordRequest $request)
    {
        DB::beginTransaction();
        try {
            UserRepository::update(AuthHelper::getUserApiId(), $request->only('password'));
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
        return $this->successResponse(true);

    }
}
