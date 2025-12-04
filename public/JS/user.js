// Sirve para indicar el tipo de elementos mostrados
export function activeList(type) {
    switch (type) {
        case "Comics":
            showHide(1, 4, 1);
            break;
        case "Histories":
            showHide(2, 5, 2)
            break;
        default:
            showHide(0, 3, 0)
            break;
    }
}

// Permite cargar la lista de marcadores del usuario
export async function bookmarksLoad(ANIMES_API, COMICS_API, user) {
    const resAnime = await fetch(ANIMES_API[2].concat("/load/", user, "/", true));
    const dataAnime = await resAnime.json();
    
    const resComic = await fetch(COMICS_API[2].concat("/load/", user, "/", true));
    const dataComic = await resComic.json();
    
    return {
        animeBookmarks: dataAnime,
        comicBookmarks: dataComic,
    }
}


// Realiza una verificacion de las listas del usuario
export async function listsLoad(ANIMES_API, COMICS_API, user) {
    const resAnime = await fetch(ANIMES_API[3].concat("/load/", user, "/", true));
    const dataAnime = await resAnime.json();
    
    const resComic = await fetch(COMICS_API[3].concat("/load/", user, "/", true));
    const dataComic = await resComic.json();
    
    return {
        animeList: dataAnime,
        comicList: dataComic,
    }
}

// Muestra u oculta contenido segun el tipo de elementos seleccionados (clase active)
function showHide(cont_1, cont_2, element) {
    // Obtiene elementos para su posterior modificacion
    const ANIMES_INFO = document.getElementById("animes-Info");
    const COMICS_INFO = document.getElementById("comics-Info");
    const HISTORIES_INFO = document.getElementById("histories-Info");

    const ANIMES_BOOKMARK_CONTAINER = document.getElementById("animes-Bookmark-Container");
    const COMICS_BOOKMARK_CONTAINER = document.getElementById("comics-Bookmark-Container");
    const HISTORIES_BOOKMARK_CONTAINER = document.getElementById("histories-Bookmark-Container");

    const ANIMES_OTHER_LIST_CONTAINER = document.getElementById("animes-Other-List-Container");
    const COMICS_OTHER_LIST_CONTAINER = document.getElementById("comics-Other-List-Container");
    const HISTORIES_OTHER_LIST_CONTAINER = document.getElementById("histories-Other-List-Container");

    // Variables a utilizar
    let containersList = [ANIMES_BOOKMARK_CONTAINER, COMICS_BOOKMARK_CONTAINER,
        HISTORIES_BOOKMARK_CONTAINER, ANIMES_OTHER_LIST_CONTAINER,
        COMICS_OTHER_LIST_CONTAINER, HISTORIES_OTHER_LIST_CONTAINER
    ];

    let navElementsList = [ANIMES_INFO, COMICS_INFO, HISTORIES_INFO];
    
    for (let i = 0; i < containersList.length; i++) {
        if (i == cont_1 || i == cont_2) {
            containersList[i].style.display = "block";
        } else {
            containersList[i].style.display = "none";
        }
    }

    for (let i = 0; i < navElementsList.length; i++) {
        if (i == element) {
            navElementsList[i].classList.add("active");
        } else {
            navElementsList[i].classList.remove("active");
        }
    }
}
