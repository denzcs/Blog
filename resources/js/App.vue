<template>
    <div id="wrapper">
        <HeaderComponent :user="user" :isUser="isUser" :PUBLIC="PUBLIC" />

        <MenuComponent
            :server="server"
            :isUser="isUser"
            :successUser="successUser"
            :changePage="changePage"
        />
        <HomePage v-if="page == 'HomePage'" />
        <PostAdd
            v-if="page == 'PostAdd'"
            :server="server"
            :changePage="changePage"
            :pageId="pageId"
            :PUBLIC="PUBLIC"
        />
        <SinglePage
            v-if="page == 'SinglePage'"
            :server="server"
            :changePage="changePage"
            :pageId="pageId"
            :PUBLIC="PUBLIC"
        />
        <UserPage
            v-if="page == 'UserPage'"
            :server="server"
            :changePage="changePage"
            :pageId="pageId"
            :PUBLIC="PUBLIC"
        />
    </div>
    <FooterComponent />
</template>

<script>
import FooterComponent from './components/FooterComponent.vue';
import HeaderComponent from './components/HeaderComponent.vue';
import MenuComponent from './components/MenuComponent.vue';
import HomePage from './pages/HomePage.vue';
import PostAdd from './pages/PostAdd.vue';
import SinglePage from './pages/SinglePage.vue';
import UserPage from './pages/UserPage.vue';

export default {
    name: 'App',
    data() {
        return {
            page: localStorage.getItem('page') || 'HomePage',
            pageId: localStorage.getItem('pageId') || 'pageId',
            API: 'http://127.0.0.1:8000/api/',
            PUBLIC: 'http://127.0.0.1:8000/storage/',
            isUser: false,
            user: {},
        };
    },
    methods: {
        changePage(page, pageId = null) {
            this.page = page;
            this.pageId = pageId;
            localStorage.setItem('page', this.page);
            localStorage.setItem('pageId', this.pageId);
        },
        getUser() {
            this.server('user')
                .then((result) => {
                    this.user = result;
                    this.isUser = true;
                    console.log(this.isUser);
                })
                .catch((error) => console.error(error));
        },
        successUser(token) {
            localStorage.setItem('token', token);
            this.isUser = true;
            this.getUser();
        },
        logout() {
            localStorage.removeItem('token');
            this.user = {};
            this.isUser = false;
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
                    if (response.status == 401) {
                        this.logout();
                    }
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
        PostAdd,
        SinglePage,
        UserPage,
    },
    mounted() {
        if (localStorage.getItem('token')) {
            this.getUser();
        }
    },
};
</script>
