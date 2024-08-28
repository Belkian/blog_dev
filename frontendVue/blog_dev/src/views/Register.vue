<template>
    <form @submit.prevent="register" id="Register">
        <h1>Inscription</h1>
        <div v-if="errorPassword == true" class="error">{{ errorMessage }}</div>

        <label for="Name">Nom</label>
        <input type="text" id="Name" v-model="Name" required>

        <label for="LastName">Prénom</label>
        <input type="text" id="LastName" v-model="LastName" required>

        <label for="Email">Email</label>
        <input type="email" id="Email" v-model="email" required>

        <label for="Password">Password</label>
        <input type="password" id="Password" v-model="password" minlength="6" required>

        <label for="Password2">Password 2</label>
        <input type="password" id="Password2" v-model="password2" minlength="6" required>

        <div class="flex">
            <button @click="Register" class="button">S'inscrire</button>
            <RouterLink :to="{ name: 'Login' }" class="button">Se connecter</RouterLink>
        </div>
    </form>
</template>

<script setup>
import { ref } from 'vue';
import axios from '@/service/api';

const Name = ref('');
const LastName = ref('');
const email = ref('');
const password = ref('');
const password2 = ref('');
const errorPassword = ref(false);
const errorMessage = ref('')

const Register = async () => {
    errorPassword.value = false;
    const DateNow = new Date()
    if (password.value === password2.value && password.value != null && password2.value != nulls) {
        try {
            const response = await axios.post('/register', { 
                email: email.value, 
                name: Name.value, 
                lastName: LastName.value, 
                password: password.value,
                rgpd: DateNow
            });
            console.log(response.data)
            if (response.data == 'true') {
                errorMessage.value = "Votre inscription a bien été pris en compte."
            } else {
                errorMessage.value = "Erreur lors de l'inscription"
            }
        } catch (error) {
        }
    } else {
        errorPassword.value = true
        errorMessage.value = "Les mots de passe doivent être identique."
    }
};
</script>

<style scoped>
h1{
    text-align: center;
}
#Register{
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


.flex{
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.error{
    color: red;
}
</style>