@extends('layouts.app')

@section('title', 'Criar Usuário')

@section('content')

    <x-alert></x-alert>

    <div class="w-full flex justify-center">

        @php
            $isEdit = !!$user->id;
            $action = $isEdit ? route('users.update', $user->id) : route('users.store');
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
                    id="username" type="text" placeholder="Nome" name="name" value="{{ old('name', $user->name) }}">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                    E-mail
                </label>
                <input
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="username" type="email" placeholder="email@gmail.com" name="email"
                    value="{{ old('email', $user->email) }}">
            </div>
            <div class="flex items-center justify-between">
                <button
                    class="bg-slate-400 hover:bg-slate-500 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                    type="button">
                    <a href="{{ route('users.index') }}">Voltar</a>
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
