// Obtiene elementos para su posterior modificacion
const USER_NAME = document.getElementById('user-Name');

// Variables a utilizar
let page = 1;
let type = '';

// Consulta api para recuperar elementos segun ruta especificada
export async function apiQuery(apiRoute, index, page, query) {
    const res = await fetch(`${apiRoute[index]}/${query}?P=${page}`);
    const data = await res.json();
    const noMore = !data || data.length < 15;

    data.forEach((element) => {
        element.newName = titleLengthDefine(element.name);
    });

    return {
        items: data,
        hasMore: !noMore,
    };
}

// Cambiar icono de usuario segun haya o no iniciado sesion
export function authCheck(login) {
    document
        .getElementById('user-Icon')
        .classList.add(login ? 'bi-person-fill' : 'bi-person');
}

// Cargar informacion principal del elemento (nombre, descripcion, ...)
export function elementInfoLoad(
    chapterId,
    description,
    extraInfo,
    image,
    name,
    isChapter,
    IMAGE_ROUTE,
) {
    if (isChapter) {
        document.getElementById('chapter-Number').innerHTML =
            `Episodio ${chapterId}`;
    } else if (image != '') {
        document.getElementById('element-Image').innerHTML =
            ` <img alt="${name}" class="card-img img-fluid" src="${image.includes('http') ? image : '/'.concat(IMAGE_ROUTE, '/', image)}"/>`;
    }

    document.getElementById('element-Name').innerHTML = `${name}`;
    document.getElementById('element-Description').innerHTML =
        `Sinopsis: ${description}`;
    document.getElementById('extra-Info').innerHTML = `${extraInfo}`;
}

// Realiza busqueda de cadena ingresada
export function search(COMIC_ROUTE) {
    const INPUT_SEARCH = document.getElementById('input-Search');

    if (INPUT_SEARCH.value != '') {
        if (window.location.href.includes('comic')) {
            window.location.href = `/comics/search/${INPUT_SEARCH.value}`;
        } else {
            window.location.href = `/animes/search/${INPUT_SEARCH.value}`;
        }
    }
}

// Devuelve el titulo con maximo 2 lineas y 24 caracteres por linea
function titleLengthDefine(title) {
    let length = 0;
    let newTitle = '';
    let words = title.split(' ');

    words.some((word) => {
        length += word.length + 1;

        if (length <= 36) {
            newTitle += word + ' ';
        } else if (!newTitle.includes('...')) {
            newTitle += ' ...';
        }
    });

    return newTitle;
}

// Evento de teclado para mandar a llamar la funcion de busqueda
/* INPUT_SEARCH.addEventListener("keypress", (event) => {
    if (event.key == "Enter") {
        search();
    }
});
 */

// Devuelve la informacion del elemento indicado con formato de tarjeta
function cardInformationRetrieve(element, imageRoute, route, scroll) {
    let extraClass = scroll ? 'mx-2' : 'w-100';

    return `<div class="card card-Background my-Card my-2 p-2 ${extraClass}" style="width: 18rem;">
                <a href="${route.concat('/', element.id)}">
                    <div class="type-Image-Card">
                        <div class="image-Card">
                            <img alt="${element.name}" class="card-img" src="${imageRoute != '' ? imageRoute.concat('/', element.image) : element.front_page}">
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
    let container = '';
    let cardInformation = '';

    data.forEach((element) => {
        cardInformation = cardInformationRetrieve(
            element,
            imageRoute,
            route,
            false,
        );
        container += `<article>${cardInformation}</article>`;
    });

    return container;
}

// Cambiar a la pagina anterior
function pageBefore() {
    if (page <= 1) {
        return;
    }

    page--;

    switch (type) {
        case 'comic':
            apiQuery('', COMIC_ROUTE, 'Comic');
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
        case 'comic':
            apiQuery('', COMIC_ROUTE, 'Comic');
            break;
        default:
            apiQuery(ANIME_IMAGE_ROUTE, ANIME_ROUTE);
            break;
    }
}

// Cerrar sesion o mandar a formulario de login segun sea el caso
function signUpLogin(val) {
    let user = USER_NAME.innerHTML.trim();

    if (user != 'Iniciar Sesión') {
        window.location.href = `/user/${user}`;
        return;
    }

    window.location.href = val;
}
