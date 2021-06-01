<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'slug', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function tags() {
        //posso anche inserire la tabella ('App\Tag', 'tags_posts');
        return $this->belongsToMany('App\Tag');
    }
}
