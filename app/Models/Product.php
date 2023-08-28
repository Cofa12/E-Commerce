<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded =[];
    public $timestamps = false;

    function category(){
        return $this->belongsTo(Category::class);
    }

    function admin(){
        return $this->belongsTo(Admin::class);
    }
    function user(){
        return $this->belongsTo(User::class);
    }

    function tempuser(){
        return $this->belongsToMany(User::class);
    }
    function userproduct(){
        return $this->hasMany(Userproduct::class);
    }
    function userloverUser(){
        return $this->belongsToMant(User::class);
    }




}
