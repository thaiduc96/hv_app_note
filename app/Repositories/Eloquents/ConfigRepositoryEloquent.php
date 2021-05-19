<?php 

namespace App\Repositories\Eloquents;
 
use App\Models\Config;
use App\Repositories\Contracts\ConfigContract;
use Illuminate\Database\Eloquent\Model;

 
class ConfigRepositoryEloquent extends BaseRepositoryEloquent implements ConfigContract 
{
public function getModel(): Model 
 { 
return new Config; 
 } 
}
