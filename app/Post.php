<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function scopeLatestFirst($builder)
    {
      return $builder->orderBy('created_at', 'desc');
    }
}
