<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artists extends Model
{
    use HasFactory;
    
    protected $fillable = ["name", "lyricist", "singer", "music_director", "bio", "awards", "youtube_url", "image_path", "created_at", "updated_at"];
}
