<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumLog extends Model
{
    protected $fillable = [
        'album_id',
        'user_id',
        'action',
    ];
}
