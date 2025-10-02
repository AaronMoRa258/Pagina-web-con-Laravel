// Obtiene elementos para su posterior modificacion
const CHAPTERS = document.getElementById('chapters');

// Variables a utilizar
let anime_Id = 1;

// Carga informacion del anime
function anime_Load(chapters, description, extra_Info, image, name) {
    element_Main_Info_Load(description, extra_Info, image, name);

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

