<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="{{ route("dashboard.index") }}">Locadora</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route("dashboard.index") }}">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("veiculos.index") }}">Veículos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route("usuarios.index") }}">Usuários</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route("reservas.index") }}">Reservas</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Acesso
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">{{ auth()->user()->name }}</a>

                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route("auth.logout") }}">Logout</a>
                    </div>
                </li>

            </ul>

        </div>
    </div>

</nav>
