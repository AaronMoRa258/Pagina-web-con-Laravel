// Carga video
export async function chapterLoad(animeId, apiRoute, chapterId) {  
    // Consulta API para cargar video
    const res = await fetch(`${apiRoute[0]}/${animeId}/${chapterId}`);
    const data = await res.json();

    return {
        items: data,
    };
}

// Regresa a la pagina de informacion del anime
export function animeInfoBack(animeId, ANIME_ROUTE) {
    window.location.href = ANIME_ROUTE.concat(animeId);
}

// Cambiar al capitulo anterior
export function chapterBefore(animeId, chapterId, ROUTE) {
    if (chapterId > 1) {
        window.location.href = ROUTE.concat(animeId, "/cap-", chapterId - 1);    
    }
}

// Cambiar al episodio seleccionado
export function chapterChange(animeId, chapterId, ROUTE) {
    window.location.href = ROUTE.concat(animeId, "/cap-", chapterId);  
}

// Cambiar al capitulo siguiente
export function chapterNext(animeId, chapterId, chaptersNumber, ROUTE) {
    if (chapterId < chaptersNumber) {
        window.location.href = ROUTE.concat(animeId, "/cap-", Number(chapterId) + 1);    
    }
}
