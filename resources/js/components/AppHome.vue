<template>
    <div>
        <toolbar-vue></toolbar-vue>
        <router-view></router-view>
        <footer-vue></footer-vue>
    </div>
</template>

<script>
import ToolbarVue from "./Toolbar.vue";
import FooterVue from "./Footer.vue";

export default {
    components: {
        ToolbarVue,
        FooterVue
    }
};
</script>

<style></style>
