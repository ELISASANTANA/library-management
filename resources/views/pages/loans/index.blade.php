@extends('layouts.app')

@section('title', 'Empréstimos')

@section('content')

    @php
        use App\Enums\BookStatusEnum;
    @endphp

    <button class="bg-gray-300 hover:bg-gray-500 text-gray-800 font-bold py-2 px-4 rounded inline-flex items-center">
        <a href="{{ route('book_loans.create') }}">Realizar Emprestimo</a>
    </button>      

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Número de Cadastro</th>
                <th class="px-4 py-2">Usuário</th>
                <th class="px-4 py-2">Livro</th>
                <th class="px-4 py-2">Status</th>
                <th class="px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bookLoans as $loan)
                <tr>
                    <td class="border px-4 py-2 text-center">{{ $loan->id }}</td>
                    <td class="border px-4 py-2 text-center">{{ $loan->user->name }}</td>
                    <td class="border px-4 py-2 text-center">{{ $loan->book->name }}</td>
                    <td class="border px-4 py-2 text-center">{{ $loan->status->name }}</td>
                    <td class="border px-4 py-2 text-center">

                        @if ($loan->status->id != BookStatusEnum::RETURNED)
                            <button data-loan-id="{{ $loan->id }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-2 rounded inline-flex items-center" title="Devolvido" id="returned">
                                <img src="{{ asset('assets/icons/like.svg') }}" class="w-4">
                            </button>
                        @endif

                        @if ($loan->status->id == BookStatusEnum::LOANED)
                            <button data-loan-id="{{ $loan->id }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-2 rounded inline-flex items-center" title="Atrasado" id="overdue">
                                <img src="{{ asset('assets/icons/dislike.svg') }}" class="w-4">
                            </button>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
