<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailSerial extends Model
{

    protected $fillable = ['title' , 'imdb' , 'country' , 'year' , 'language' , 'time' , 'genre_one',
        'genre_two' , 'genre_three' , 'age_category' ,
          'synopsis' , 'image' , 'link_serial' , 'slug' , 'status' , 'new' , 'special' , 'category'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }



    public function comments()
    {
        return $this->morphMany(Comment::class , 'commentable');
    }

    use HasFactory;

    public function path()
    {
        return  route('serials',$this->slug);
    }
}
