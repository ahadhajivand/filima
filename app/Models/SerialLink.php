<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SerialLink extends Model
{
    protected $fillable = ['link_serial' , 'title_session' , 'title_quality' , 'title_part' , 'link_download'];

    use HasFactory;
}
