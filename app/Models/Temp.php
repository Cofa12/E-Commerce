<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{
    use HasFactory;
    protected $guarded=[];
    public $timestamps =false;

    function user(){
        return $this->belongsTo(User::class);
    }
    function product(){
        return $this->belongsTo(Product::class);
    }
}
