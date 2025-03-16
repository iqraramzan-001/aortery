<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDocument extends Model
{
    protected $fillable = ['user_id', 'uploaded_by_id', 'uploaded_by_type', 'document'];

    public function uploadedBy()
    {
        return $this->morphTo();
    }
}
