<template>
    <div class="card-article">
        <!-- <img :src="post.image" :alt="post.title" class="article-image"> -->
        <img src="../../media/arnel-hasanovic-MNd-Rka1o0Q-unsplash.jpg" class="article-image" alt="image wesh">
        <h2>{{ post.title || 'Titre non disponible' }}</h2>
        <div class="article-meta">
            <p>Auteur: {{ post.creator?.name || 'Inconnu' }}</p>
            <p>Catégorie: {{ post.categorie?.name || 'Non catégorisé' }}</p>
            <p>Date: {{ formatDate(post.createdAt) }}</p>
        </div>
        <p class="margin-b">{{ post.text.substring(0, 150) + '...' || 'Contenu non disponible' }}</p>
        <div class="position-bl">
            <RouterLink :to="{ name: 'ArticleDetail', params: { id: post.id } }" class="button">Détails</RouterLink>
        </div>
    </div>
</template>

<script setup>
import { defineProps } from 'vue';

const props = defineProps({
post: {
    type: Object,
    required: true
}
});

const formatDate = (dateString) => {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(dateString).toLocaleDateString('fr-FR', options);
};
</script>

<style scoped>
p{
    margin-bottom: 10px;
}
.card-article {
    box-shadow: 0px 0px 5px rgb(204, 204, 204);
    position: relative;
    border: 1px solid #ddd;
    border-radius: 8px;
    padding: 16px;
    margin: 10px;
}

.article-image {
    max-width: 100%;
    height: auto;
    border-radius: 4px;
}

.article-meta {
    font-size: 0.9em;
    color: #666;
}
.button{
    border-radius: 10px;
    padding: 10px 15px;
    background-color: #3232c0;
    text-decoration: none;
    text-align: center;
    color: white;
}
.position-bl{
    position:absolute;
    left: 10px;
    bottom: 17px;
}
.margin-b{
    margin-bottom: 55px;
}
@media (min-width: 750px) {
    .card-article{
        width:50%;
    }
}
</style>