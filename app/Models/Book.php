<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    function genre() {
        return $this->belongsTo(BookGenre::class, 'genre_id');
    }

    function scopeFindById($query, $id) {

        $query->where('id', $id);

        return $query;

    }
}
