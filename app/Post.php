<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    static function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
