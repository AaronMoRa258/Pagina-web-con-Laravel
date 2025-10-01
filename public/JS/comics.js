// Obtiene elementos para su posterior modificacion
const IMAGES = document.getElementById('images');

// Variables a utilizar
let comic_Id = 1;

// Carga lista de comics
function comic_Load(api) {
    // Consulta API para obtener los comics
    fetch(COMICS_API[api].concat('/', comic_Id))
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
}
