<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Singers extends Model
{
    use HasFactory;

    protected $fillable = ["name", "image_path", "created_at", "updated_at"];
}
