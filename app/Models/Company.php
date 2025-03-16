<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'address',
        'supplier_id',
        'unified_number',
        'vat_number',
        'reg_expire_date',
        'registration_number',
        'user_id'
    ];


    public function warehouses()
    {
        return $this->hasMany(Warehouse::class);
    }
    public function documents()
    {
        return $this->hasMany(CompanyDocument::class);
    }
    public function supplier()
    {
        return $this->hasOne(Supplier::class, 'user_id', 'user_id');
    }

    public function buyer()
    {
        return $this->hasOne(Buyer::class, 'user_id', 'user_id');
    }



}
