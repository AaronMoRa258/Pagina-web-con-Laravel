<header>
    <div class="container-fluid m-1">
        <div class="align-items-center header-Elements-Container justify-content-between row">
            <a class="page-Image" href="{{ url('/') }}">
                <img alt="Logo" class="rounded-circle" id="logo" src="{{ asset('IMG/Logo.jpeg')}}" />
            </a>
            <h1 class="light-Color page-Name">Pagina Web Hecha Con Laravel</h1>
            <div class="search">
                <input class="form-control p-1" id="input-Search" placeholder="Buscar" type="text">
                <button class="btn btn-secondary" id="button-Search" onclick="search()" type="button"><i class="bi bi-search"></i></button>
            </div>
            <div class="user">
                <h5 class="user-Name" id="user-Name" onclick="sign_Up_Login('{{ route('form') }}')">
                    @if (Auth::check())
                        {{ Auth::user()->User }}
                    @else
                        Iniciar Sesión
                    @endif
                </h5>
                <i class="bi user-Icon" id="user-Icon" onclick="sign_Up_Login('{{ route('form') }}')"></i>
            </div>
        </div>
    </div>
</header>
