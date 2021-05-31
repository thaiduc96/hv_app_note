<?php 

namespace App\Repositories\Eloquents;
 
use App\Models\OrderHistory;
use App\Repositories\Contracts\OrderHistoryContract;
use Illuminate\Database\Eloquent\Model;

 
class OrderHistoryRepositoryEloquent extends BaseRepositoryEloquent implements OrderHistoryContract 
{
public function getModel(): Model 
 { 
return new OrderHistory; 
 } 
}
