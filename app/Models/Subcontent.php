<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcontent extends Model
{
    //
    protected $fillable = [
        "title",
        "youtube_link1",
        "youtube_link2",
        "content",
        "content_id",
    ];
}
