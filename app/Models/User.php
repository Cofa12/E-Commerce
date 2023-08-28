<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $guarded =[];
    public $timestamp = false;

    function product(){
        return $this->hasMany(Product::class);
    }

    function tempproduct(){
        return $this->belongsToMany(Product::class);
    }

    function userloverProduct(){
        return $this->belongsToMant(Product::class);
    }
}
