<template>
    <div id="main">
        <article class="post">
            <h1>Add Post</h1>
            <input type="text" placeholder="Post name" v-model="title" />
            <p class="red" v-if="errors.title">
                {{ errors.title.join('. ') }}
            </p>
            <br />
            <input type="text" placeholder="Subtitle" v-model="subtitle" />
            <p class="red" v-if="errors.subtitle">
                {{ errors.subtitle.join('. ') }}
            </p>
            <br />
            <input type="text" placeholder="Anons" v-model="anons" />
            <p class="red" v-if="errors.anons">
                {{ errors.anons.join('. ') }}
            </p>
            <br />
            <textarea placeholder="Post content" v-model="content"></textarea>
            <p class="red" v-if="errors.content">
                {{ errors.content.join('. ') }}
            </p>
            <br />
            <input type="file" name="file" id="photo" />
            <p class="red" v-if="errors.photo">
                {{ errors.photo.join('. ') }}
            </p>
            <br /><br />
            <button
                type="button"
                @click="postadd()"
                class="button big fit"
                value="Add Post"
            >
                Add post
            </button>
        </article>
    </div>
</template>
<script>
export default {
    title: 'PostAdd',
    props: ['server', 'changePage'],
    data() {
        return {
            title: null,
            subtitle: null,
            anons: null,
            content: null,
            errors: {},
        };
    },
    methods: {
        postadd() {
            let formdata = new FormData();
            if (this.title) formdata.append('title', this.title);
            if (this.subtitle) formdata.append('subtitle', this.subtitle);
            if (this.anons) formdata.append('anons', this.anons);
            if (this.content) formdata.append('content', this.content);
            let photo = document.querySelector('#photo');
            if (photo.files[0]) {
                formdata.append('photo', photo.files[0]);
            }
            this.server('postadd', 'POST', formdata)
                .then((result) => {
                    console.log(result);
                    if (result.errors) {
                        this.errors = result.errors;
                    }
                    if (result.id) {
                        this.changePage('SinglePage', result.id);
                    }
                })
                .catch((error) => console.error(error));
        },
    },
};
</script>
