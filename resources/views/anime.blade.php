<!DOCTYPE html>
<html>

<head>
    <link href="{{ asset('BOOTSTRAP/CSS/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{ asset('BOOTSTRAP/ICONOS/bootstrap-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/anime.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/main.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Anime.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Main.css')}}" rel="stylesheet" />
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Animes</title>
</head>

<body class="body-Background">
    @include('partials/header')
    @include('partials/nav')

    <section id="main">
        <article class="card anime-Gradient mt-4 mx-4" id="anime-Info">
            <div class='container-fluid'>
                <div class='align-items-center gap-3 p-3 row'>
                    <div class='anime-Image p-1' id='anime-Image'></div>
                        <div class='information'>
                            <div class='card-body p-1'>
                                <h3 class='card-title' id='anime-Name'></h3>
                                <p class='card-text' id='anime-Description'></p>
                                <div>
                                    <ul class='extra-Info gap-2' id='extra-Info'></ul>
                                </div>

                                @include('partials/extra_Actions')
                            </div>
                        </div>
                    </div>
                <div class='anime-Background-Image'></div>
            </div>
        </article>
        <article class="mt-4 mx-4" id="chapters"></article>
    </section>
    
    @include('partials/footer')
    @include('partials/routes')

    <script src="{{ asset('BOOTSTRAP/JS/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('JS/anime.js')}}"></script>
    <script src="{{ asset('JS/main.js')}}"></script>
    <script>
        // Obtiene informacion del anime seleccionado
        anime_Id = '{{ $id }}';

        auth_Check();
        anime_Load('{{ $chapters }}', '{{ $description }}', '{!! $extra_Info !!}', '{{ $image }}', '{{ $name }}');
    </script>
</body>
</html>
