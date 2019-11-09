<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'content', 'category_id', 'user_id', 'status' 
    ];

    static function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
