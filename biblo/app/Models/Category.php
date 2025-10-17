<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Category extends Model
{
    protected $fillable = ['name','slug','description'];

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }
}
