// Obtiene elementos para su posterior modificacion
const CONTAINER_ELEMENTS = document.getElementById("container-Elements");
const ELEMENT_IMAGE = document.getElementById("element-Image");
const ELEMENT_NAME = document.getElementById("element-Name");
const ELEMENT_DESCRIPTION = document.getElementById("element-Description");
const EXTRA_INFO = document.getElementById("extra-Info");
const INPUT_SEARCH = document.getElementById("input-Search");
const USER_ICON = document.getElementById("user-Icon");
const USER_NAME = document.getElementById("user-Name");

// Variables a utilizar
let apiRoute = "";
let page = 1;
let query = "";
let type = "";

// Consulta api para recuperar elementos segun ruta especificada
function apiQuery(imageRoute, route) {
    fetch(apiRoute.concat("/", query, "?P=", page))
    .then((res) => res.json())
    .then((data) => {
        CONTAINER_ELEMENTS.innerHTML = "";
        before.disabled = page === 1;
        next.disabled = (data.length < 15) || (data.length == null);

        if (data.length === 0 && page > 1) {
            page--; // Si no hay más resultados, retrocede
            return;
        }

        if (data.message == "No se encontraron resultados") {
            CONTAINER_ELEMENTS.setAttribute("style", "grid-template-columns: 1fr !important");
            CONTAINER_ELEMENTS.innerHTML += `
            <article class="mt-2">
                <div class="card card-Background p-2">
                    <div class="card-body">
                        <p class="fs-6 mt-2 mx-3 text-center" style="color: var(--light-color);">${data.message}</p>
                    </div>
                </div>
              </article>
            `;
            return;
        }

        CONTAINER_ELEMENTS.innerHTML = cardsLoad(data, imageRoute, route);
    });
}

// Cambiar icono de usuario segun haya o no iniciado sesion
function authCheck() {
    USER_ICON.classList.add((login) ? "bi-person-fill" : "bi-person");
}

// Devuelve la informacion del elemento indicado con formato de tarjeta
function cardInformationRetrieve(element, imageRoute, route, scroll) {
    let extraClass = (scroll) ? "mx-2" : "w-100";

    return `<div class="card card-Background my-Card my-2 p-2 ${extraClass}" style="width: 18rem;">
                <a href="${route.concat("/", element.id)}">
                    <div class="type-Image-Card">
                        <div class="image-Card">
                            <img alt="${element.name}" class="card-img" src="${imageRoute!="" ? imageRoute.concat("/", element.image) : element.front_page}">
                        </div>
                        <p class="type">${element.type}</p>
                    </div>
                        
                    <div class="card-body">
                        <p class="fs-6 mt-2 mx-3 text-center">${titleLengthDefine(element.name)}</p>
                    </div>
                </a>
            </div>`;
}

// Devuelve tarjetas con la informacion de los elementos
function cardsLoad(data, imageRoute, route) {
    let container = "";
    let cardInformation = "";

    data.forEach((element) => {
        cardInformation = cardInformationRetrieve(element, imageRoute, route, false);
        container += `<article>${cardInformation}</article>`;
    });

    return container;
}

// Cargar informacion principal del elemento (nombre, descripcion, ...)
function elementInfoLoad(description, extraInfo, image, name) {
    if (image != "") {
        ELEMENT_IMAGE.innerHTML = ` <img alt="${name}" class="card-img img-fluid" src="${(image.includes("http") ? image : ANIME_IMAGE_ROUTE.concat("/", image))}"/>`;
    }
    
    ELEMENT_NAME.innerHTML = `${name}`;
    ELEMENT_DESCRIPTION.innerHTML = `Sinopsis: ${description}`;
    EXTRA_INFO.innerHTML = `${extraInfo}`;
}

// Cambiar a la pagina anterior
function pageBefore() {
    if (page <= 1) {
        return;
    }

    page--;

    switch (type) {
        case "comic":
            apiQuery("", COMIC_ROUTE, "Comic");
            break;
        default:
            apiQuery(ANIME_IMAGE_ROUTE, ANIME_ROUTE);
            break;
    }
}

// Cambiar a la pagina siguiente
function pageNext() {
    page++;
    
    switch (type) {
        case "comic":
            apiQuery("", COMIC_ROUTE, "Comic");
            break;
        default:
            apiQuery(ANIME_IMAGE_ROUTE, ANIME_ROUTE);
            break;
    }
}

// Realiza busqueda de cadena ingresada
function search() {
    if (INPUT_SEARCH.value != "") {
        switch(window.location.href) {
            case COMIC_ROUTE:
                window.location.href = `/comics/search/${INPUT_SEARCH.value}`;
                break;
            default: 
                window.location.href = `/animes/search/${INPUT_SEARCH.value}`;
                break;
        }
    }
}

// Cerrar sesion o mandar a formulario de login segun sea el caso
function signUpLogin(val) {
    let user = USER_NAME.innerHTML.trim();
    
    if (user != "Iniciar Sesión") {
        window.location.href = `/user/${user}`;
        return;
    }
    
    window.location.href = val;
}

// Devuelve el titulo con maximo 2 lineas y 24 caracteres por linea
function titleLengthDefine(title) {
    let length = 0;
    let newTitle = "";
    let words = title.split(" ");

    words.some(word => {
        length += word.length + 1;

        if (length <= 36) {
            newTitle += word + " ";
        } else if (!newTitle.includes("...")) {
            newTitle += " ...";
        }
    });

    return newTitle;
}

// Evento de teclado para mandar a llamar la funcion de busqueda
INPUT_SEARCH.addEventListener("keypress", (event) => {
    if (event.key == "Enter") {
        search();
    }
});
