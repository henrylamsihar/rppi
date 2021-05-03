<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
    protected $table = 'orders_detail'; 
    public $timestamps = false;
    public $primarykey = 'id';
    public $fillable = [
        'unit'
    ];
    // protected $dates = ['deleted_at'];

    public function order()
    {
        return $this->belongsTo('App\Order', 'idOrder');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'idUser');
    }

    public function product()
    {
        return $this->belongsTo('App\Product', 'idProduct');
    }
}

