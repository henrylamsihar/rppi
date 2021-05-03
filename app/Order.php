<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders'; 
    public $timestamps = false;
    public $fillable = [
        'statusOrder','total','totalModal','subtotal','unit'
    ];

    public function user()
    {
        return $this->belongsTo('App\User', 'idUser');
    }

    public function orderdetail(){
        return $this->hasMany(Orderdetail::class,'idOrder','id');
    }

    
}

