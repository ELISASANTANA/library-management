<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookGenre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookController extends Controller
{

    /**
     * Indexa lista de livros na view
     *
     * @return void
     */
    public function index() {

        $books = Book::with('genre')->get();

        return view('pages.books.index', [
            'books' => $books
        ]);

    }

    /**
     * Redireciona ao formulário de cadastro
     *
     * @return void
     */
    public function create() {

        $book = new Book();
        $bookGenres = BookGenre::all();

        return view('pages.books.form', [
            'book' => $book,
            'bookGenres' => $bookGenres
        ]);

    }

    /**
     * Persite os dados do cadastro no banco de dados
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request) {

        $validator = $this->validation($request);

        if (!$validator->fails()) {

            try {

                $book = new Book();

                $this->save($book, $request);

                return redirect('books')->withSuccess('Usuário criado com sucesso!');

            } catch (\Throwable $e) {

                return redirect()->withErrors($e->getMessage())->withInput(); 
 
            }
        }
        
        return redirect()->withInput(); 

    }

    /**
     * Redireciona ao formulário de edição
     *
     * @param [type] $id
     * @return void
     */
    public function edit($id) {

        if ($id && is_numeric($id)) {

            $book = Book::findById($id)->first();
            $bookGenres = BookGenre::all();

            return view('pages.books.form', [
                'book' => $book,
                'bookGenres' => $bookGenres
            ]);
        }
    }

    /**
     * Atualiza as informações no banco
     *
     * @param Request $request
     * @param [type] $id
     * @return void
     */
    public function update(Request $request, $id) {

        $request->merge(['id' => $id]);
        $validator = $this->validation($request);

        if (!$validator->fails()) {

            $book = Book::findById($id)->first();

            if ($book) {

                $this->save($book, $request);

                return redirect('books')->withSuccess('Usuário atualizado com sucesso!');

            }

            return redirect()->withErrors('Usuário não encontrado')->withInput();
        }

        return redirect()->withErrors('Dados Inválidos.')->withInput(); 
        
    }

    private function save(Book $book, Request $request) {

        $book->name = $request->name;
        $book->author = $request->author;
        $book->genre_id = $request->genre_id;
        $book->is_available = true;

        $book->save();
    }


    public function destroy($id) {

        if ($id && is_numeric($id)) {

            $book = Book::findOrFail($id)->first();

            if ($book) {

                $book->delete();
                
                return redirect('books')->withSuccess('Usuário deletado com sucesso!');
            }

            return redirect()->withErrors('Usuário não encontrado')->withInput(); 
        }

    }

    private function validation(Request $request) {

        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string'],
            'author' => ['required', 'string'],
            'genre_id' => ['required', 'integer']
        ]);

        $validator->sometimes('id', 'required|numeric', function ($request) {
            return $request->_method == 'PUT';
        });

        return $validator;
    }

}
