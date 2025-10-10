<template>
    <header>
        <div class="container-fluid m-1">
            <div class="align-items-center header-Elements-Container justify-content-between row">
                <a class="page-Image" :href="`${rootRoute}`">
                    <img alt="Logo" class="rounded-circle" id="logo" src="/IMG/Logo.jpeg" />
                </a>
                <h1 class="light-Color page-Name">Pagina Web Hecha Con Laravel</h1>
                <div class="search">
                    <input class="form-control p-1" id="input-Search" placeholder="Buscar" type="text">
                    <button class="btn btn-secondary" id="button-Search" @click="search()" type="button"><i
                            class="bi bi-search"></i></button>
                </div>
                <div class="user">
                    <button aria-expanded='false'
                        class="btn btn-secondary dropdown-toggle-split user-Name"
                        data-bs-toggle='dropdown' id="user-Name" @click="signUpLogin()" type='button'>
                        <i class="bi user-Icon" id="user-Icon"></i>
                    </button>
                    <ul class='dropdown-menu lists p-1'>
                        <li class='dropdown-item list-Element p-2' onclick=''><i class='bi bi-eye pe-2'></i>Perfil</li>
                        <li class='dropdown-item list-Element p-2' @click='logout'><i
                                class='bi bi-bookmark-plus pe-2'></i>Cerrar Sesion</li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</template>
<script setup>
import { search, signUpLogin } from '../../../public/JS/main';
import { router } from '@inertiajs/vue3'

const logout = () => {
  router.post('/logout', {}, {
    onFinish: () => {
      router.visit('/');
    },
  })
}
</script>

<script>
import { ROOT_ROUTE } from '../../../public/JS/routes.js';

export default {
    computed: {
        rootRoute() {
            return ROOT_ROUTE;
        }
    }
}
</script>