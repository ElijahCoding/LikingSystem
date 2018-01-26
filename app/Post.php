<?php

namespace App;

use Auth;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    protected $appends = ['likeCount', 'likedByCurrentUser'];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function scopeLatestFirst($builder)
    {
      return $builder->orderBy('created_at', 'desc');
    }

    public function getLikeCountAttribute()
    {
      return $this->likes->count();
    }

    public function getLikedByCurrentUserAttribute()
    {
      if (!Auth::check()) {
        return false;
      }

      return $this->likes->where('user_id', auth()->id())->count() === 1;
    }

    public function likes()
    {
      return $this->morphMany(Like::class, 'likeable');
    }
}
