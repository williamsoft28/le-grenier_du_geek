<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Thread extends Model
{
    protected $fillable = ['user_id','category_id','title','slug','excerpt'];

    public function category() { return $this->belongsTo(Category::class); }
    public function user() { return $this->belongsTo(User::class); }
    public function posts() { return $this->hasMany(Post::class)->orderBy('created_at'); }

    // helper pour dernier post
    public function latestPost() { return $this->hasOne(Post::class)->latestOfMany(); }
}
