<?php

namespace App\Services;

use App\Repositories\Facades\DeviceTokenRepository;

class DeviceTokenService
{

    public function create($input, $user)
    {
        $input['user_id'] = $user->id;
        DeviceTokenRepository::create($input);
    }
}
