<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'title',
        'content',
    ];
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function($topic) {
            $topic->comments()->delete();
        });
    }
}
