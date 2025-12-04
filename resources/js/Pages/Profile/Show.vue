<template>

    <HeaderComponent />

    <nav class="navbar navbar-dark navbar-expand-lg">
        <div class="container-fluid px-4">
            <a class="active navbar-brand my-2 px-2" id="animes-Info" @click="activeList('Animes')">Animes</a>
            <a class="navbar-brand my-2 px-2" id="comics-Info" @click="activeList('Comics')">Comics</a>
            <a class="navbar-brand my-2 px-2" id="histories-Info" @click="activeList('Histories')">Historias</a>
        </div>
    </nav>

    <section id="main">
        <article class="justify-content-center user-Info">
            <div class="container">
                <div class="justify-content-center row">
                    <img alt="user-Image" class="rounded-circle" id="user-Image" src="/IMG/Logo.jpeg">
                </div>
                <div class="row" id="main-Info">
                    <p class="light-Color text-center" id="name"></p>
                    <p class="light-Color text-center" id="user"></p>
                </div>
                <div class="row" id="followers-Info">
                    <p class="light-Color text-center" id="followers"></p>
                    <p class="light-Color text-center" id="following"></p>
                </div>
            </div>
        </article>
    </section>

    <section id="secondary">
        <ListContainerComponent :id-elements="idAnimes">
            <template #containerBookmark>
                <div class="card card-Background my-Card m-2 p-2" v-for="element in animeBookmarks" :key="element"
                    v-html="elementLoad(element, `/${ANIME_IMAGE_ROUTE}${element.image}`, 'animes.show')">
                </div>
            </template>
            <template #elementsOther>
                <span v-for="key in Object.keys(animeList)" :key="key">
                    <div class="lists mt-4 mx-4" v-if="animeList[key].length > 0">
                        <div class="container">
                            <div class="row">
                                <h3 class="light-Color list-Title">{{ key }}</h3>
                            </div>
                            <div class="row">
                                <div class="elements-List">
                                    <div class="card card-Background my-Card m-2 p-2" v-for="element in animeList[key]"
                                        :key="element" v-html="elementLoad(element, `/${ANIME_IMAGE_ROUTE}${element.image}`, 'animes.show')"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </span>
            </template>
        </ListContainerComponent>
        <ListContainerComponent :id-elements="idComics">
            <template #containerBookmark>
                <div class="card card-Background my-Card m-2 p-2" v-for="element in comicBookmarks" :key="element"
                    v-html="elementLoad(element, element.front_page, 'comics.show')">
                </div>
            </template>
            <template #elementsOther>
                <span v-for="key in Object.keys(comicList)" :key="key">
                    <div class="lists mt-4 mx-4" v-if="comicList[key].length > 0">
                        <div class="container">
                            <div class="row">
                                <h3 class="light-Color list-Title">{{ key }}</h3>
                            </div>
                            <div class="row">
                                <div class="elements-List">
                                    <div class="card card-Background my-Card m-2 p-2" v-for="element in comicList[key]"
                                        :key="element" v-html="elementLoad(element, element.front_page, 'comics.show')"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </span>
            </template>
        </ListContainerComponent>
        <ListContainerComponent :id-elements="idHistories">
            <template #containerBookmark>
                <div class="card card-Background my-Card m-2 p-2" v-for="element in historyBookmarks" :key="element"
                    v-html="elementLoad(element)">
                </div>
            </template>
            <template #elementsOther>
                <span v-for="key in Object.keys(historyList)" :key="key">
                    <div class="lists mt-4 mx-4" v-if="historyList[key].length > 0">
                        <div class="container">
                            <div class="row">
                                <h3 class="light-Color list-Title">{{ key }}</h3>
                            </div>
                            <div class="row">
                                <div class="elements-List">
                                    <div class="card card-Background my-Card m-2 p-2" v-for="element in historyList[key]"
                                        :key="element" v-html="elementLoad(element)"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </span>
            </template>
        </ListContainerComponent>
    </section>

    <FooterComponent />

</template>

<script setup>

const idAnimes = {
    containerBookmark: "animes-Bookmark-Container",
    elementsBookmark: "anime-Bookmark-Elements",
    containerOther: "animes-Other-List-Container",
    elementsOther: "anime-Other-List-Elements"
};

const idComics = {
    containerBookmark: "comics-Bookmark-Container",
    elementsBookmark: "comic-Bookmark-Elements",
    containerOther: "comics-Other-List-Container",
    elementsOther: "comic-Other-List-Elements"
};

const idHistories = {
    containerBookmark: "histories-Bookmark-Container",
    elementsBookmark: "history-Bookmark-Elements",
    containerOther: "histories-Other-List-Container",
    elementsOther: "history-Other-List-Elements"
};

</script>

<script>
import FooterComponent from '../../Components/FooterComponent.vue';
import HeaderComponent from '../../Components/HeaderComponent.vue';
import ListContainerComponent from '../../Components/ListContainerComponent.vue';
import { activeList, bookmarksLoad, listsLoad } from '../../../../public/JS/user';
import { titleLengthDefine } from '../../../../public/JS/main';
import { ANIME_IMAGE_ROUTE, ANIMES_API, COMICS_API } from '../../../../public/JS/routes.js';

export default {
    components: {
        FooterComponent,
        HeaderComponent,
        ListContainerComponent,
    },
    methods: {
        async loadLists() {
            const dataBookmarks = await bookmarksLoad(ANIMES_API, COMICS_API, this.user);
            const dataList = await listsLoad(ANIMES_API, COMICS_API, this.user);

            this.animeBookmarks = dataBookmarks.animeBookmarks;
            this.comicBookmarks = dataBookmarks.comicBookmarks;
            this.animeList = dataList.animeList;
            this.comicList = dataList.comicList;
        },
        elementLoad(element, imageRoute, linkRoute) {
            return `<a href="${route(linkRoute, [element.id])}">
                        <div class="type-Image-Card">
                            <div class="image-Card">
                                <img :alt="element.name" class="card-img"
                                    src="${imageRoute}">
                            </div>
                            <p class="type">${element.type}</p>
                        </div>

                        <div class="card-body">
                            <p class="fs-6 mt-2 mx-3 text-center">${titleLengthDefine(element.name)}</p>
                        </div>
                    </a>`;
        },
        userInfoLoad() {
            document.getElementById("followers").innerHTML = `Seguidores: ${this.followers}`;
            document.getElementById("following").innerHTML = `Siguiendo: ${this.following}`;
            document.getElementById("name").innerHTML = `${this.name}`;
            document.getElementById("user").innerHTML = `@ ${this.user}`;
        }
    },
    props: {
        followers: Number,
        following: Number,
        name: String,
        user: String,
    },
    data() {
        return {
            animeBookmarks: {},
            animeList: {},
            comicBookmarks: {},
            comicList: {},
            historyBookmarks: {},
            historyList: {},
        };
    },
    mounted() {
        this.userInfoLoad();
        this.loadLists();
    },
}
</script>

<style src="bootstrap/dist/css/bootstrap.css"></style>
<style src="bootstrap-icons/font/bootstrap-icons.css"></style>
<style src="../../../css/cards.css"></style>
<style src="../../../css/main.css"></style>
<style src="../../../css/user.css"></style>
<style src="../../../css/media_Main.css"></style>