<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;

class Post extends Model
{
    protected $fillable = ['author', 'title', 'slug', 'content'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\Status');
    }

    public function tags()
    {

        return $this->belongsToMany('App\Models\Tag');
    }

    public function categories()
    {

        return $this->belongsToMany('App\Models\Category');
    }

    public function comments()
    {

        return $this->belongsTo('App\Models\Comment', 'id', 'post_id');
    }
}
