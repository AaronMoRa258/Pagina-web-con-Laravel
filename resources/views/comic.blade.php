<!DOCTYPE html>
<html>

<head>
    <link href="{{ asset('BOOTSTRAP/CSS/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{ asset('BOOTSTRAP/ICONOS/bootstrap-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/comic.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/main.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Main.css')}}" rel="stylesheet" />
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Animes</title>
</head>

<body class="body-Background">
    @include('partials/header')
    @include('partials/nav')

    <section id="main">
        <article class="mt-4 mx-4" id="images"></article>
    </section>
    
    @include('partials/footer')
    @include('partials/routes')

    <script src="{{ asset('BOOTSTRAP/JS/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('JS/comics.js')}}"></script>
    <script src="{{ asset('JS/main.js')}}"></script>
    <script>
        // Obtiene informacion del anime seleccionado
        comic_Id = '{{ $comic_Id }}';

        if (isNaN(Number(comic_Id))) {
            window.location.href = `/`;
        }

        auth_Check();
        comic_Load(0);
    </script>
</body>
</html>
