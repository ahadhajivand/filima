<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'super',
        'staff',
        'viptime',
        'image'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];


    public function ActiveCode()
    {
        return $this->hasMany(ActiveCode::class);
    }


    public function isActive()
    {
        return $this->viptime > Carbon::now() ? true : false ;
    }

    public function Staff()
    {
        return $this->staff;
    }

    public function Super()
    {
        return $this->super;
    }


    public function similars_video()
    {
        return $this->hasMany(SimilarVideo::class);
    }

    public function similars_serial()
    {
        return $this->hasMany(SimilarSerial::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function interests()
    {
        return $this->hasMany(Interest::class);
    }


    public function orders()
    {
        return $this->hasMany(Order::class);
    }


}
