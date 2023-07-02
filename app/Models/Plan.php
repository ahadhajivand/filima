<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = ['title' , 'time_month' , 'price' , 'status'];


    public function orders()
    {
        return $this->hasMany(Order::class);
    }


    use HasFactory;
}
