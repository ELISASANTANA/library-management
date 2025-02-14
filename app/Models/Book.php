<?php

namespace App\Models;

use App\Enums\BookStatusEnum;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    /**
     * Relaciona a entidade de genêros de livro
     *
     * @return void
     */
    function genre() {
        return $this->belongsTo(BookGenre::class, 'genre_id');
    }

    /**
     * Relaciona a entidade de emprestimos de livro
     *
     * @return void
     */
    function loan() {
        return $this->hasOne(BookLoan::class);
    }

    /**
     * Busca o registro de acordo com id
     *
     * @param [type] $query
     * @param [type] $id
     * @return void
     */
    function scopeFindById($query, $id) {

        $query->where('id', $id);

        return $query;

    }

    /**
     * Verfica quais livros estão disponíveis para empréstimo
     *
     * @param [type] $query
     * @return void
     */
    function scopeAvailable($query) {

        $query->leftJoin('book_loans as bl', 'bl.book_id', 'books.id')
            ->where(function ($q) {
                $q->where('bl.book_status_id', BookStatusEnum::RETURNED)
                ->orWhereNull('bl.id');
            });

        $query->select('books.*');

    }
}
