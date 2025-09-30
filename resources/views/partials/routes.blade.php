<script>
    const ANIME_ROUTE = "{{ asset('/animes/')}}";
    const ANIME_IMAGE_ROUTE = "{{ asset('IMG/Animes/')}}";
    const COMIC_ROUTE = "{{ asset('/comics/')}}";
    const ROOT_ROUTE = "{{ asset('/')}}";
    const ANIMES_API = [
        `/api/animes`, 
        `/api/animes/search`,
        `/api/animes/bookmarks`,
        `/api/animes/lists`
    ];
    const COMICS_API = [
        '/api/comics', 
        '/api/comics/search', 
        `/api/comics/bookmarks`,
        `/api/comics/lists`
    ];

    let login = {{ Auth::check() ? 'true' : 'false' }};

</script>