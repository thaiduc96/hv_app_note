<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Config extends Model
{
    use Filterable;
    use SoftDeletes;

    CONST KEY_LINK_REGISTER = 'link_register';
    CONST KEY_LINK_WEB = 'link_web';

    protected $primaryKey = "key";

    protected $fillable = [
        'value',
        'description',
        'updated_by',
    ];
    protected $filterable = [
        'key',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }
}
