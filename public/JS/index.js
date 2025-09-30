// Variables a utilizar
let page = 1;

// Carga lista de elementos
function animes_Load() {
    // Consulta API para obtener los animes
    fetch(api_Route.concat('/', query, '?P=', page))
    .then((res) => res.json())
    .then((data) => {
        CONTAINER_ELEMENTS.innerHTML = '';
        before.disabled = page === 1;
        next.disabled = (data.length < 15) || (data.length == null);

        if (data.length === 0 && page > 1) {
            page--; // Si no hay más resultados, retrocede
            return;
        }

        if (data.message == 'No se encontraron resultados') {
            CONTAINER_ELEMENTS.setAttribute('style', 'grid-template-columns: 1fr !important');
            CONTAINER_ELEMENTS.innerHTML += `
            <article class='mt-2'>
                <div class='card card-Background p-2'>
                    <div class='card-body'>
                        <p class='fs-6 mt-2 mx-3 text-center' style='color: var(--light-color);'>${data.message}</p>
                    </div>
                </div>
              </article>
            `;
            return;
        }

        data.forEach((anime) => {
            CONTAINER_ELEMENTS.innerHTML += `
            <article class='mt-2'>
                <div class='card card-Background my-Card p-2 w-100' style='width: 18rem;'>
                    <a href='${ANIME_ROUTE.concat('/', anime.id)}'>
                        <div class='type-Image-Card'>
                            <div class='image-Card'>
                                <img alt='${anime.name}' class='card-img' src='${ANIME_IMAGE_ROUTE.concat('/', anime.image)}'>
                            </div>
                            <p class='type'>${anime.type}</p>
                        </div>
                        
                        <div class='card-body'>
                            <p class='fs-6 mt-2 mx-3 text-center'>${title_Len_Define(anime.name)}</p>
                        </div>
                    </a>
                </div>
              </article>
            `;
            });
    });
}

// Devuelve el titulo con maximo 2 lineas y 24 caracteres por linea
function title_Len_Define(title) {
    let Length = 0;
    let New = '';
    let Words = title.split(' ');

    Words.some(Word => {
        Length += Word.length + 1;

        if (Length <= 36) {
            New += Word + ' ';
        } else if (!New.includes('...')) {
            New += ' ...';
        }
    });

    return New;
}