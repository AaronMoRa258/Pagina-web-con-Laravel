// Obtiene elementos para su posterior modificacion
const FOLLOWERS = document.getElementById("followers");
const FOLLOWING = document.getElementById("following");
const NAME = document.getElementById("name");
const USER = document.getElementById("user");

const ANIMES_INFO = document.getElementById("animes-Info");
const COMICS_INFO = document.getElementById("comics-Info");
const HISTORIES_INFO = document.getElementById("histories-Info");

const ANIME_BOOKMARK_ELEMENTS = document.getElementById("anime-Bookmark-Elements");
const COMIC_BOOKMARK_ELEMENTS = document.getElementById("comic-Bookmark-Elements");
const HISTORY_BOOKMARK_ELEMENTS = document.getElementById("history-Bookmark-Elements");

const ANIME_OTHER_LIST_ELEMENTS = document.getElementById("anime-Other-List-Elements");
const COMIC_OTHER_LIST_ELEMENTS = document.getElementById("comic-Other-List-Elements");
const HISTORY_OTHER_LIST_ELEMENTS = document.getElementById("history-Other-List-Elements");

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

// Sirve para indicar el tipo de elementos mostrados
function activeList(type) {
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
function bookmarksLoad(user) {
    fetch(ANIMES_API[2].concat("/load/", user, "/", true))
    .then((res) => res.json())
    .then((data) => {
        ANIME_BOOKMARK_ELEMENTS.innerHTML = listsLoad(ANIME_IMAGE_ROUTE, data, "", ANIME_ROUTE);
    });

    fetch(COMICS_API[2].concat("/load/", user, "/", true))
    .then((res) => res.json())
    .then((data) => {
        COMIC_BOOKMARK_ELEMENTS.innerHTML = listsLoad("", data, "", COMIC_ROUTE);
    });
}

// Realiza una verificacion de las listas del usuario
function listCheck(user) {
    fetch(ANIMES_API[3].concat("/load/", user))
    .then((res) => res.json())
    .then((data) => {
        if (data.Completed.length > 0) {
            ANIME_OTHER_LIST_ELEMENTS.innerHTML += listsLoad(ANIME_IMAGE_ROUTE, data.Completed, "Completado", ANIME_ROUTE);
        }

        if (data.Discarded.length > 0) {
            ANIME_OTHER_LIST_ELEMENTS.innerHTML += listsLoad(ANIME_IMAGE_ROUTE, data.Discarded, "Descartado", ANIME_ROUTE);
        }

        if (data.Paused.length > 0) {
            ANIME_OTHER_LIST_ELEMENTS.innerHTML += listsLoad(ANIME_IMAGE_ROUTE, data.Paused, "Pausado", ANIME_ROUTE);
        }

        if (data.Watched.length > 0) {
            ANIME_OTHER_LIST_ELEMENTS.innerHTML += listsLoad(ANIME_IMAGE_ROUTE, data.Watched, "Por Ver", ANIME_ROUTE);
        }

        if (data.Watching.length > 0) {
            ANIME_OTHER_LIST_ELEMENTS.innerHTML += listsLoad(ANIME_IMAGE_ROUTE, data.Watching, "Viendo", ANIME_ROUTE);
        }
    });

    fetch(COMICS_API[3].concat("/load/", user))
    .then((res) => res.json())
    .then((data) => {
        if (data.Completed.length > 0) {
            COMIC_OTHER_LIST_ELEMENTS.innerHTML += listsLoad("", data.Completed, "Completado", COMIC_ROUTE);
        }

        if (data.Discarded.length > 0) {
            COMIC_OTHER_LIST_ELEMENTS.innerHTML += listsLoad("", data.Discarded, "Descartado", COMIC_ROUTE);
        }

        if (data.Paused.length > 0) {
            COMIC_OTHER_LIST_ELEMENTS.innerHTML += listsLoad("", data.Paused, "Pausado", COMIC_ROUTE);
        }

        if (data.Watched.length > 0) {
            COMIC_OTHER_LIST_ELEMENTS.innerHTML += listsLoad("", data.Watched, "Por Ver", COMIC_ROUTE);
        }

        if (data.Watching.length > 0) {
            COMIC_OTHER_LIST_ELEMENTS.innerHTML += listsLoad("", data.Watching, "Viendo", COMIC_ROUTE);
        }
    });
}

// Se encarga de cargar los elementos para cada una de las listas del usuario 
function listsLoad(image_Route, list, name = "", route) {
    let elements = "";

    list.forEach((element) => {
        elements += cardInformationRetrieve(element, image_Route, route, true);
    });

    if (name == "") {
        return elements;
    }

    return `
        <div class="container mt-4">
            <div class="row">
                <h3 class="light-Color list-Title">${name}</h3>
            </div>
            <div class="row">
                <div class="elements-List">${elements}</div>
            </div>
        </div>
    `;
}

// Muestra u oculta contenido segun el tipo de elementos seleccionados (clase active)
function showHide(cont_1, cont_2, element) {
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
