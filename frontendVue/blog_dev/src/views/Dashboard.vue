<template>
    <div class="dashboard">
        <div class="center button">
            <RouterLink :to="{ name: 'CreateUpdateArticle', params: { type: 'create'}}" class="button">Créer un article</RouterLink>
        </div>
        <div>
            <h3>Mes articles</h3>
                <!-- <div v-for="article in userArticle" :key"article.id"> -->
            <div>
                <div class="lineOfArticle">
                    <h4>title article</h4>
                    <p>content</p>
                    <div>
                        <!-- <RouterLink :to="{name: 'CreateUpdateArticle', param:{ type: 'update' , id: userArticle.id}}" class="articleButtonUpdate size">update</RouterLink> -->
                        <button @click="fetchDeleteThisArticle(article.id)" class="articleButtonDelete size">delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script setup>
import { onMounted, ref } from 'vue';
import axios from '@/service/api';

let userArticle = ref([]);
const isLoading = ref(true);
const error = ref(null);

const fetchUserArticles = async () => {
    try {
        isLoading.value = true;
        error.value = null;
        let response = await axios.get(`/api/userArticle/`);
        userArticle.value = response.data;    
    } catch (error) {
        error.value = "Erreur lors de la récupération de l'article";
    } finally {
        isLoading.value = false;
    }
};
const fetchDeleteThisArticle = async (id) => {
    try{
        isLoading.value = true;
        error.value = null;
        await axios.delete(`/api/userArticle/${id}`);
        await fetchUserArticles();
    } catch (error) {
        error.value = "Erreur lors de la suppresion de l'article";
    } finally {
        isLoading.value = false;
    }
}

onMounted(() => {
    fetchUserArticles();
});
</script>

<style>
.lineOfArticle{
    display: flex;
    justify-content:space-between ;
    align-items: center;
}
.dashboard{
    background-color: rgb(245, 245, 245);
    border-radius: 5px;
    padding: 30px;
    margin: auto;
    width: 90%;
}
.center{
    margin: auto;
    text-align: center;
}
.button{
    width: 25%;
    height: 30px;
    background-color: #0056b3;
    border: none;
    border-radius: 5px;
    color: white;
    align-content: space-around;
    text-decoration: none;
}
.button:hover {
    background-color: #0056b3;
}
.articleButtonUpdate{
    background-color: blue;
    width: 15px;
    border: none;
}
.articleButtonDelete{
    background-color: red;
    margin: 3px;
    border: none;
}
.size{
    width: 30px;
    height: 30px;
}
</style>