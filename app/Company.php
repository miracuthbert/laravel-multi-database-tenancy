<?php

namespace App;

use App\Tenant\Models\Tenant;
use App\Tenant\Traits\ForSystem;
use App\Tenant\Traits\IsTenant;
use Illuminate\Database\Eloquent\Model;

class Company extends Model implements Tenant
{
    use IsTenant, ForSystem;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'uuid'
    ];
}
