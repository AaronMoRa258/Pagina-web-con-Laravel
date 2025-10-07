// Obtiene elementos para su posterior modificacion
const IMAGES = document.getElementById("images");

// Variables a utilizar
let comicId = 1;

// Carga lista de comics
function comicLoad(description, extraInfo, frontPage, name) {
    elementInfoLoad(description, extraInfo, frontPage, name);

    // Consulta API para obtener las imagenes del comic
    fetch(COMICS_API[0].concat("/", comicId))
    .then((res) => res.json())
    .then((data) => {
        IMAGES.innerHTML = "";
        let images = "";

        if (data.message == "No se encontraron resultados") {
            CONTAINER_ELEMENTS.setAttribute("style", "grid-template-columns: 1fr !important");
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

        
        data.forEach((image) => {
            images += `<img src="${image.link}">`;
        });

        IMAGES.innerHTML = images;
    });

    BOOKMARK_ICON = document.getElementById("bookmark-Icon");
    MAIN_LIST = document.getElementById("main-List");
    
    bookmarkCheck();
    listCheck();
}
