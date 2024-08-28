// import { createRouter, createWebHistory } from 'vue-router'
import AllArticles from "../views/AllArticles.vue"
import ArticleDetail from "../views/ArticleDetail.vue"
import Register from "../views/Register.vue"
import Login from "../views/Login.vue"
import * as VueRouter from 'vue-router'
import Dashboard from "../views/Dashboard.vue"
import CreateUpdateArticle from "@/views/CreateUpdateArticle.vue"


const router = VueRouter.createRouter({
  history: VueRouter.createWebHistory(),
  routes: [
    {
      path: '/',
      name: 'accueil',
      component: AllArticles
    },
    {
      path: '/ArticleDetail/:id',
      name: 'ArticleDetail',
      component: ArticleDetail
    },
    {
      path: '/Login',
      name: 'Login',
      component: Login
    },
    {
      path: '/Register',
      name: 'Register',
      component: Register
    },
    {
      path: '/Dashboard',
      name: 'Dashboard',
      component: Dashboard
    },
    {
      path: '/Dashboard/article/:type/:id?',
      name: 'CreateUpdateArticle',
      component: CreateUpdateArticle
    }
]
})

export default router
