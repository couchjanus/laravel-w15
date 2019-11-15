<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description', 'active', 'status'
    ];

    static function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

}
