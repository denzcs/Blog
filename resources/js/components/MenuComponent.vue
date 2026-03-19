<template>
    <section id="menu">
        <!-- Actions -->
        <section>
            <ul class="actions vertical" v-if="!isUser">
                <li><h3>Login</h3></li>
                <li>
                    <LoginComponent
                        :server="server"
                        :successUser="successUser"
                    />
                </li>
                <RegisterComponent
                    :server="server"
                    :successUser="successUser"
                />
            </ul>
            <ul v-else>
                <li>
                    <a href="" @click.prevent="changePage('PostAdd')"
                        >Создать пост</a
                    >
                </li>
                <li>
                    <a href="" @click.prevent="logout()">Выйти из аккаунта</a>
                </li>
            </ul>
        </section>
    </section>
</template>

<script>
import PostAdd from '@/pages/PostAdd.vue';
import RegisterComponent from './RegisterComponent.vue';
import LoginComponent from './LoginComponent.vue';

export default {
    name: 'MenuComponent',
    props: ['server', 'isUser', 'successUser', 'changePage', 'logout'],
    components: {
        RegisterComponent,
        PostAdd,
        LoginComponent,
    },
};
</script>
