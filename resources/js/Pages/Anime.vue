<template>
    <HeaderComponent />

    <section id="main">
        <ElementInfoComponent />
        <article class="mt-4 mx-4" id="chapters"></article>
    </section>

    <FooterComponent />
</template>

<script>
import ElementInfoComponent from '../Components/ElementInfoComponent.vue';
import FooterComponent from '../Components/FooterComponent.vue';
import HeaderComponent from '../Components/HeaderComponent.vue';
import { ANIME_IMAGE_ROUTE, ANIME_ROUTE } from '../../../public/JS/routes.js';
import { chaptersListLoad } from '../../../public/JS/anime';
import { authCheck, elementInfoLoad } from '../../../public/JS/main';

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
        }
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
    mounted() {
        authCheck(this.login);
        this.animeLoad();
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
