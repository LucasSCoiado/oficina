<div class="p-0">
    <div class=" p-2 rounded-3 d-flex align-items-center flex-wrap">
        <a href="#"
            class="btn btn-secondary link-light link-offset-1 link-underline link-underline-opacity-0 link-underline-opacity-75-hover m-1 navbar-menu-link">Carros</a>
        <a href="#"
            class="btn btn-secondary link-light link-offset-1 link-underline link-underline-opacity-0 link-underline-opacity-75-hover m-1 navbar-menu-link">Clientes</a>
        <a href="#"
            class="btn btn-secondary link-light link-offset-1 link-underline link-underline-opacity-0 link-underline-opacity-75-hover m-1 navbar-menu-link">Funcionários</a>
        <a href="#"
            class="btn btn-secondary link-light link-offset-1 link-underline link-underline-opacity-0 link-underline-opacity-75-hover m-1 navbar-menu-link">Peças</a>
        <a href="#"
            class="btn btn-secondary link-light link-offset-1 link-underline link-underline-opacity-0 link-underline-opacity-75-hover m-1 navbar-menu-link">Serviços</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Sair</button>
        </form>
    </div>
</div>