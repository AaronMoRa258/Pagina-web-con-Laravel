<template>
    <article :id="idElements.containerBookmark">
        <div class="lists mt-4 mx-4">
            <div class="container">
                <div class="row">
                    <h3 class="light-Color list-Title">Favoritos</h3>
                </div>
                <div class="row">
                    <div class="elements-List" :id="idElements.elementsBookmark">
                        <slot name="containerBookmark" />
                    </div>
                </div>
            </div>
        </div>
    </article>
    <article :id="idElements.containerOther">
        <slot name="elementsOther" :id="idElements.elementsOther" />
    </article>
</template>

<script setup>
const props = defineProps({
    idElements: {}
})
</script>