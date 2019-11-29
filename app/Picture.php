<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = ['filename', 'mime', 'path', 'size'];

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }
}
