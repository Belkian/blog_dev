<template>
  <div class="home">
    <template v-if="All_posts.length">
      <CardArticle v-for="post in All_posts" :key="post.id" :post="post" />
    </template>
    <template v-else>
      <p>Pas d'articles trouvés</p>
    </template>
  </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import CardArticle from '@/components/CardArticle.vue';
import axios from '@/service/api';

let All_posts = ref([]);

const fetchAllPosts = async () => {
  try {
    let response = await axios.get('/api/articles');
    All_posts.value = response.data;
  } catch (error) {
    console.error("Erreur lors de la récupération des articles", error);
  }
};

onMounted(() => {
  fetchAllPosts();
});

</script>

<style>
.home{
  width: 80%;
  display: flex;
  margin: auto;
}

</style>