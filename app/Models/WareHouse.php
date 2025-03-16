<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WareHouse extends Model
{
    protected $fillable=[
        'name',
        'location',
        'company_id',
        'open_from',
        'open_to'
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

}
