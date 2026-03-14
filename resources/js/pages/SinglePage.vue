<template>
    <div id="main" v-if="post">
        <!-- Post -->
        <article class="post">
            <header>
                <div class="title">
                    <h2>
                        <a href="#">{{ post.title }}</a>
                    </h2>
                    <p>{{ post.subtitle }}</p>
                </div>
                <div class="meta">
                    <time class="published" datetime="2015-11-01">{{
                        post.created_at
                    }}</time>
                    <a href="#" class="author"
                        ><span class="name">{{ post.user.name }}</span
                        ><img :src="PUBLIC + post.user.avatar" alt=""
                    /></a>
                </div>
            </header>
            <span class="image featured"
                ><img :src="PUBLIC + post.photo" alt=""
            /></span>
            <p>
                {{ post.anons }}
            </p>
            <p>
                {{ post.content }}
            </p>
            <footer>
                <ul class="stats">
                    <li><a href="#" @click.prevent="changePage('PostAdd', post.id)">Edit</a></li>
                    <li><a href="#" class="red">Delete</a></li>
                    <li><a href="#" class="red">Blocked</a></li>
                    <li><a href="#" class="icon fa-heart">28</a></li>
                    <li><a href="#" class="icon fa-comment">128</a></li>
                </ul>
            </footer>
        </article>

        <!-- Comments -->
        <div class="post">
            <section class="comments">
                <h3>Comments</h3>
                <form>
                    <textarea v-model="comment"></textarea><br />
                    <p class="red" v-if="errors.comment">
                        {{ errors.comment.join('. ') }}
                    </p>
                    <button
                        type="button"
                        class="button big fit"
                        value="Add Comment"
                        @click="addComment"
                    >
                        Add Comment
                    </button>
                </form>
            </section>
            <article class="comment" v-for="value in comments">
                <div class="comment-autor">
                    <a href="#"><img :src="PUBLIC + value.user.avatar" /></a>
                    <a href="#">{{ value.user.name }}</a>
                </div>
                <p>
                    {{ value.comment }}
                </p>
            </article>
        </div>
    </div>
</template>
<script>
export default {
    props: ['server', 'pageId', 'PUBLIC', 'changePage'],
    name: 'SinglePage',
    data() {
        return {
            errors: {},
            comments: [],
            post: null,
            comment: null,
        };
    },
    mounted() {
        this.getPost();
    },
    methods: {
        getPost() {
            this.server('post/' + this.pageId)
                .then((result) => {
                    this.post = result.post;
                    this.comments = result.comments;
                    if (result.id) {
                        this.changePage('SinglePage', result.id);
                    }
                })
                .catch((error) => console.error(error));
        },
        addComment() {
            let formdata = new FormData();
            if (this.comment) formdata.append('comment', this.comment);
            this.server('comment/' + this.pageId, 'POST', formdata)
                .then((result) => {
                    if (result.errors) {
                        this.errors = result.errors;
                    } else {
                        console.log(result);
                        this.getPost();
                    }
                })
                .catch((error) => console.error(error));
        },
    },
};
</script>
