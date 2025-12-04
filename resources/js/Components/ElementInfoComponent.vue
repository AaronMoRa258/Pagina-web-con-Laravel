<template>
    <article class="card element-Gradient mt-4 mx-4" id="element-Info">
        <div class='container-fluid'>
            <div class='align-items-center gap-3 p-3 row'>
                <div class='element-Image' id='element-Image'></div>
                <div class='information'>
                    <div class='card-body p-1'>
                        <h3 class='card-title' id='element-Name'></h3>
                        <p class='card-text' id='element-Description'></p>
                        <div>
                            <ul class='extra-Info' id='extra-Info'></ul>
                        </div>

                        <ExtraActionsComponent />
                    </div>
                </div>
            </div>
            <div class='element-Background-Image'></div>
        </div>
    </article>
</template>

<script>
import ExtraActionsComponent from '../Components/ExtraActionsComponent.vue';

export default {
    components: {
        ExtraActionsComponent
    }
}
</script>