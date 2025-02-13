@extends('layouts.app')

@section('title', 'Empréstimo')

@section('content')

    <x-alert></x-alert>

    <div class="w-full flex justify-center">

        @php
            $isEdit = !!$bookLoan->id;
            $action = $isEdit ? route('book_loans.update', $bookLoan->id) : route('book_loans.store');
        @endphp

        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{ $action }}" method="post">

            @csrf
            @method($isEdit ? 'PUT' : 'POST')

            <div class="mb-4" style="width: 270px;">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Usuário
                </label>
                <div class="flex items-center justify-between ">
                    <select
                        class="shadow bg-white appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="user_id">
                        <option value="">Selecione</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Livro
                </label>
                <div class="flex items-center justify-between">
                    <select
                        class="shadow bg-white appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="book_id">
                        <option value="">Selecione</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}">{{ $book->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Data de devolução
                </label>
                
                <input type="date" name="due_date" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="YYYY-MM-DD" />

            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-slate-400 hover:bg-slate-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="button">
                    <a href="{{ route('book_loans.index') }}">Voltar</a>
                </button>
                <button
                    class="bg-cyan-950 hover:bg-cyan-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="submit">
                    Cadastrar
                </button>
            </div>
        </form>
    </div>
@endsection
