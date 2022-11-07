<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MusicDirectors extends Model
{
    use HasFactory;

    protected $fillable = ["name", "bio", "awards", "youtube_url", "image_path", "created_at", "updated_at"];   
    
}
