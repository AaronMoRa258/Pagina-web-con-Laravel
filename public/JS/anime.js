// Carga informacion del anime
export function chaptersListLoad(animeId, name, chaptersNumber, ROUTE) {
    let chapterList = `<ul class="list-group">
        <li class="card-Background light-Color list-group-item p-2">Episodios del <b>1</b> al <b>${chaptersNumber}</b></li>`;
    
        for (let i = 1; i <= chaptersNumber; i++) {
        chapterList += `<a href="${ROUTE.concat(animeId, "/cap-", i)}"><li class="chapter-List list-group-item p-2">${name} - ${i}</li></a>`;
    }

    chapterList += `</ul>`;
    document.getElementById("chapters").innerHTML = chapterList;
}

