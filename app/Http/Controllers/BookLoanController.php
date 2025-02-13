<?php

namespace App\Http\Controllers;

use App\Enums\BookStatusEnum;
use App\Models\Book;
use App\Models\BookLoan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookLoanController extends Controller
{
   
    /**
     * Indexa lista de emprestimos na view
     *
     * @return void
     */
    public function index() {

        $bookLoans = BookLoan::with('user', 'book')->get();

        return view('pages.loans.index', compact('bookLoans'));

    }

    /**
     * Redireciona ao formulário
     *
     * @return void
     */
    public function create() {

        $bookLoan = new BookLoan();
        $users = User::all();
        $books = Book::available()->get();

        dd($books);

        return view('pages.loans.form', compact('users', 'books', 'bookLoan'));

    }

    /**
     * Persite os dados do cadastro no banco de dados
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {

        $request->merge(['book_status_id' => BookStatusEnum::LOANED]);
        $validator = $this->validation($request);

        if (!$validator->fails()) {

            try {

                $bookLoan = new BookLoan();

                $this->save($bookLoan, $request);

                return redirect('book_loans')->withSuccess('Usuário criado com sucesso!');

            } catch (\Throwable $e) {

                return back()->withErrors($e->getMessage())->withInput(); 
 
            }
        }
        
        return back()->withErrors('Dados Inválidos. ' . $validator->errors()->first()); 

    }

    /**
     * Atualiza dados de emprestimo
     *
     * @param Request $request
     * @return void
     */
    public function update(Request $request) {

        $validator = $this->validation($request);

        if (!$validator->fails()) {

            $bookLoan = BookLoan::where('id', $request->id)->first();

            $bookLoan->book_status_id = $request->book_status_id;
            $bookLoan->save();

            return response('Status atualizado com sucesso!', 200); 
        }

        return response('Dados Invalidos', 403); 

    }

    /**
     * Persiste os dados no banco
     *
     * @param BookLoan $bookLoan
     * @param Request $request
     * @return void
     */
    private function save(BookLoan $bookLoan, Request $request) {

        $bookLoan->book_id = $request->book_id;
        $bookLoan->user_id = $request->user_id;
        $bookLoan->book_status_id = $request->book_status_id;
        $bookLoan->due_date = $request->due_date;

        $bookLoan->save();

    }

    /**
     * Validação de dados
     *
     * @param Request $request
     * @return Validation
     */
    private function validation(Request $request) {

        $validator = Validator::make($request->all(), [
            'book_status_id' => ['required', 'integer'],
        ]);

        $nullableInUpdate = ['book_id', 'user_id', 'due_date'];

        foreach ($nullableInUpdate as $field) {
            $validator->sometimes($field, 'nullable', function ($request) {
                return $request->getMethod() == 'PUT';
            });
        }

        $validator->sometimes('id', 'required|numeric', function ($request) {
            return $request->getMethod() == 'PUT';
        });

        return $validator;

    }
}
