<!DOCTYPE html>
<html>

<head>
    <link href="{{ asset('BOOTSTRAP/CSS/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{ asset('BOOTSTRAP/ICONOS/bootstrap-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/comic.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/element_Info.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/extra_Actions.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/main.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Element_Info.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Extra_Actions.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Main.css')}}" rel="stylesheet" />
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Animes</title>
</head>

<body class="body-Background">
    @include('partials/header')

    <section id="main">
        @include('partials/element_Info')
    </section>

    <section id="secondary">
        <article class="mt-4 mx-4" id="images"></article>
    </section>
    
    @include('partials/footer')
    @include('partials/routes')

    <script src="{{ asset('BOOTSTRAP/JS/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('JS/comics.js')}}"></script>
    <script src="{{ asset('JS/extra_Actions.js')}}"></script>
    <script src="{{ asset('JS/main.js')}}"></script>
    <script>
        // Obtiene informacion del anime seleccionado
        comic_Id = element_Id = '{{ $id }}';
        api = COMICS_API;

        auth_Check();
        comic_Load('{{ $description }}', '{{ $front_Page }}', '{!! $extra_Info !!}', '{{ $name }}');
    </script>
</body>
</html>
