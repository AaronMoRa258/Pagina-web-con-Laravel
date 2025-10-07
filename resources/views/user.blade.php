<!DOCTYPE html>
<html lang="es">
  <head>
    <link href="{{ asset('BOOTSTRAP/CSS/bootstrap.css')}}" rel="stylesheet" />
    <link href="{{ asset('BOOTSTRAP/ICONOS/bootstrap-icons.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/cards.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/main.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/user.css')}}" rel="stylesheet" />
    <link href="{{ asset('CSS/media_Main.css')}}" rel="stylesheet" />
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Animes</title>
  </head>
  <body class="body-Background">
    @include("partials/header")
    
    <nav class="navbar navbar-dark navbar-expand-lg">
      <div class="container-fluid px-4">
        <a class="active navbar-brand my-2 px-2" id="animes-Info" onclick="activeList('Animes')">Animes</a>
        <a class="navbar-brand my-2 px-2" id="comics-Info" onclick="activeList('Comics')">Comics</a>
        <a class="navbar-brand my-2 px-2" id="histories-Info" onclick="activeList('Histories')">Historias</a>
      </div>
    </nav>

    <section id="main">
        <article class="justify-content-center user-Info">
            <div class="container">
              <div class="justify-content-center row">
                <img alt="user-Image" class="rounded-circle" id="user-Image" src="{{ asset('IMG/Logo.jpeg')}}">
              </div>
              <div class="row" id="main-Info">
                <p class="light-Color text-center" id="name"></p>
                <p class="light-Color text-center" id="user"></p>
              </div>
              <div class="row" id="followers-Info">
                <p class="light-Color text-center" id="followers"></p>
                <p class="light-Color text-center" id="following"></p>
              </div>
            </div>
        </article>
    </section>
    <section id="secondary">
      @include("partials/lists_Container", [
        "id_1" => "animes-Bookmark-Container",
        "id_2" => "anime-Bookmark-Elements",
        "id_3" => "animes-Other-List-Container",
        "id_4" => "anime-Other-List-Elements"
        ])
      

      @include("partials/lists_Container", [
        "id_1" => "comics-Bookmark-Container",
        "id_2" => "comic-Bookmark-Elements",
        "id_3" => "comics-Other-List-Container",
        "id_4" => "comic-Other-List-Elements"
        ])
      
        @include("partials/lists_Container", [
        "id_1" => "histories-Bookmark-Container",
        "id_2" => "history-Bookmark-Elements",
        "id_3" => "histories-Other-List-Container",
        "id_4" => "history-Other-List-Elements"
        ])
    </section>

    @include("partials/footer")
    @include("partials/routes")

    <script src="{{ asset('BOOTSTRAP/JS/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('JS/main.js')}}"></script>
    <script src="{{ asset('JS/user.js')}}"></script>
    <script>
      FOLLOWERS.innerHTML = "Seguidores: {{ $followers }}";
      FOLLOWING.innerHTML = "Siguiendo: {{ $following }}";
      NAME.innerHTML = "{{ $name }}";
      USER.innerHTML = "@ {{ $user }}";

      authCheck();
      bookmarksLoad("{{ $user }}");
      listCheck("{{ $user }}");
    </script>
  </body>
</html>
