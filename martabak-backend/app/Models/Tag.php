<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;

class Tag extends Model
{
    protected $fillable = ['tag_name', 'tag_slug'];

    public function posts()
    {

        return $this->belongsToMany('App\Models\Post');
    }
}
