<div class="container d-flex justify-content-between mb-4">
    <div class="text-start">
        <h2><i class="fa-solid fa-car"></i> Carros</h2>
    </div>
    <div class="text-end">
        <a href="{{ route('carros.index') }}"
            class="btn {{ request()->routeIs('carros.index') ? 'btn-primary' : 'btn-light' }} mt-2">Carros</a>
        <a href="{{ route('carros.trabalho') }}"
            class="btn {{ request()->routeIs('carros.trabalho') ? 'btn-primary' : 'btn-light' }} mt-2">Em
            trabalho</a>
        <a href="{{ route('carros.finalizado') }}"
            class="btn {{ request()->routeIs('carros.finalizado') ? 'btn-primary' : 'btn-light'}} mt-2">Finalizado</a>
        <a href="{{ route('home') }}" class="btn btn-success mt-2">Menu</a>
    </div>
</div>