<template>
    <div id="main">
        <template v-for="value in posts.data">
            <PostComponent
                :post="value"
                :PUBLIC="PUBLIC"
                :changePage="changePage"
            />
        </template>

        <ul class="actions pagination">
            <li>
                <a
                    href=""
                    class="button big previous"
                    :class="{ disabled: posts.current_page == 1 }"
                    @click.prevent="getPosts(posts.current_page - 1)"
                    >Previous Page</a
                >
            </li>
            <li>
                <a
                    href="#"
                    :class="{ disabled: posts.current_page == posts.last_page}"
                    @click.prevent="getPosts(posts.current_page + 1)"
                    class="button big next"
                    >Next Page</a
                >
            </li>
        </ul>
    </div>
    <SidebarComponent />
</template>

<script>
import PostComponent from '@/components/PostComponent.vue';
import SidebarComponent from '@/components/SidebarComponent.vue';

export default {
    name: 'HomePage',
    components: {
        PostComponent,
        SidebarComponent,
    },
    props: ['server', 'PUBLIC', 'changePage'],
    data() {
        return {
            posts: [],
        };
    },
    mounted() {
        this.getPosts();
    },
    methods: {
        getPosts(page = 1) {
            this.server('posts/' + '?page=' + page)
                .then((result) => {
                    this.posts = result;
                    console.log(result);
                })
                .catch((error) => console.error(error));
        },
    },
};
</script>
