<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = [
        'review_point'
    ];

    public function comment()
    {
        return $this->morphOne(Comment::class, 'commentable');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getReviewPointAttribute()
    {
        if ($this->reviews->count() === 0) return 0;
        return ($this->reviews->sum('rate') / $this->reviews->count());
    }
}
