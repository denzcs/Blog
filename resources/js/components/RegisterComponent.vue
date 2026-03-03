<template>
    <li><h3>Registration</h3></li>
    <li><input type="text" name="neme" placeholder="Name" v-model="name"/><br />
        <input type="text" name="neme" placeholder="Username" v-model="username"/><br />
        <input type="password" name="neme" placeholder="Password" v-model="password"/><br />
        <input type="file" name="file" /><br /><br />
        <button type="button" class="button big fit" @click="register">Регистрация</button>
    </li>
</template>
<script>
export default {
    name: 'RegisterComponent',
    daga(){
        return{
            name: null,
            username: null,
            password: null,
        }
    },
    props: ['server'],
    methods: {
        register(){
            
        }
    }
};
</script>
