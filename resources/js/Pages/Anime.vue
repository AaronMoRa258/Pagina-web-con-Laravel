<template>
    <HeaderComponent />

    <section id="main">
        <ElementInfoComponent />
        <article class="mt-4 mx-4" id="chapters"></article>
    </section>

    <FooterComponent />
</template>

<script setup>

</script>

<script>
import ElementInfoComponent from '../Components/ElementInfoComponent.vue';
import FooterComponent from '../Components/FooterComponent.vue';
import HeaderComponent from '../Components/HeaderComponent.vue';
import { ANIME_IMAGE_ROUTE, ANIME_ROUTE, ANIMES_API } from '../../../public/JS/routes.js';
import { chaptersListLoad } from '../../../public/JS/anime';
import { bookmarkCheck, listCheck } from '../../../public/JS/extra_Actions';
import { elementInfoLoad } from '../../../public/JS/main';
import { usePage } from '@inertiajs/vue3';

const listsName = {
    Viendo: 'bi-eye',
    'Por Ver': 'bi-bookmark-plus',
    Completado: 'bi-check-circle',
    Pausado: 'bi-clock',
    Descartado: 'bi-dash-circle',
};

export default {
    components: {
        ElementInfoComponent,
        FooterComponent,
        HeaderComponent,
    },
    methods: {
        animeLoad() {
            elementInfoLoad(0, this.description, this.extraInfo, this.image, this.name, false, ANIME_IMAGE_ROUTE);
            chaptersListLoad(this.id, this.name, this.chaptersNumber, ANIME_ROUTE);
        },
        async infoLoad(checkElements, element) {
            const dataBookmark = await bookmarkCheck(element.elementId, element.user, element.api);
            const dataList = await listCheck(element.elementId, element.user, element.api);

            this.bookmarkCheck = checkElements.bookmarkCheck = dataBookmark.bookmarkCheck;
            this.listCheck = checkElements.listCheck = dataList.listCheck;

            element.text = this.listCheck.list;

            if (this.bookmarkCheck.user) {
                document.getElementById("bookmark-Icon").classList.toggle('bi-heart');
                document.getElementById("bookmark-Icon").classList.toggle('bi-heart-fill');
            }

            if (this.listCheck.user) {
                document.getElementById("main-List").innerHTML = `<i class="bi ${listsName[this.listCheck.list]} p-1"></i> ${this.listCheck.list}`;
            }
        },
    },
    props: {
        chaptersNumber: Number,
        description: String,
        extraInfo: String,
        id: Number,
        image: String,
        login: Boolean,
        name: String,
    },
    data() {
        return {
            bookmarkCheck: false,
            listCheck: false,
        };
    },
    mounted() {
        const auth = usePage().props.auth;
        const checkElement = usePage().props.checkElement;
        const element = usePage().props.element;

        element.api = ANIMES_API;
        element.elementId = this.id;
        element.user = auth.user.user;

        this.animeLoad();

        if (auth.user) {
            this.infoLoad(checkElement, element);
        }
    },
}
</script>

<style src="bootstrap/dist/css/bootstrap.css"></style>
<style src="bootstrap-icons/font/bootstrap-icons.css"></style>
<style src="../../css/anime.css"></style>
<style src="../../css/element_Info.css"></style>
<style src="../../css/extra_Actions.css"></style>
<style src="../../css/main.css"></style>
<style src="../../css/media_Anime.css"></style>
<style src="../../css/media_Element_Info.css"></style>
<style src="../../css/media_Extra_Actions.css"></style>
<style src="../../css/media_Main.css"></style>
