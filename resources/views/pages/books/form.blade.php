@extends('layouts.app')

@section('title', 'Criar Usuário')

@section('content')

    <x-alert></x-alert>

    <div class="w-full flex justify-center">

        @php
            $isEdit = !!$book->id;
            $action = $isEdit ? route('books.update', $book->id) : route('books.store');
        @endphp

        <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" action="{{ $action }}" method="post">

            @csrf
            @method($isEdit ? 'PUT' : 'POST')

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Nome
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="username" type="text" placeholder="Nome" name="name" value="{{ old('name', $book->name) }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Autor
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="username" type="text" placeholder="Autor" name="author"
                    value="{{ old('author', $book->author) }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    Gênero
                </label>

                <div class="flex items-center justify-between">
                    <select
                        class="shadow bg-white appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" name="genre_id">
                        <option value="">Selecione</option>
                        @foreach ($bookGenres as $genre)
                            <option {{ $book->genre_id == $genre->id ? 'selected' : '' }} value="{{ $genre->id }}">{{ $genre->name }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-slate-400 hover:bg-slate-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="button">
                    <a href="{{ route('books.index') }}">Voltar</a>
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
