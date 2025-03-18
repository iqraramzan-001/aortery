<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryLocation extends Model
{
    protected $fillable=[

        'location',
        'buyer_id',
        'open_from',
        'open_to',
        'longitude',
        'latitude'

    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }
}
