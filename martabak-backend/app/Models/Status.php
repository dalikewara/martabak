<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models;

class Status extends Model
{
    public function posts()
    {
        return $this->belongsTomany('App\Models\Post');
    }
}
