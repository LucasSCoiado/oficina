<div class="container d-flex justify-content-between mb-4">
    <div class="text-start">
        <h2><i class="fa-solid fa-car"></i> Carros</h2>
    </div>
    <div class="text-end">
        <a href="#" class="btn {{ request()->routeIs('carros.*') ? 'btn-primary' : 'btn-light' }} mt-2">Carros</a>
        <a href="#" class="btn btn-light mt-2">Trabalho</a>
        <a href="#" class="btn btn-light mt-2">Fila</a>
        <a href="#" class="btn btn-light mt-2">Finalizado</a>
        <a href="{{ route('home') }}" class="btn btn-success mt-2">Menu</a>
    </div>
</div>