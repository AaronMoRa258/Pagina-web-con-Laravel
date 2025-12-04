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

// Cerrar sesion o mandar a formulario de login segun sea el caso
export function profileShow(idUser) {
    window.location.href = `/profile/${idUser}`;
    return;
}

// Realiza busqueda de cadena ingresada
export function search() {
    const INPUT_SEARCH = document.getElementById('input-Search');

    if (INPUT_SEARCH.value != '') {
        if (window.location.href.includes('comic')) {
            window.location.href = `/comics/search/${INPUT_SEARCH.value}`;
        } else {
            window.location.href = `/animes/search/${INPUT_SEARCH.value}`;
        }
    }
}

// Cerrar sesion o mandar a formulario de login segun sea el caso
export function signUpLogin() {
    window.location.href = `/login`;
    return;
}

// Devuelve el titulo con maximo 2 lineas y 24 caracteres por linea
export function titleLengthDefine(title) {
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
