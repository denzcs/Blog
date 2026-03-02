<template>
    <div id="wrapper">
        <HeaderComponent />

        <MenuComponent />
        <HomePage v-if="page == 'HomePage'" />
    </div>
    <FooterComponent />
</template>

<script>
import FooterComponent from './components/FooterComponent.vue';
import HeaderComponent from './components/HeaderComponent.vue';
import MenuComponent from './components/MenuComponent.vue';
import HomePage from './pages/HomePage.vue';

export default {
    name: 'App',
    data() {
        return {
            page: 'HomePage',
        };
    },
    components: {
        HeaderComponent,
        MenuComponent,
        FooterComponent,
        HomePage,
    },
};
</script>
