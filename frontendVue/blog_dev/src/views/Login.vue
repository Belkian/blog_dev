<template>
    <div id="Login">
        <h1>Connexion</h1>
        <div v-if="errorConnexion == true" class="error">{{ errorMessage }}</div>
        <label for="email">Email</label>
        <input type="email" id="email" v-model="email" autocomplete="email" required>
        <label for="password">Password</label>
        <input type="password" id="password" v-model="password" autocomplete="password" required>
        <div class="flex">
            <div @click="Connexion" class="button">Connexion</div>
            <RouterLink :to="{ name: 'Register' }" class="button">S'inscrire</RouterLink>
        </div>
    </div>
</template>

<script setup>
import { ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from '@/service/api';


const router = useRouter();
const errorMessage = ref('');
const errorConnexion = ref(false);

const Connexion = async () => {
    errorConnexion.value = false
    try {
        const email = ref('');
        const password = ref('');
        const response = await axios.post('/login', { 
            email: email.value, 
            password: password.value 
        });
        if (response.data.token) {
            localStorage.setItem('user-token', response.data.token)
            router.push({ name: 'Dashboard' });
        } else {
            errorConnexion.value = true
            errorMessage.value = "Erreur de connexion"
        }
    } catch (error) {
        console.error('Login failed:', error);
    }
};
</script>

<style scoped>
h1{
    text-align: center;
}
#Login{
    background-color: rgb(238, 238, 238);
    padding: 20px;
    width: 50%;
    margin: auto;
    display: flex;
    flex-direction: column;
    border-radius: 15px;
}
label{
    margin-top: 10px;
}
.flex{
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.error{
    color: red;
}
.button{
    border-radius: 5px;
    margin-top: 15px;
    background-color: #0056b3;
    text-decoration: none;
    text-align: center;
    color: white;
    align-content: space-around;
}
.button:hover {
    background-color: #0056b3;
}
</style>