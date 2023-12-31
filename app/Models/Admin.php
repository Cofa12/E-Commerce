<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $guarded =[];
    public $timestamps = false;
    function image(){
        return $this->hasMany(Image::class);
    }

    function product(){
        return $this->hasMany(Product::class);
    }

}
