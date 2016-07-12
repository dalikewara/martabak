<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['category_name', 'category_slug', 'category_description'];

    public function posts()
    {
        return $this->belongsToMany('App\Models\Post');
    }
}
