// Obtiene elementos para su posterior modificacion
const IMAGES = document.getElementById('images');

// Variables a utilizar
let comic_Id = 1;

// Carga lista de comics
function comic_Load(description, front_Page, extra_Info, name) {
    element_Main_Info_Load(description, extra_Info, front_Page, name);

    // Consulta API para obtener las imagenes del comic
    fetch(COMICS_API[0].concat('/', comic_Id))
    .then((res) => res.json())
    .then((data) => {
        IMAGES.innerHTML = '';
        let Images = '';

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

        
        data.forEach((image) => {
            Images += `<img src='${image.link}'>`;
        });

        IMAGES.innerHTML = Images;
    });

    BOOKMARK_ICON = document.getElementById('bookmark-Icon');
    MAIN_LIST = document.getElementById('main-List');
    
    bookmark_Check();
    list_Check();
}
