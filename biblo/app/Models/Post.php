<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $fillable = ['thread_id','user_id','body'];

    public function thread() { return $this->belongsTo(Thread::class); }
    public function user() { return $this->belongsTo(User::class); }
}
