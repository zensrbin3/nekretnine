<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $table = 'properties';
    protected $fillable = ['user_id','title','description','location','price','size_m2','type','status'];
    public function comments(){
        return $this->hasMany('App\Models\Comment');
    }
}
