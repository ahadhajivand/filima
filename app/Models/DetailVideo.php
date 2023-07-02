<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailVideo extends Model
{
    protected $fillable = ['title' , 'imdb' , 'country' , 'year' , 'language' , 'time' , 'genre_one',
    'genre_two' , 'genre_three' , 'link_title_one' , 'link_title_two' , 'link_title_three', 'link_download_one',
        'link_download_two' , 'link_download_three' , 'synopsis' , 'image' , 'link_video' , 'slug' , 'status' , 'new' , 'special' , 'category'];


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
        return  route('films',$this->slug);
    }
}
