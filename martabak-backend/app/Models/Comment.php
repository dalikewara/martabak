<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;

class Comment extends Model
{
    public function posts()
    {
        return $this->belongsTo('App\Models\Post', 'post_id', 'id');
    }

    public function guests()
    {

        return $this->belongsTo('App\Models\Guest', 'commentator', 'id');
    }
}
