<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'address',
        'image',
        'doc',
        'phone',
        'business_license',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'supplier_id');
    }


    public function company()
    {
        return $this->hasOne(Company::class, 'user_id', 'user_id');
    }
}
