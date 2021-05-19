<?php 

namespace App\Repositories\Eloquents;
 
use App\Models\DeviceToken;
use App\Repositories\Contracts\DeviceTokenContract;
use Illuminate\Database\Eloquent\Model;

 
class DeviceTokenRepositoryEloquent extends BaseRepositoryEloquent implements DeviceTokenContract 
{
public function getModel(): Model 
 { 
return new DeviceToken; 
 } 
}
