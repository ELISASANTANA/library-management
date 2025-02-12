@extends('layouts.app')

@section('title', 'Usuários')

@section('content')

    <button class="bg-gray-300 hover:bg-gray-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
        <a href="{{ route('users.create') }}">Cadastrar Usuário</a>
    </button>      

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Número de Cadastro</th>
                <th class="px-4 py-2">Nome</th>
                <th class="px-4 py-2">Email</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td class="border px-4 py-2">{{ $user->id }}</td>
                    <td class="border px-4 py-2">{{ $user->name }}</td>
                    <td class="border px-4 py-2">{{ $user->email }}</td>
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
