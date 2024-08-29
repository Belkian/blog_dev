<template>
    <div class="formArticle">
        <label for="title">Titre</label>
        <input type="text" id="title" v-model="userArticle.title">

        <label for="content">Contenu</label>
        <textarea id="content" v-model="userArticle.content"></textarea>
        
        <label for="category">Catégorie</label>
        <select id="category" v-model="userArticle.categorie">
            <option v-for="categorie in categories" :key="categorie.id" :value="categorie.id">
                {{ categorie.name }}
            </option>
        </select>
        <div v-if="error">{{ error }}</div>
        <div class="flex">
            <button class="blue button" @click="updateArticle">Confirmer</button>
            <RouterLink :to="{ name: 'Dashboard' }" class="red button">Annuler</RouterLink>       
        </div>
    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useRoute } from 'vue-router';
import axios from '@/service/api';

const userArticle = ref({});
const categories = ref([]);
const isLoading = ref(false);
const error = ref(null);
const route = useRoute();
const formParamsId = route.params.id;
const formParamsType = route.params.type;

const fetchUserArticle = async () => {
    try {
        isLoading.value = true;
        error.value = null;
        const response = await axios.get(`/api/userArticle/${formParamsId}`);
        userArticle.value = response.data;    
    } catch (err) {
        error.value = "Erreur lors de la récupération de l'article";
        console.error(err);
    } finally {
        isLoading.value = false;
    }
};

const fetchCategorieArticle = async () => {
    try {
        isLoading.value = true;
        error.value = null;
        const response = await axios.get('/api/categorie');
        categories.value = response.data;    
    } catch (err) {
        error.value = "Erreur lors de la récupération des catégories";
        console.error(err);
    } finally {
        isLoading.value = false;
    }
};

const updateArticle = async () => {
    try {
        isLoading.value = true;
        error.value = null;
        await axios.put(`/api/updateArticle/${formParamsId}`, userArticle.value);
        // Rediriger ou afficher un message de succès ici
    } catch (err) {
        error.value = "Erreur lors de la mise à jour de l'article";
        console.error(err);
    } finally {
        isLoading.value = false;
    }
};

onMounted(() => {
    if (formParamsType === 'update') {
        fetchUserArticle();
    }
    fetchCategorieArticle();
});
</script>

<style scoped>
input, select, textarea{
    border: none;
    padding: 5px;
}

.formArticle{
    display: flex;
    flex-direction: column;
    width: 90%;
    margin: auto;
    background-color: rgb(245, 245, 245);
    border-radius: 5px;
    padding: 30px;
}
.flex{
    display: flex;
    justify-content: space-between;
}
.red{
    background-color: red;
}
.blue{
    background-color: blue;
}
button{
    border: none;
    border-radius: 5px;
}
label{
    margin-top: 15px;
}
.button{
    border-radius: 5px;
    margin-top: 15px;
    text-decoration: none;
    text-align: center;
    color: white;
    align-content: space-around;
    width: 75px;
}

</style>