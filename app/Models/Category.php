<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;

    protected $fillable = ['title' , 'parent'  , 'slug' , 'description'];

    public function child()
    {
        return $this->hasMany(Category::class , 'parent','id');
    }


    public function videos()
    {
        return $this->belongsToMany(DetailVideo::class);
    }
    public function serials()
    {
        return $this->belongsToMany(DetailSerial::class);
    }

    use HasFactory;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function path()
    {
        return  route('CategoryList',$this->slug);
    }
}
