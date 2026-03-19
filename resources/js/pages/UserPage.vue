<template>
    <div id="main">
        <template v-for="post in posts.data">
            <PostComponent
                :post="post"
                :PUBLIC="PUBLIC"
                :changePage="changePage"
                :server="server"
                :created_at="created_at"
            />
        </template>
        <!-- Pagination -->
        <ul class="actions pagination">
            <li>
                <a
                    href=""
                    class="button big previous"
                    :class="{ disabled: posts.current_page == 1 }"
                    @click.prevent="postUser(posts.current_page - 1)"
                    >Previous Page</a
                >
            </li>
            <li>
                <a
                    href="#"
                    :class="{ disabled: posts.current_page == posts.last_page }"
                    @click.prevent="postUser(posts.current_page + 1)"
                    class="button big next"
                    >Next Page</a
                >
            </li>
        </ul>
    </div>
</template>
<script>
import PostComponent from '@/components/PostComponent.vue';

export default {
    props: ['server', 'pageId', 'PUBLIC', 'changePage', 'PostComponent', 'created_at'],
    name: 'UserPage',
    components: {
        PostComponent,
    },
    data() {
        return {
            posts: [],
        };
    },
    mounted() {
        this.postUser();
    },
    methods: {
        postUser(page=1) {
            this.server('userPage/' + this.pageId + '?page=' + page)
                .then((result) => {
                    this.posts = result;
                    console.log(result);
                })
                .catch((error) => console.error(error));
        },
    },
};
</script>
