<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{

    use SoftDeletes;

    protected $dates = ['deleted_at'];


    protected $fillable=['supplier_id','buyer_id','total_price','status','order_no'];


    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

}
