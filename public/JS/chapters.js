// Obtiene elementos para su posterior modificacion
const ANIME_NAME = document.getElementById('anime-Name');
const BEFORE = document.getElementById('before');
const CHAPTER_CONTAINER = document.getElementById('chapter');
const CHAPTER_NUMBER = document.getElementById('chapter-Number');
const CHAPTERS_LIST = document.getElementById('chapters-List');
const COMMENTS_CONTAINER = document.getElementById('comments');
const DESCRIPTION = document.getElementById('anime-Description');
const EXTRA_INFO = document.getElementById('extra-Info');
const NEXT = document.getElementById('next');

// Variables a utilizar
let chapter = 1;

// Regresa a la pagina de informacion del anime
function anime_Info_Back() {
    window.location.href = ANIME_ROUTE.concat('/', anime_Id);
}

// Cambiar al capitulo anterior
function chapter_Before() {
    if (chapter > 1) {
        window.location.href = ROOT_ROUTE.concat(anime_Id, '/cap-', chapter - 1);    
    }
}

// Cambiar al episodio seleccionado
function chapter_Change(chapter_Number) {
    window.location.href = ROOT_ROUTE.concat(anime_Id, '/cap-', Number(chapter_Number));  
}

// Carga informacion de capitulo y video
function chapter_Load() {
    //  Consulta API para cargar nombre y numero de capitulo
    fetch(ANIMES_API[0].concat('/', anime_Id))
    .then((res) => res.json())
    .then((data) => {
        DESCRIPTION.innerHTML = `${data.description}`;
        EXTRA_INFO.innerHTML = `${data.type} <i class='bi bi-dot'></i> ${data.year} <i class='bi bi-dot'></i> ${data.season} <i class='bi bi-dot'></i> ${data.condition}`;
        ANIME_NAME.innerHTML = `${data.name}`;

        CHAPTER_NUMBER.innerHTML = `Episodio ${chapter}`;
        let chapters_Info = `<div class='chapter-Info mx-3 my-2'><h4>Estas Viendo</h4> <h5 class='fs-4'>Episodio ${chapter}</h5></div><div class='chapters-List mx-3 my-2'>`;

        for (let i = 1; i <= data.chapters; i++) {
            chapters_Info += `<button class='`;

            if (chapter == i) {
                chapters_Info += `actual `;
            }

            chapters_Info += `btn btn-secondary button-Chapter' onclick='chapter_Change(${i})'>${i}</button>`;
        }

        chapters_Info += '</div>';

        CHAPTERS_LIST.innerHTML = chapters_Info;
    });

    // Consulta API para cargar video
    fetch(ANIMES_API[0].concat('/', anime_Id, '/', chapter))
    .then((res) => res.json())
    .then((data) => {
        CHAPTER_CONTAINER.innerHTML = `<iframe allowfullscreen class='cap-Video' frameborder='0' 
        src='${data.link}'></iframe>`;
    });
}

// Cambiar al capitulo siguiente
function chapter_Next() {
    fetch(ANIMES_API[0].concat('/', anime_Id))
    .then((res) => res.json())
    .then((data) => {
        NumCaps = data.Capitulos;

        if (chapter < NumCaps) {
            window.location.href = ROOT_ROUTE.concat(anime_Id, '/cap-', Number(chapter) + 1);    
        }
    });
}
