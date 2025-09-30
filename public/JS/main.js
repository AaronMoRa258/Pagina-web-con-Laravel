// Obtiene elementos para su posterior modificacion
const CONTAINER_ELEMENTS = document.getElementById('container-Elements');
const INPUT_SEARCH = document.getElementById('input-Search');
const USER_ICON = document.getElementById('user-Icon');
const USER_NAME = document.getElementById('user-Name');

// Variables a utilizar
let api = 0;
let api_Route = '';
let query = '';
let type = '';

// Cambiar icono de usuario segun este o no logeado
function auth_Check() {
    let new_Class = (login) ? 'bi-person-fill' : 'bi-person';

    USER_ICON.classList.add(new_Class);
}

// Cambiar a la pagina anterior
function page_Before() {
    if (page <= 1) {
        return;
    }

    page--;

    switch (type) {
        case 'comic':
            comics_Load(api_Route);
            break;
        default:
            animes_Load(api_Route);
            break;
    }
}

// Cambiar a la pagina siguiente
function page_Next() {
    page++;
    
    switch (type) {
        case 'comic':
            comics_Load(api_Route);
            break;
        default:
            animes_Load(api_Route);
            break;
    }
}

// Realiza busqueda de cadena ingresada
function search() {
    if (INPUT_SEARCH.value != '') {
        console.log(window.location.href == ROOT_ROUTE);
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
function sign_Up_Login(val) {
    let user = USER_NAME.innerHTML.trim();
    
    if (user != 'Iniciar Sesión') {
        window.location.href = `/user/${user}`;
        return;
    }
    
    window.location.href = val;
}

// Evento de teclado para mandar a llamar la funcion de busqueda
INPUT_SEARCH.addEventListener('keypress', (event) => {
    if (event.key == 'Enter') {
        search();
    }
});
