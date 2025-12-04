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
                    <button aria-expanded='false' class="btn btn-secondary dropdown-toggle-split user-Name"
                        data-bs-toggle='dropdown' id="user-Name" type='button' v-if="auth.user">
                        <i class="bi bi-person-fill" id="user-Icon"></i> {{ auth.user.user }}
                    </button>
                    <button class="btn btn-secondary user-Name" id="user-Name" @click="signUpLogin()" type='button'
                        v-else>
                        <i class="bi bi-person" id="user-Icon"></i> Iniciar Sesión
                    </button>
                    <ul class='dropdown-menu header-Lists p-1'>
                        <li class='dropdown-item header-List-Element p-2' @click='profileShow(auth.user.user)'><i
                                class='bi bi-person-circle pe-2'></i>Perfil</li>
                        <li class='dropdown-item header-List-Element p-2' @click='logout'><i
                                class='bi bi-person-fill-x pe-2'></i>Cerrar Sesion</li>
                    </ul>
                </div>
            </div>
        </div>
    </header>
</template>
<script setup>
import { profileShow, search, signUpLogin } from '../../../public/JS/main';
import { router } from '@inertiajs/vue3'

import { usePage } from '@inertiajs/vue3'

const auth = usePage().props.auth

const logout = () => {
    router.post(route('logout'), {}, {
        onSuccess: () => router.visit('/') // Fuerza recarga a la raíz
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
    },
    mounted() {
        // Evento de teclado para mandar a llamar la funcion de busqueda
        document.getElementById('input-Search').addEventListener("keypress", (event) => {
            if (event.key == "Enter") {
                search();
            }
        });
    },
}
</script>