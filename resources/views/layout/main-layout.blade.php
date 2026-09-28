<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oficina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <style>
        .navbar-dark .navbar-menu-link {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            transition: padding 0.5s ease-in-out;
        }

        .navbar-dark .navbar-menu-link:hover {
            padding: 0.5rem 0.75rem;
        }
    </style>
</head>

<body class="bg-secondary min-vh-100">
    <header>
        @include('layout.top_bar')
    </header>
    <main>
        <div class="bg-secondary">
            @yield('content')
        </div>
    </main>
    <footer></footer>
</body>

</html>