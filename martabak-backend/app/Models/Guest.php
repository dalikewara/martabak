<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;

class Guest extends Model
{
    public function comments()
    {

        return $this->belongsTo('App\Models\Comment', 'id', 'commentator');
    }
}
