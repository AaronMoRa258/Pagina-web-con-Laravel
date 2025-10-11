<template>
    <HeaderComponent />

    <section class="mx-4" id="main">
        <article class="justify-content-center mt-4" id="chapter-Changer">
            <button class="btn btn-secondary col-1 p-2 rounded-end-0 rounded-start-5" id="before"
                @click="chapterBefore(id, chapterId, ANIME_ROUTE)" type="button"><i
                    class="bi bi-caret-left-fill"></i></button>
            <button class="btn btn-secondary col-9 p-2 rounded-0" id="anime-Info-Back"
                @click="animeInfoBack(id, ANIME_ROUTE)" type="button">Episodios</button>
            <button class="btn btn-secondary col-1 p-2 rounded-end-5 rounded-start-0" id="next"
                @click="chapterNext(id, chapterId, chaptersNumber, ANIME_ROUTE)" type="button"><i
                    class="bi bi-caret-right-fill"></i></button>
        </article>
        <article class="card-Background card content mt-2" id="chapter"></article>
    </section>

    <section class="mx-4" id="secondary">
        <article class="card-body anime-Info mt-4 px-2 py-1">
            <h3 class="mx-2 my-1 px-1" id="element-Name"></h3>
            <p class="mx-2 my-1 px-1" id="chapter-Number"></p>
            <ul class="extra-Info mx-2 my-1 px-1" id="extra-Info"></ul>
            <p class="mx-2 my-1 px-1" id="element-Description"></p>
        </article>
        <article class="comments" id="comments"></article>
    </section>

    <aside class="me-4 mt-4" id="chapters-List">
        <div class="chapter-Info mx-3 my-2">
            <h4>Estas Viendo</h4>
            <h5 class="fs-4">Episodio {{ chapterId }}</h5>
        </div>
        <div class="chapters-List mx-3 my-2">
            <button v-for="chapter in chaptersNumber" :key="chapter" 
                class="btn btn-secondary button-Chapter"
                :class="{
                    'actual': chapter == chapterId
                }"
                @click="chapterChange(id, chapter, ANIME_ROUTE)">{{ chapter }}
            </button>
        </div>
    </aside>

    <FooterComponent />
</template>

<script setup>
import { animeInfoBack, chapterBefore, chapterChange, chapterNext } from '../../../public/JS/chapters';
</script>

<script>
import ElementInfoComponent from '../Components/ElementInfoComponent.vue';
import FooterComponent from '../Components/FooterComponent.vue';
import HeaderComponent from '../Components/HeaderComponent.vue';
import { chapterLoad } from '../../../public/JS/chapters';
import { elementInfoLoad } from '../../../public/JS/main';
import { ANIME_IMAGE_ROUTE, ANIME_ROUTE, ANIMES_API } from '../../../public/JS/routes.js';

export default {
    components: {
        ElementInfoComponent,
        FooterComponent,
        HeaderComponent,
    },
    methods: {
        async animeLoad() {
            const data = await chapterLoad(this.id, ANIMES_API, this.chapterId);
            this.items = data.items;

            document.getElementById("chapter").innerHTML = `
            <iframe allowfullscreen class="cap-Video" frameborder="0" src="${this.items.link}"></iframe>`;
        }
    },
    props: {
        chapterId: String,
        chaptersNumber: Number,
        description: String,
        extraInfo: String,
        id: Number,
        login: Boolean,
        name: String,
    },
    data() {
        return {
            items: String,
        };
    },
    mounted() {
        elementInfoLoad(this.chapterId, this.description, this.extraInfo, "", this.name, true, ANIME_IMAGE_ROUTE);
        this.animeLoad();
    },
}
</script>

<style src="bootstrap/dist/css/bootstrap.css"></style>
<style src="bootstrap-icons/font/bootstrap-icons.css"></style>
<style src="../../css/chapters.css"></style>
<style src="../../css/element_Info.css"></style>
<style src="../../css/main.css"></style>
<style src="../../css/media_Chapters.css"></style>
<style src="../../css/media_Element_Info.css"></style>
<style src="../../css/media_Main.css"></style>
