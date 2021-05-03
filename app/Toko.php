<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    protected $table = 'store'; 
    public $timestamps = false;
    protected $fillable =  [
        'nameStore', 'addressStore','telephone'
    ];

    public function products(){
        return $this->hasMany(Product::class,'idStore','id');
    }
}
