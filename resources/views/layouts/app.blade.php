<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <header class="bg-red-500 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Biblioteca</h1>
            <nav>
                <a href="{{ route('home') }}" class="px-4 hover:underline">Home</a>
                <a href="{{ route('users.index') }}" class="px-4 hover:underline">Usuários</a>
                <a href="{{ route('books.index') }}" class="px-4 hover:underline">Livros</a>
                <a href="" class="px-4 hover:underline">Emprestimo</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-6">
        @yield('content')
    </main>

</body>
</html>