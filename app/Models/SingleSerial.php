<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SingleSerial extends Model
{
    protected $fillable = ['link' , 'title' , 'image'];
    use HasFactory;
}
