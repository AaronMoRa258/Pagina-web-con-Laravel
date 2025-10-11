// Elimina elemento de la lista (favoritos / otra) del usuario
async function elementsRemoveAdd(action, api, apiVal, DATA) {
    try {
        const RESPONSE = await fetch(api[apiVal].concat(action), {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                Accept: 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}', // si usas rutas web
            },
            body: JSON.stringify(DATA),
        });

        const RESULT = await RESPONSE.json();
        console.log(RESULT);
    } catch (error) {
        console.error('Error:', error);
    }
}

// Revisa si el elemento seleccionado esta o no en la lista de favoritos del usuario actual
export async function bookmarkCheck(elementId, userId, APIS) {
    const res = await fetch(APIS[2].concat('/check/', userId, '/', elementId));
    const data = await res.json();

    return {bookmarkCheck: data};
}

// Agrega o elimina elemento en favoritos
export function bookmarks(checkElement, element) {
    if (!element.user) {
        window.location.href = `/login`;
        return;
    }

    const DATA = {
        user: element.user,
        elementId: element.elementId,
        list: element.text,
    };

    let api = element.api;

    document.getElementById("bookmark-Icon").classList.toggle('bi-heart');
    document.getElementById("bookmark-Icon").classList.toggle('bi-heart-fill');

    if (checkElement.user) {
        elementsRemoveAdd('/destroy', api, 2, DATA);
        checkElement.user = false;
    } else {
        elementsRemoveAdd('/store', api, 2, DATA);
        checkElement.user = true;
    }
}

// Revisa si el elemento seleccionado esta o no en la lista de favoritos del usuario actual
export async function listCheck(elementId, userId, APIS) {
    const res = await fetch(APIS[3].concat('/check/', userId, '/', elementId));
    const data = await res.json();
    
    return {listCheck: data};
}

// Agrega o elimina elemento de lista seleccionada
export function lists(checkElement, element, icon, text) {
    if (!element.user) {
        window.location.href = `/login`;
        return;
    }

    const DATA = {
        user: element.user,
        elementId: element.elementId,
        list: text,
    };

    let api = element.api;

    let newList = `<i class="bi ${icon} p-1"></i> ${text}`;
    let removeList = "<i class='bi bi-plus-circle p-1'></i> Agregar a lista";

    if (document.getElementById("main-List").innerHTML == newList) {
        document.getElementById("main-List").innerHTML = removeList;
        checkElement.user = false;
        elementsRemoveAdd('/destroy', api, 3, DATA);
        return;
    }

    if (checkElement.user) {
        elementsRemoveAdd('/destroy', api, 3, DATA);
    }

    document.getElementById("main-List").innerHTML = newList;
    checkElement.user = true;
    elementsRemoveAdd('/store', api, 3, DATA);
}
