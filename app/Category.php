<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category'; 
    public $timestamps = false;
    protected $fillable =  [
        'nameCategory', 'imgCategory','createdDate','idCreator'
    ];

    public function products(){
        return $this->hasMany(Product::class,'idCategory','id');
    }
}
