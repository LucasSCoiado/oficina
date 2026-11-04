<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <title>Oficina</title>
</head>

<body class="bg-secondary min-vh-100 d-flex flex-column">
    <header class="p-2 bg-black text-white">
        <div class="d-flex justify-content-center bg-black">
            <h1 class="text-center  ">
                <i class="fa-solid fa-wrench"></i> Oficina <i class="fa-solid fa-gear"></i>
            </h1>
        </div>
    </header>
    <main class="mt-5 justify-content-center flex-grow-1">
        <div>
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