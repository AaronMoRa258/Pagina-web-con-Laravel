<!DOCTYPE html>
<html lang="es">
  <head>
    <link href="{{ asset('BOOTSTRAP/CSS/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{ asset('BOOTSTRAP/ICONOS/bootstrap-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/cards.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/index.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/main.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Index.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Main.css')}}" rel="stylesheet" />
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Animes</title>
  </head>
  <body class="body-Background">
    @include("partials/header")
    @include("partials/nav")
    
    <section id="main">
      <div class="content mt-4 mx-4" id="container-Elements"></div>
      <div class="page-Changer">
        <button class="btn mt-4 mx-4 p-2" disabled id="before" onclick="pageBefore()">
          Anterior Página
        </button>
        <button class="btn mt-4 mx-4 p-2" id="next" onclick="pageNext()">
          Siguiente Página
        </button>
      </div>
    </section>

    @include("partials/footer")
    @include("partials/routes")

    <script src="{{ asset('BOOTSTRAP/JS/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('JS/main.js')}}"></script>
    <script>
      page = 1;
      api = "{{ $api }}";
      query = "{{ $query }}";
      type = "{{ $type }}";
      
      switch (type) {
        case "comic":
          apiRoute = COMICS_API[api];
          apiQuery("", COMIC_ROUTE);
          break;
        default:
          apiRoute = ANIMES_API[api];
          apiQuery(ANIME_IMAGE_ROUTE, ANIME_ROUTE);
          break;
      }

      authCheck();
    </script>
  </body>
</html>
