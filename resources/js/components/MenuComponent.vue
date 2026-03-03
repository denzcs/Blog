<template>
    <section id="menu">
        <!-- Actions -->
        <section>
            <ul class="actions vertical">
                <li><h3>Login</h3></li>
                <li>
                    <form action="?" method="post">
                        <input
                            type="text"
                            name="neme"
                            placeholder="Username"
                        /><br />
                        <input
                            type="password"
                            name="neme"
                            placeholder="Password"
                        /><br />
                        <input
                            type="submit"
                            class="button big fit"
                            value="Log In"
                        />
                    </form>
                </li>
                <RegisterComponent :server="server" />
            </ul>
        </section>
    </section>
</template>

<script>
import RegisterComponent from './RegisterComponent.vue';

export default {
    name: 'MenuComponent',
    props: ['server'],
    components: {
        RegisterComponent,
    },
};
</script>
