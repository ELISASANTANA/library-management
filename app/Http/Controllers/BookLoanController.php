<?php

namespace App\Http\Controllers;

use App\Models\BookLoan;
use Illuminate\Http\Request;

class BookLoanController extends Controller
{
   
    /**
     * Indexa lista de emprestimos na view
     *
     * @return void
     */
    public function index() {

        $bookLoans = BookLoan::get();

        return view('pages.books.index', [
            'bookLoans' => $bookLoans
        ]);

    }



}
