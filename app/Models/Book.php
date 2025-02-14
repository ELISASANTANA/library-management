<?php

namespace App\Models;

use App\Enums\BookStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    function genre() {
        return $this->belongsTo(BookGenre::class, 'genre_id');
    }

    function loan() {
        return $this->hasOne(BookLoan::class);
    }

    function scopeFindById($query, $id) {

        $query->where('id', $id);

        return $query;

    }

    function scopeAvailable($query) {

        $query->leftJoin('book_loans as bl', 'bl.book_id', 'books.id')
            ->where(function ($q) {
                $q->where('bl.book_status_id', BookStatusEnum::RETURNED)
                ->orWhereNull('bl.id');
            });

        $query->select('books.*');

    }
}
