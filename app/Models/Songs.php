<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Songs extends Model
{
    use HasFactory;

    protected $fillable = ["name", "music_directors", "singers", "movies", "lyricists", "artists", "languages", "lyrics", "image_path", "created_at", "updated_at"];

    protected $casts = [
        'music_directors' => 'json',
        'singers' => 'json',        
        'lyricists' => 'json',
        'artists' => 'json'
    ];     
}