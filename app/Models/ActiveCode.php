<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActiveCode extends Model
{
    protected $fillable = ['code' , 'expired_at' , 'user_id'];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeVerifyCode($query , $code , $user)
    {
     return !! $user->ActiveCode()->whereCode($code)->where('expired_at' , '>' , now())->first();
    }


    public function scopeGenerateCode($quey , $user)
    {
        if ($code = $this->getAliveCodeForUser($user))
        {

            $code = $code->code;
        } else
        {
            do {
                $code = mt_rand(10000, 999999);
            } while ($this->CheckCodeIsUnique($user, $code));

            $user->ActiveCode()->create([
                'code' => $code,
                'expired_at' => now()->addMinute(2)
            ]);
            //store the code
        }


        return $code;
    }

    private function CheckCodeIsUnique($user, int $code)
    {
        return !! $user->ActiveCode()->whereCode($code)->first();
    }

    private function getAliveCodeForUser($user)
    {
        return  $user->ActiveCode()->where('expired_at' , '>' , now())->first();
    }

    use HasFactory;
}
