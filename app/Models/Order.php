<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['price' , 'status' , 'tacking_serial'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plans()
    {
        return $this->belongsToMany(Plan::class);
    }


    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    use HasFactory;
}
