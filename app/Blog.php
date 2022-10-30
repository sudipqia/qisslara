<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /**
     * Get the user that owns the phone.
     */
    public function author()
    {
        return $this->belongsTo(BlogAuthor::class, 'author_id', 'id');
    }
}
