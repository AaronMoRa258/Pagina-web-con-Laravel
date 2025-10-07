// Obtiene elementos para su posterior modificacion
const ANIME_NAME = document.getElementById("anime-Name");
const BEFORE = document.getElementById("before");
const CHAPTER_CONTAINER = document.getElementById("chapter");
const CHAPTER_NUMBER = document.getElementById("chapter-Number");
const CHAPTERS_LIST = document.getElementById("chapters-List");
const COMMENTS_CONTAINER = document.getElementById("comments");
const DESCRIPTION = document.getElementById("anime-Description");
const NEXT = document.getElementById("next");

// Variables a utilizar
let chapter = 1;

// Regresa a la pagina de informacion del anime
function animeInfoBack() {
    window.location.href = ANIME_ROUTE.concat("/", animeId);
}

// Cambiar al capitulo anterior
function chapterBefore() {
    if (chapter > 1) {
        window.location.href = ROOT_ROUTE.concat(animeId, "/cap-", chapter - 1);    
    }
}

// Cambiar al episodio seleccionado
function chapterChange(chapter) {
    window.location.href = ROOT_ROUTE.concat(animeId, "/cap-", Number(chapter));  
}

// Carga informacion de capitulo y video
function chapterLoad(description, extra_Info, name, chaptersNumber) {
    elementInfoLoad(description, extra_Info, "", name);

    CHAPTER_NUMBER.innerHTML = `Episodio ${chapter}`;
    let chaptersInfo = `<div class="chapter-Info mx-3 my-2"><h4>Estas Viendo</h4> <h5 class="fs-4">Episodio ${chapter}</h5></div><div class="chapters-List mx-3 my-2">`;

    for (let i = 1; i <= chaptersNumber; i++) {
        chaptersInfo += `<button class="`;

        if (chapter == i) {
            chaptersInfo += `actual `;
        }

        chaptersInfo += `btn btn-secondary button-Chapter" onclick="chapterChange(${i})">${i}</button>`;
    }

    chaptersInfo += "</div>";
    CHAPTERS_LIST.innerHTML = chaptersInfo;

    // Consulta API para cargar video
    fetch(ANIMES_API[0].concat("/", animeId, "/", chapter))
    .then((res) => res.json())
    .then((data) => {
        CHAPTER_CONTAINER.innerHTML = `<iframe allowfullscreen class="cap-Video" frameborder="0" 
        src="${data.link}"></iframe>`;
    });
}

// Cambiar al capitulo siguiente
function chapterNext() {
    fetch(ANIMES_API[0].concat("/", animeId))
    .then((res) => res.json())
    .then((data) => {
        let chaptersNumber = data.numberChapters;

        if (chapter < chaptersNumber) {
            window.location.href = ROOT_ROUTE.concat(animeId, "/cap-", Number(chapter) + 1);    
        }
    });
}
