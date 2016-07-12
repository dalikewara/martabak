<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;

class Notification extends Model
{
    public function users()
    {

        return $this->belongsTo('App\Models\User');
    }

    public function posts()
    {

        return $this->belongsTo('App\Models\Post', 'meta_1', 'id');
    }

    public function reply()
    {

        return $this->belongsTo('App\Models\Guest', 'meta_2', 'id');
    }

    public function commentator()
    {
        return $this->belongsTo('App\Models\Guest', 'meta_3', 'id');
    }
}
