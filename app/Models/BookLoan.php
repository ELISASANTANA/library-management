<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookLoan extends Model
{

    function user() {
        return $this->belongsTo(User::class);
    }

    function book() {
        return $this->belongsTo(Book::class);
    }

    function status() {
        return $this->belongsTo(BookStatus::class, 'book_status_id');
    }

}
