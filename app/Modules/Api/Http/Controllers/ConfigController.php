<?php

namespace App\Modules\Api\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repositories\Facades\ConfigRepository;
use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function show($key){
        $key = ConfigRepository::findOrFail($key);
        return $this->successResponse($key->value);
    }
}
