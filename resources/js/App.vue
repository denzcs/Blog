<template>
    <div id="wrapper">
        <HeaderComponent />

        <MenuComponent
            :server="server"
            :isUser="isUser"
            :successUser="successUser"
        />
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
            API: 'http://127.0.0.1:8000/api/',
            isUser: false,
        };
    },
    methods: {
        successUser(token) {
            localStorage.setItem('token', token);
            this.isUser = true;
        },
        async server(route, method = 'GET', FormData = null) {
            let myHeaders = new Headers();
            myHeaders.append('Accept', 'application/json');
            if (localStorage.getItem('token')) {
                myHeaders.append(
                    'Authorization',
                    'Bearer ' + localStorage.getItem('token'),
                );
            }

            let requestOptions = {
                method: method,
                headers: myHeaders,
                redirect: 'follow',
            };

            if (method != 'GET') {
                requestOptions.body = FormData;
            }

            return await fetch(this.API + route, requestOptions).then(
                (response) => {
                    return response.json();
                },
            );
            // .then((result) => console.log(result))
            // .catch((error) => console.error(error));
        },
    },
    components: {
        HeaderComponent,
        MenuComponent,
        FooterComponent,
        HomePage,
    },
};
</script>
