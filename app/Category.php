<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * RELATION WITH POSTS
     */
    public function posts() {
        return $this->hasMany('App\Posts');
    }
}
