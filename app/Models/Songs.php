<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Songs extends Model
{
    use HasFactory;

    protected $fillable = ["name", "music_directors", "singers", "movies", "lyricists", "artists", "lyrics_tamil", "lyrics_english", "image_path", "youtube_url", "created_at", "updated_at"];

    protected $casts = [
        'music_directors' => 'json',
        'singers' => 'json',        
        'lyricists' => 'json',
        'artists' => 'json'
    ];     
}
