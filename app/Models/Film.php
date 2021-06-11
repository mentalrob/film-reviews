<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function comment()
    {
        return $this->morphOne(Comment::class, 'commentable');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
