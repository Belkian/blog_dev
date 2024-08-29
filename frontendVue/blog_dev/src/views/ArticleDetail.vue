<template>
    <div v-if="isLoading">Chargement...</div>
    <div v-else>
        <div id="ArticleDetail">
            <h1>{{ post.title }}</h1>
            <h2>{{ post.categorie }}</h2>
            <p>{{ post.text }}</p>
            <p>{{ post.creator.name }}</p>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from '@/service/api';

const route = useRoute();
const articleId = route.params.id;

let post = ref([]);
const isLoading = ref(true);
const error = ref(null);


const fetchPost = async () => {
    try {
        isLoading.value = true;
        error.value = null;
        let response = await axios.get(`/api/articles/${articleId}`);
        console.log(response.data);
        post.value = response.data;
    } catch (error) {
        console.error("Erreur lors de la récupération de l'article", error);
        error.value = "Impossible de charger l'article";
    } finally {
    isLoading.value = false;
    }
};

onMounted(() => {
    fetchPost();
});
</script>

<style scoped>
#ArticleDetail{
    width: 85%;
    margin: auto;
}
h1{
    text-align: center;
}
/* h2{

}
p{

} */
</style>