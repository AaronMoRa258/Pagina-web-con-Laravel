// Obtiene elementos para su posterior modificacion
const CHAPTERS = document.getElementById("chapters");

// Variables a utilizar
let animeId = 1;

// Carga informacion del anime
function animeLoad(description, extraInfo, image, name, chaptersNumber) {
    elementInfoLoad(description, extraInfo, image, name);

    let chapterList = `<ul class="list-group">
        <li class="card-Background light-Color list-group-item p-2">Episodios del <b>1</b> al <b>${chaptersNumber}</b></li>`;
    
        for (let i = 1; i <= chaptersNumber; i++) {
        chapterList += `<a href="${ROOT_ROUTE.concat(animeId, "/cap-", i)}"><li class="chapter-List list-group-item p-2">${name} - ${i}</li></a>`;
    }

    chapterList += `</ul>`;
    CHAPTERS.innerHTML = chapterList;

    BOOKMARK_ICON = document.getElementById("bookmark-Icon");
    MAIN_LIST = document.getElementById("main-List");

    bookmarkCheck();
    listCheck();
}

