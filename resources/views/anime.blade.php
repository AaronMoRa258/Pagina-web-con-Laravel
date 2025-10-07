<!DOCTYPE html>
<html>

<head>
    <link href="{{ asset('BOOTSTRAP/CSS/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{ asset('BOOTSTRAP/ICONOS/bootstrap-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/anime.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/element_Info.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/extra_Actions.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/main.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Anime.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Element_Info.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Extra_Actions.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Main.css')}}" rel="stylesheet" />
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Animes</title>
</head>

<body class="body-Background">
    @include("partials/header")

    <section id="main">
        @include("partials/element_Info")
        <article class="mt-4 mx-4" id="chapters"></article>
    </section>
    
    @include("partials/footer")
    @include("partials/routes")

    <script src="{{ asset('BOOTSTRAP/JS/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('JS/anime.js')}}"></script>
    <script src="{{ asset('JS/extra_Actions.js')}}"></script>
    <script src="{{ asset('JS/main.js')}}"></script>
    <script>
        // Obtiene informacion del anime seleccionado
        animeId = elementId = "{{ $id }}";
        api = ANIMES_API;
        
        animeLoad("{{ $description }}", "{!! $extraInfo !!}", "{{ $image }}", "{{ $name }}", "{{ $chaptersNumber }}");
        authCheck();
    </script>
</body>
</html>
