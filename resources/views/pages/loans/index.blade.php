@extends('layouts.app')

@section('title', 'Empréstimos')

@section('content')

    <button class="bg-gray-300 hover:bg-gray-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
        <a href="{{ route('users.create') }}">Cadastrar Usuário</a>
    </button>      

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Número de Cadastro</th>
                <th class="px-4 py-2">Livro</th>
                <th class="px-4 py-2">Usuário</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookLoans as $loan)
                <tr>
                    <td class="border px-4 py-2">{{ $loan->id }}</td>
                    <td class="border px-4 py-2">{{ $loan->book_id }}</td>
                    <td class="border px-4 py-2">{{ $user->user_id }}</td>
                    <td class="border px-4 py-2">{{ $user->status }}</td>
                    <td class="border px-4 py-2">
                        <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-2 rounded inline-flex items-center" title="Editar">
                            <a href="{{ route('users.edit', $user->id) }}"><img src="{{ asset('assets/icons/edit.svg') }}" class="w-4"></a>
                        </button>

                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="inline-flex items-center">
                            @csrf
                            @method('delete')
                            <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-2 rounded" title="Apagar" type="submit">
                                <img src="{{ asset('assets/icons/garbage.svg') }}" class="w-4">
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
