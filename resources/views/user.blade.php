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
    @include('partials/header')
    
    <nav class="navbar navbar-dark navbar-expand-lg">
      <div class="container-fluid px-4">
        <a class="active navbar-brand my-2 px-2" id="animes-Info" onclick="active_List('Animes')">Animes</a>
        <a class="navbar-brand my-2 px-2" id="comics-Info" onclick="active_List('Comics')">Comics</a>
        <a class="navbar-brand my-2 px-2" id="histories-Info" onclick="active_List('Histories')">Historias</a>
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
      <article id="animes-Bookmark-Container">
        <div class="lists mt-4 mx-4">
          <div class="container">
            <div class="row">
              <h3 class="light-Color list-Title">Favoritos</h3>
            </div>
            <div class="row">
              <div class="elements-List" id="elements-Bookmark"></div>
            </div>
          </div>
        </div>
      </article>
      <article id="animes-Other-List-Container">
        <div class="lists mt-4 mx-4" id="other-List"></div>
      </article>
      

      <article id="comics-Bookmark-Container"></article>
      <article id="comics-Other-List-Container"></article>

      <article id="histories-Bookmark-Container"></article>
      <article id="histories-Other-List-Container"></article>
    </section>

    @include('partials/footer')
    @include('partials/routes')

    <script src="{{ asset('BOOTSTRAP/JS/bootstrap.bundle.js')}}"></script>
    <script src="{{ asset('JS/index.js')}}"></script>
    <script src="{{ asset('JS/main.js')}}"></script>
    <script src="{{ asset('JS/user.js')}}"></script>
    <script>
      FOLLOWERS.innerHTML = 'Seguidores: {{ $Followers }}';
      FOLLOWING.innerHTML = 'Siguiendo: {{ $Following }}';
      NAME.innerHTML = '{{ $Name }}';
      USER.innerHTML = '@ {{ $User }}';

      auth_Check();
      bookmarks_Load('{{ $User }}');
      list_Check('{{ $User }}');
    </script>
  </body>
</html>
