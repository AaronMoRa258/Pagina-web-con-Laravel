<template>
    <HeaderComponent />

    <section id="main">
        <ElementInfoComponent />
    </section>

    <section id="secondary">
        <article class="mt-4 mx-4" id="images">
            <img v-for="item in items" :key="item"
                :src="item.link"
            >
        </article>
    </section>

    <FooterComponent />
</template>

<script>
import ElementInfoComponent from '../Components/ElementInfoComponent.vue';
import FooterComponent from '../Components/FooterComponent.vue';
import HeaderComponent from '../Components/HeaderComponent.vue';
import { comicLoad } from '../../../public/JS/comics';
import { authCheck, elementInfoLoad } from '../../../public/JS/main';
import { COMICS_API } from '../../../public/JS/routes.js';

export default {
    components: {
        ElementInfoComponent,
        FooterComponent,
        HeaderComponent,
    },
    methods: {
        async comicLoad() {
            const data = await comicLoad(this.id, COMICS_API);
            this.items = data.items;
            
            elementInfoLoad(0, this.description, this.extraInfo, this.frontPage, this.name, false, "");
        }
    },
    props: {
        description: String,
        extraInfo: String,
        frontPage: String,
        id: Number,
        login: Boolean,
        name: String,
    },
    data() {
        return {
            items: [],
        };
    },
    mounted() {
        authCheck(this.login);
        this.comicLoad();
    },
}
</script>

<style src="bootstrap/dist/css/bootstrap.css"></style>
<style src="bootstrap-icons/font/bootstrap-icons.css"></style>
<style src="../../css/comic.css"></style>
<style src="../../css/element_Info.css"></style>
<style src="../../css/extra_Actions.css"></style>
<style src="../../css/main.css"></style>
<style src="../../css/media_Element_Info.css"></style>
<style src="../../css/media_Extra_Actions.css"></style>
<style src="../../css/media_Main.css"></style>
