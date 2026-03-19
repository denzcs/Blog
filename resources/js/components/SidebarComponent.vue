<template>
    <section id="sidebar">
        <!-- Intro -->
        <section id="intro">
            <a href="#" class="logo"><img src="images/logo.jpg" alt="" /></a>
            <header>
                <h2>Blog</h2>
                <p>Be popular with us</p>
            </header>
        </section>

        <!-- Mini Posts -->
        <section>
            <h3>Popular posts</h3>
            <template v-for="post in posts">
                <article class="mini-post">
                    <header>
                        <h3>
                            <a href="#">{{ post.title }}</a>
                        </h3>
                        <time class="published" datetime="2015-10-20">{{ this.created_at(post.created_at) }}</time>
                        <a
                            href="#"
                            @click.prevent="
                                changePage('UserPage', post.user.id)
                            "
                            class="author"
                            ><img :src="PUBLIC + post.user.avatar" alt=""
                        /></a>
                    </header>
                    <a
                        href="#"
                        @click.prevent="changePage('SinglePage', post.id)"
                        class="image"
                        ><img :src="PUBLIC + post.photo" alt=""
                    /></a>
                </article>
            </template>
            <div class="mini-posts">
                <!-- Mini Post -->
            </div>
        </section>

        <!-- Footer -->
    </section>
</template>

<script>
export default {
    name: 'SidebarComponent',
    props: ['posts', 'PUBLIC', 'changePage', 'created_at'],
};
</script>
