<!DOCTYPE html>
<html>

<head>
    <link href="{{ asset('BOOTSTRAP/CSS/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{ asset('BOOTSTRAP/ICONOS/bootstrap-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/chapters.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/main.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Chapters.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Main.css')}}" rel="stylesheet" />
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Animes</title>
</head>

<body class="body-Background">
    @include('partials/header')

    <section class="mx-4" id="main">
        <article class="justify-content-center mt-4" id="chapter-Changer">
            <button class="btn btn-secondary col-1 p-2 rounded-end-0 rounded-start-5" id="before" onclick="chapter_Before()" type="button"><i class="bi bi-caret-left-fill"></i></button>
            <button class="btn btn-secondary col-9 p-2 rounded-0" id="anime-Info-Back" onclick="anime_Info_Back()" type="button">Episodios</button>
            <button class="btn btn-secondary col-1 p-2 rounded-end-5 rounded-start-0" id="next" onclick="chapter_Next()" type="button"><i class="bi bi-caret-right-fill"></i></button>
        </article>
        <article class="card-Background card content mt-2" id="chapter"></article>
    </section>

    <section class="mx-4" id="secondary">
        <article class="card-body anime-Info mt-4 px-2 py-1">
            <h3 class="mx-2 my-1 px-1" id="anime-Name"></h3>
            <p class="mx-2 my-1 px-1" id="chapter-Number"></p>
            <p class="mx-2 my-1 px-1" id="extra-Info"></p>
            <p class="mx-2 my-1 px-1" id="anime-Description"></p>
        </article>
        <article class="comments" id="comments"></article>
    </section>

    <aside class="me-4 mt-4" id="chapters-List"></aside>

    @include('partials/footer')
    @include('partials/routes')

    <script src="{{ asset('BOOTSTRAP/JS/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('JS/chapters.js')}}"></script>
    <script src="{{ asset('JS/main.js')}}"></script>
    <script>
        // Obtiene informacion del anime y capitulo seleccionado
        anime_Id = '{{ $anime_Id }}';
        chapter =  '{{ $chapter_Id }}';

        if (isNaN(Number(anime_Id))) {
            window.location.href = `/`;
        }

        if (isNaN(Number(chapter))) {
            window.location.href = `/${anime_Id}/cap-1`;
        }

        auth_Check();
        chapter_Load();
    </script>
</body>
</html>
