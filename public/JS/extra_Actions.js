// Variables a utilizar
let api = '';
let bookmark_State = false;
let element_Id = 0;
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

// Elimina elemento de la lista (favoritos / otra) del usuario
async function elements_Remove_Add(action, api_Val, DATA) {
    try{
        const RESPONSE = await fetch(api[api_Val].concat(action), {
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

// Revisa si el elemento seleccionado esta o no en la lista de favoritos del usuario actual
function bookmark_Check() {
    if (login) {
        fetch(api[2].concat('/check/', USER_NAME.getHTML().trim(), '/', element_Id))
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

// Agrega o elimina elemento en favoritos
function bookmarks(text = '') {
    if (!login) {
        window.location.href = `/login`;
        return;
    }

    const DATA = {
        user: USER_NAME.getHTML().trim(),
        element_Id: element_Id,
        list: text
    };

    BOOKMARK_ICON.classList.toggle('bi-heart');
    BOOKMARK_ICON.classList.toggle('bi-heart-fill');

    if (bookmark_State) {
        elements_Remove_Add('/remove', 2, DATA);
        bookmark_State = false;
    } else {
        elements_Remove_Add('/add', 2, DATA);
        bookmark_State = true;
    }
}

// Revisa si el elemento seleccionado esta o no en la lista de favoritos del usuario actual
function list_Check() {
    if (login) {
        fetch(api[3].concat('/check/', USER_NAME.getHTML().trim(), '/', element_Id))
        .then((res) => res.json())
        .then((data) => {
            if (data.user) {
                list_State = true;
                MAIN_LIST.innerHTML = `<i class='bi ${lists_Name[data.list]} p-1'></i> ${data.list}`;
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
        element_Id: element_Id,
        list: text
    };

    new_List = `<i class="bi ${icon} p-1"></i> ${text}`;

    if (MAIN_LIST.innerHTML == new_List) {
        MAIN_LIST.innerHTML = remove_List;
        list_State = false;
        elements_Remove_Add('/remove', 3, DATA);
        return;
    }

    if (list_State) {
        elements_Remove_Add('/remove', 3, DATA);
    }
                
    MAIN_LIST.innerHTML = new_List;
    list_State = true;
    elements_Remove_Add('/add', 3, DATA);
}
