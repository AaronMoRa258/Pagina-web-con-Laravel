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
import { elementInfoLoad } from '../../../public/JS/main';
import { bookmarkCheck, listCheck } from '../../../public/JS/extra_Actions';
import { COMICS_API } from '../../../public/JS/routes.js';
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
        async comicLoad() {
            const data = await comicLoad(this.id, COMICS_API);
            this.items = data.items;
            
            elementInfoLoad(0, this.description, this.extraInfo, this.frontPage, this.name, false, "");
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
        const auth = usePage().props.auth;
        const checkElement = usePage().props.checkElement;
        const element = usePage().props.element;

        element.api = COMICS_API;
        element.elementId = this.id;
        element.user = auth.user.user;

        this.comicLoad();

        if (auth.user) {
            this.infoLoad(checkElement, element);
        }
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
