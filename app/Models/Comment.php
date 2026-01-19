<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['id','comment','user_id','property_id','created_at','updated_at'];

    public function property(){
        return $this->belongsTo('App\Models\Property');
    }

    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}
