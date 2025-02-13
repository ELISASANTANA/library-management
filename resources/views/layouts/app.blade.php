<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Laravel App')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script>
        window.Laravel = <?php echo json_encode([
            'url' => url('/'),
            'csrfToken' => csrf_token(),
            'locale' => Session::get('language_locale'),
            'app_develop' => env('APP_DEBUG'),
            'j_spread_sheet_license' => env('J_SPREAD_SHEET_LICENSE'),
        ]); ?>
    </script>
</head>
<body class="bg-gray-100">
    <header class="bg-cyan-950 text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <h1 class="text-xl font-bold">Biblioteca</h1>
            <nav>
                <a href="{{ route('home') }}" class="px-4 hover:underline">Home</a>
                <a href="{{ route('users.index') }}" class="px-4 hover:underline">Usuários</a>
                <a href="{{ route('books.index') }}" class="px-4 hover:underline">Livros</a>
                <a href="{{ route('book_loans.index') }}" class="px-4 hover:underline">Emprestimo</a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-6">
        @yield('content')
    </main>

</body>
</html>