// Carga lista de comics
export async function comicLoad(comicId, COMICS_API) {
    // Consulta API para obtener las imagenes del comic
    const res = await fetch(`${COMICS_API[0]}/${comicId}`);
    const data = await res.json();

    return {
        items: data,
    };
}



/* if (data.message == 'No se encontraron resultados') {
    CONTAINER_ELEMENTS.setAttribute(
        'style',
        'grid-template-columns: 1fr !important',
    );
    CONTAINER_ELEMENTS.innerHTML += `
            <article class="mt-2">
                <div class="card card-Background p-2">
                    <div class="card-body">
                        <p class="fs-6 mt-2 mx-3 text-center" style="color: var(--light-color);">${data.message}</p>
                    </div>
                </div>
              </article>
            `;
    return;
}
 */