// Carga lista de comics
export async function comicLoad(comicId, COMICS_API) {
    // Consulta API para obtener las imagenes del comic
    const res = await fetch(`${COMICS_API[0]}/${comicId}`);
    const data = await res.json();

    return {
        items: data,
    };
}