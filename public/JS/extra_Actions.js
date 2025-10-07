// Variables a utilizar
let api = "";
let bookmarkState = false;
let elementId = 0;
let listState = false;
let listsName = {
    "Viendo": "bi-eye",
    "Por Ver": "bi-bookmark-plus",
    "Completado": "bi-check-circle",
    "Pausado": "bi-clock",
    "Descartado": "bi-dash-circle"
}
let newList = ``;
let removeList = "<i class='bi bi-plus-circle p-1'></i> Agregar a lista";

// Elimina elemento de la lista (favoritos / otra) del usuario
async function elementsRemoveAdd(action, apiVal, DATA) {
    try{
        const RESPONSE = await fetch(api[apiVal].concat(action), {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "Accept": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}" // si usas rutas web
            },
            body: JSON.stringify(DATA)
        });

        const RESULT = await RESPONSE.json();
        console.log(RESULT);
    } catch (error) {
        console.error("Error:", error);
    }
}

// Revisa si el elemento seleccionado esta o no en la lista de favoritos del usuario actual
function bookmarkCheck() {
    if (login) {
        fetch(api[2].concat("/check/", USER_NAME.getHTML().trim(), "/", elementId))
        .then((res) => res.json())
        .then((data) => {
            if (data.user) {
                bookmarkState = true;
                BOOKMARK_ICON.classList.toggle("bi-heart");
                BOOKMARK_ICON.classList.toggle("bi-heart-fill");
            }
        });
    }
}

// Agrega o elimina elemento en favoritos
function bookmarks(text = "") {
    if (!login) {
        window.location.href = `/login`;
        return;
    }

    const DATA = {
        user: USER_NAME.getHTML().trim(),
        elementId: elementId,
        list: text
    };

    BOOKMARK_ICON.classList.toggle("bi-heart");
    BOOKMARK_ICON.classList.toggle("bi-heart-fill");

    if (bookmarkState) {
        elementsRemoveAdd("/destroy", 2, DATA);
        bookmarkState = false;
    } else {
        elementsRemoveAdd("/store", 2, DATA);
        bookmarkState = true;
    }
}

// Revisa si el elemento seleccionado esta o no en la lista de favoritos del usuario actual
function listCheck() {
    if (login) {
        fetch(api[3].concat("/check/", USER_NAME.getHTML().trim(), "/", elementId))
        .then((res) => res.json())
        .then((data) => {
            if (data.user) {
                listState = true;
                MAIN_LIST.innerHTML = `<i class="bi ${listsName[data.list]} p-1"></i> ${data.list}`;
            }
        });
    }
}

// Agrega o elimina elemento de lista seleccionada
function lists(icon, text) {
    if (!login) {
        window.location.href = `/login`;
        return;
    }

    const DATA = {
        user: USER_NAME.getHTML().trim(),
        elementId: elementId,
        list: text
    };

    newList = `<i class="bi ${icon} p-1"></i> ${text}`;

    if (MAIN_LIST.innerHTML == newList) {
        MAIN_LIST.innerHTML = removeList;
        listState = false;
        elementsRemoveAdd("/destroy", 3, DATA);
        return;
    }

    if (listState) {
        elementsRemoveAdd("/destroy", 3, DATA);
    }
                
    MAIN_LIST.innerHTML = newList;
    listState = true;
    elementsRemoveAdd("/store", 3, DATA);
}
