<template>

  <HeaderComponent />
  <NavComponent />

  <section id="main">
    <div class="content mt-4 mx-4">
      <!-- Renderizar los elementos de la API -->
      <article v-for="item in items" :key="item.id">
        <div class="card card-Background my-Card my-2 p-2">
          <a :href="`${route}${item.id}`">
            <div class="type-Image-Card">
              <div class="image-Card">
                <img :alt="item.name" class="card-img" :src="`${imageRoute}${item.image}`">
              </div>
              <p class="type">{{ item.type }}</p>
            </div>

            <div class="card-body">
              <p class="fs-6 mt-2 mx-3 text-center">{{ item.newName }}</p>
            </div>
          </a>
        </div>
      </article>
    </div>
    <div class="page-Changer">
      <button class="btn mt-4 mx-4 p-2" :disabled="page === 1" id="before" @click="pageBefore">
        Anterior Página
      </button>
      <button class="btn mt-4 mx-4 p-2" :disabled="!hasMore" id="next" @click="pageNext">
        Siguiente Página
      </button>
    </div>
  </section>
  <FooterComponent />
</template>

<script>
import FooterComponent from '../Components/FooterComponent.vue';
import HeaderComponent from '../Components/HeaderComponent.vue';
import NavComponent from '../Components/NavComponent.vue';
import { ANIMES_API, COMICS_API, ANIME_ROUTE, COMIC_ROUTE, ANIME_IMAGE_ROUTE } from '../../../public/JS/routes.js';
import { apiQuery, authCheck } from '../../../public/JS/main';

export default {
  props: {
    api: String,
    query: String,
    type: String,
    login: Boolean
  },
  components: {
    FooterComponent,
    HeaderComponent,
    NavComponent
  },
  computed: {
    imageRoute() {
      return this.type === 'comic' ? '' : ANIME_IMAGE_ROUTE;
    },
    route() {
      return this.type === 'comic' ? COMIC_ROUTE : ANIME_ROUTE;
    }
  },
  data() {
    return {
      page: 1,
      items: [],
      hasMore: true
    };
  },
  mounted() {
    authCheck(this.login); // si esta función es necesaria
    this.loadItems();
  },
  methods: {
    async loadItems() {
      const apiRoute = this.type === 'comic' ? COMICS_API : ANIMES_API;

      // apiQuery debe retornar { items: [...], hasMore: true/false }
      const data = await apiQuery(apiRoute, this.query, this.page);
      this.items = data.items;
      this.hasMore = data.hasMore;
    },
    pageBefore() {
      if (this.page > 1) {
        this.page--;
        this.loadItems();
      }
    },
    pageNext() {
      if (this.hasMore) {
        this.page++;
        this.loadItems();
      }
    }
  }
}
</script>

<style src="bootstrap/dist/css/bootstrap.css"></style>
<style src="bootstrap-icons/font/bootstrap-icons.css"></style>
<style src="../../css/cards.css"></style>
<style src="../../css/index.css"></style>
<style src="../../css/main.css"></style>
<style src="../../css/media_Index.css"></style>
<style src="../../css/media_Main.css"></style>
