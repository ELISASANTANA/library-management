<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookLoan extends Model
{

    /**
     * Relaciona a entidade de usuário
     *
     * @return void
     */
    function user() {
        return $this->belongsTo(User::class);
    }

    /**
     * Relaciona a entidade de livros
     *
     * @return void
     */
    function book() {
        return $this->belongsTo(Book::class);
    }

    /**
     * Relaciona a entidade de status 
     *
     * @return void
     */
    function status() {
        return $this->belongsTo(BookStatus::class, 'book_status_id');
    }

}
