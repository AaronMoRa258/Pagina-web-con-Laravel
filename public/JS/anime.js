// Obtiene elementos para su posterior modificacion
const CHAPTERS = document.getElementById('chapters');
const ANIME_INFO = document.getElementById('anime-Info');

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
function anime_Load(api) {
    // Consulta API para obtener informacion del anime
    fetch(ANIMES_API[api].concat('/', anime_Id))
    .then((res) => res.json())
    .then((data) => {
        ANIME_INFO.innerHTML = '';
        CHAPTERS.innerHTML = '';

        ANIME_INFO.innerHTML += `<div class='container-fluid'>
            <div class='align-items-center gap-3 p-3 row'>
                <div class='anime-Image p-1'>
                    <img
                        alt='${data.name}'
                        class='card-img img-fluid'
                        src='${ANIME_IMAGE_ROUTE.concat('/', data.image)}'
                    />
                </div>
                <div class='information'>
                    <div class='card-body p-1'>
                        <h3 class='card-title' id='anime-Name'>${data.name}</h3>
                        <p class='card-text' id='anime-Description'>Sinopsis: ${data.description}</p>

                        <div>
                            <ul class='extra-Info gap-2'>
                                <li>${data.type}</li><i class='bi bi-dot'></i>
                                <li>${data.year}</li><i class='bi bi-dot'></i>
                                <li>${data.season}</li><i class='bi bi-dot'></i>
                                <li>${data.condition}</li>
                            </ul>
                        </div>

                        <div class='extra-Actions gap-2'>
                            <div class='btn-group'>
                                <button aria-expanded='false' class='btn btn-secondary dropdown-toggle-split list' data-bs-toggle='dropdown' id='main-List' type='button'>
                                    <i class='bi bi-plus-circle p-1'></i> Agregar a lista
                                </button>
                                <button aria-expanded='false' class='btn btn-secondary dropdown-toggle dropdown-toggle-split' data-bs-toggle='dropdown' id='list-Dropdown' type='button'></button>
                                <ul class='dropdown-menu lists p-1'>
                                    <li class='dropdown-item list-Element p-2' onclick='lists("bi-eye", "Viendo")'><i class='bi bi-eye pe-2'></i>Viendo</li>
                                    <li class='dropdown-item list-Element p-2' onclick='lists("bi-bookmark-plus", "Por Ver")'><i class='bi bi-bookmark-plus pe-2'></i>Por Ver</li>
                                    <li class='dropdown-item list-Element p-2' onclick='lists("bi-check-circle", "Completado")'><i class='bi bi-check-circle pe-2'></i>Completado</li>
                                    <li class='dropdown-item list-Element p-2' onclick='lists("bi-clock", "Pausado")'><i class='bi bi-clock pe-2'></i>Pausado</li>
                                    <li class='dropdown-item list-Element p-2' onclick='lists("bi-dash-circle", "Descartado")'><i class='bi bi-dash-circle pe-2'></i>Descartado</li>
                                </ul>
                            </div>
                            <button class='btn btn-primary px-2' id='button-Bookmark' onclick='bookmarks()'>
                                <i class='bi bi-heart' id='bookmark-Icon'></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class='anime-Background-Image'>
            </div>
        </div>`;

        let chapter_List = `<ul class='list-group'>
            <li class='card-Background light-Color list-group-item p-2'>Episodios del <b>1</b> al <b>${data.chapters}</b></li>`;
        for (let i = 1; i <= data.chapters; i++) {
            chapter_List += `<a href='${ROOT_ROUTE.concat(data.id, '/cap-', i)}'><li class='chapter-List list-group-item p-2'>${data.name} - ${i}</li></a>`;
        }

        chapter_List += `</ul>`;
        CHAPTERS.innerHTML = chapter_List;

        BOOKMARK_ICON = document.getElementById('bookmark-Icon');
        MAIN_LIST = document.getElementById('main-List');

        bookmark_Check();
        list_Check();
    });
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
