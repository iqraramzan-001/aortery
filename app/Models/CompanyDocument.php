<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyDocument extends Model
{

    protected $fillable=['company_id','file','type'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
