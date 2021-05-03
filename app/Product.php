<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    // use SoftDeletes;
    
    protected $table = 'product'; 
    public $timestamps = false;
    // public $primarykey = 'id';
    public $fillable = [
        'nameProduct', 'unit', 'priceModal', 'price', 'stock', 'idUsers', 'imgProduct', 'idStore', 'idCategory','description'
    ];
    // protected $dates = ['deleted_at'];

    public function toko()
    {
        return $this->belongsTo('App\Toko', 'idStore');
    }

    public function category()
    {
        return $this->belongsTo('App\Category', 'idCategory');
    }
    
    public function orderdetail(){
        return $this->hasMany(Orderdetail::class,'idProduct','id');
    }

   
}