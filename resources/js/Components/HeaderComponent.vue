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
                    <h5 class="user-Name" id="user-Name" onclick="">
                        Iniciar Sesión
                    </h5>
                    <i class="bi user-Icon" id="user-Icon" onclick=""></i>
                </div>
            </div>
        </div>
    </header>
</template>
<script setup>
import { search } from '../../../public/JS/main';
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