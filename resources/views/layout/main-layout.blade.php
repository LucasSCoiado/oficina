<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Oficina</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
    </style>
</head>

<body class="bg-secondary min-vh-100 d-flex flex-column">
    <header>
        @include('layout.top_bar')
    </header>
    <main class="mt-5 justify-content-center flex-grow-1">
        <div class="bg-secondary">
            @yield('content')
        </div>
    </main>
    <footer class="bg-black text-white p-2 mt-auto">
        <div class="container">
            <p class="text-center">&copy; 2023 Oficina. Todos os direitos reservados.</p>
        </div>
    </footer>
</body>

</html>