<div class='extra-Actions gap-2'>
    <div class='btn-group'>
        <button aria-expanded='false' class='btn btn-secondary dropdown-toggle-split' data-bs-toggle='dropdown' id='main-List' type='button'>
            <i class='bi bi-plus-circle p-1'></i> Agregar a lista
        </button>
        <button aria-expanded='false' class='btn btn-secondary dropdown-toggle dropdown-toggle-split' data-bs-toggle='dropdown' id='list-Dropdown' type='button'></button>
        <ul class='dropdown-menu lists p-1'>
            <li class='dropdown-item list-Element p-2' onclick='lists("bi-eye", "Viendo")'><i class='bi bi-eye pe-2'></i>Viendo</li>
            <li class='dropdown-item list-Element p-2' onclick='lists("bi-bookmark-plus", "Por Ver")'><i class='bi bi-bookmark-plus pe-2'></i>Por Ver</li>
            <li class='dropdown-item list-Element p-2' onclick='lists("bi-check-circle", "Completado")'><i class='bi bi-check-circle pe-2'></i>Completado</li>
            <li class='dropdown-item list-Element p-2' onclick='lists("bi-clock", "Pausado")'><i class='bi bi-clock pe-2'></i>Pausado</li>
            <li class='dropdown-item list-Element p-2' onclick='lists("bi-dash-circle", "Descartado")'><i class='bi bi-dash-circle pe-2'></i>Descartado</li>
        </ul>
    </div>
    <button class='btn btn-primary px-2' id='button-Bookmark' onclick='bookmarks()'>
        <i class='bi bi-heart' id='bookmark-Icon'></i>
    </button>
</div>