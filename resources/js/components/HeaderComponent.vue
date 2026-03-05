<template>
    <header id="header">
        <h1><a href="#">Blog</a></h1>
        <nav class="main">
            <ul>
                <li class="menu" v-if="!isUser">
                    <a class="fa-user" href="#menu">Menu</a>
                </li>
                <li class="menu user" v-else>
                    <a href="#menu"><img :src="PUBLIC + user.avatar" alt="" /></a>
                </li>
            </ul>
        </nav>
    </header>
</template>

<script>
export default {
    name: 'HeaderComponent',
    props: ['user', 'isUser', 'PUBLIC'],
};
</script>
