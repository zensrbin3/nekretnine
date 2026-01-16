<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyView extends Model
{
    protected $fillable = [
        'property_id',
        'user_id',
        'ip_address',
        'viewed_at'
    ];
}
