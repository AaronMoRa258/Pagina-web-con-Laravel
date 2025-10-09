<template>
    <nav class="navbar navbar-dark navbar-expand-lg">
        <div class="container-fluid px-4">
            <a class="my-2 navbar-brand px-1 py-1" :href="`${rootRoute}`">Animes</a>
            <a class="my-2 navbar-brand px-1 py-1" :href="`${comicRoute}`">Comics</a>
            <a class="my-2 navbar-brand px-1 py-1" href="">Historias</a>
        </div>
    </nav>
</template>

<script>
import { COMIC_ROUTE, ROOT_ROUTE } from '../../../public/JS/routes.js';

export default {
    computed: {
        comicRoute() {
            return COMIC_ROUTE;
        },
        rootRoute() {
            return ROOT_ROUTE;
        }
    }
}
</script>