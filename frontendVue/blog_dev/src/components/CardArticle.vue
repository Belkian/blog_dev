<template>
    <div class="card-article">
        <img :src="post.image" :alt="post.title" class="article-image">
        <h2>{{ post.title || 'Titre non disponible' }}</h2>
        <p>{{ post.text.substring(0, 150) +
                            "..." || 'Contenu non disponible' }}</p>
        <div class="article-meta">
            <p>Auteur: {{ post.creator?.name || 'Inconnu' }}</p>
            <p>Catégorie: {{ post.categorie?.name || 'Non catégorisé' }}</p>
            <p>Date: {{ formatDate(post.createdAt) }}</p>
        </div>
        <RouterLink :to="{ name: 'ArticleDetail', params: { id: post.id } }" class="button">Détails</RouterLink>
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
.card-article {
    width: 23%;
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
    margin: 8px;
    padding: 5px 10px;
    background-color: #3232c0;
    text-decoration: none;
    text-align: center;
    color: white;
}
</style>