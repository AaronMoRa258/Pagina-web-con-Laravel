// Obtiene elementos para su posterior modificacion
const CHAPTERS = document.getElementById('chapters');

const ANIME_IMAGE = document.getElementById('anime-Image');
const ANIME_NAME = document.getElementById('anime-Name');
const DESCRIPTION = document.getElementById('anime-Description');
const EXTRA_INFO = document.getElementById('extra-Info');

// Variables a utilizar
let bookmark_State = false;
let anime_Id = 1;
let list_State = false;
let lists_Name = {
    'Viendo': 'bi-eye',
    'Por Ver': 'bi-bookmark-plus',
    'Completado': 'bi-check-circle',
    'Pausado': 'bi-clock',
    'Descartado': 'bi-dash-circle'
}
let new_List = ``;
let remove_List = '<i class="bi bi-plus-circle p-1"></i> Agregar a lista';

// Agrega anime a lista (favoritos / otra) del usuario
async function add(api, text) {
    const DATA = {
        User: USER_NAME.getHTML().trim(),
        Id_Anime: anime_Id,
        List: text
    };

    try{
        const RESPONSE = await fetch(APIs[api].concat('/add'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // si usas rutas web
            },
            body: JSON.stringify(DATA)
        });

        const RESULT = await RESPONSE.json();
        console.log(RESULT);
    } catch (error) {
        console.error('Error:', error);
    }
}

// Elimina anime de la lista (favoritos / otra) del usuario
async function remove(api) {
    const DATA = {
        User: USER_NAME.getHTML().trim(),
        Id_Anime: anime_Id
    };

    try{
        const RESPONSE = await fetch(APIs[api].concat('/remove'), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // si usas rutas web
            },
            body: JSON.stringify(DATA)
        });

        const RESULT = await RESPONSE.json();
        console.log(RESULT);
    } catch (error) {
        console.error('Error:', error);
    }
}

// Carga informacion del anime
function anime_Load(chapters, description, extra_Info, image, name) {
    ANIME_IMAGE.innerHTML = ` <img alt='${name}' class='card-img img-fluid' src='${ANIME_IMAGE_ROUTE.concat('/', image)}'/>`;
    ANIME_NAME.innerHTML = `${name}`;
    DESCRIPTION.innerHTML = `Sinopsis: ${description}`;
    EXTRA_INFO.innerHTML = `${extra_Info}`;

    let chapter_List = `<ul class='list-group'>
        <li class='card-Background light-Color list-group-item p-2'>Episodios del <b>1</b> al <b>${chapters}</b></li>`;
    for (let i = 1; i <= chapters; i++) {
        chapter_List += `<a href='${ROOT_ROUTE.concat(anime_Id, '/cap-', i)}'><li class='chapter-List list-group-item p-2'>${name} - ${i}</li></a>`;
    }

    chapter_List += `</ul>`;
    CHAPTERS.innerHTML = chapter_List;

    BOOKMARK_ICON = document.getElementById('bookmark-Icon');
    MAIN_LIST = document.getElementById('main-List');

    bookmark_Check();
    list_Check();
}

// Revisa si el anime seleccionado esta o no en la lista de favoritos del usuario actual
function bookmark_Check() {
    if (login) {
        fetch(ANIMES_API[2].concat('/check/', USER_NAME.getHTML().trim(), '/', anime_Id))
        .then((res) => res.json())
        .then((data) => {
            if (data.user) {
                bookmark_State = true;
                BOOKMARK_ICON.classList.toggle('bi-heart');
                BOOKMARK_ICON.classList.toggle('bi-heart-fill');
            }
        });
    }
}

// Agrega o elimina anime en favoritos
function bookmarks() {
    if (!login) {
        window.location.href = `/Login`;
        return;
    }

    BOOKMARK_ICON.classList.toggle('bi-heart');
    BOOKMARK_ICON.classList.toggle('bi-heart-fill');

    if (bookmark_State) {
        remove(2);
        bookmark_State = false;
    } else {
        add(2, '');
        bookmark_State = true;
    }
}

// Revisa si el anime seleccionado esta o no en la lista de favoritos del usuario actual
function list_Check() {
    if (login) {
        fetch(ANIMES_API[3].concat('/check/', USER_NAME.getHTML().trim(), '/', anime_Id))
        .then((res) => res.json())
        .then((data) => {
            if (data.user) {
                list_State = true;
                MAIN_LIST.innerHTML = `<i class='bi ${lists_Name[data.list]} p-1'></i> ${data.list}`;
            }
        });
    }
}

// Agrega o elimina anime de lista seleccionada
function lists(icon, text) {
    if (!login) {
        window.location.href = `/Login`;
        return;
    }

    new_List = `<i class='bi ${icon} p-1'></i> ${text}`;

    if (MAIN_LIST.innerHTML == new_List) {
        MAIN_LIST.innerHTML = remove_List;
        list_State = false;
        remove(3);
        return;
    }

    if (list_State) {
        remove(3);
    }
                
    MAIN_LIST.innerHTML = new_List;
    list_State = true;
    add(3, text);
}
