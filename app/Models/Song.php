<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = ['title', 'artist', 'body'];
    protected $dates = ['created_at', 'updated_at'];
}
