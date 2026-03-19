<template>
    <article class="post">
        <header>
            <div class="title">
                <h2>
                    <a
                        href="#"
                        @click.prevent="changePage('SinglePage', post.id)"
                        >{{ post.title }}</a
                    >
                </h2>
                <p>{{ post.subtitle }}</p>
            </div>
            <div class="meta">
                <time class="published" datetime="2015-11-01">{{
                    this.created_at(post.created_at)
                }}</time>
                <a
                    href="#"
                    @click.prevent="changePage('UserPage', post.user.id)"
                    class="author"
                    ><span class="name">{{ post.user.name }}</span
                    ><img :src="PUBLIC + post.user.avatar" alt=""
                /></a>
            </div>
        </header>
        <a
            href="#"
            @click.prevent="changePage('SinglePage', post.id)"
            class="image featured"
            ><img :src="PUBLIC + post.photo" alt=""
        /></a>
        <p>
            {{ post.content }}
        </p>
        <footer>
            <ul class="actions">
                <li>
                    <a
                        href="#"
                        @click.prevent="changePage('SinglePage', post.id)"
                        class="button big"
                        >Continue Reading</a
                    >
                </li>
            </ul>
            <ul class="stats">
                <li>
                    <a
                        href="#"
                        class="icon fa-heart"
                        @click.prevent="likeAdd()"
                        >{{ post.likes_count }}</a
                    >
                </li>
                <li>
                    <a href="#" class="icon fa-comment">{{
                        post.comments_count
                    }}</a>
                </li>
            </ul>
        </footer>
    </article>
</template>

<script>
export default {
    name: 'PostComponent',
    props: ['post', 'PUBLIC', 'changePage', 'server', 'getPosts', 'page', 'created_at'],
    methods: {
        likeAdd() {
            this.server('like/' + this.post.id)
                .then((result) => {
                    if (result.message) {
                        alert('Вы не авторизованы');
                    } else {
                        this.getPost();
                    }
                })
                .catch((error) => console.error(error));
        },
        getPost() {
            this.server(
                (localStorage.getItem('token') ? 'postUser/' : 'post/') +
                    this.post.id,
            )
                .then(() => {
                    this.getPosts(this.page);
                })
                .catch((error) => console.error(error));
        },
    },
};
</script>
