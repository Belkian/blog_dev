<template>
    <nav class="navbar">
        <div class="navbar-left">
            <img src="../assets/media/Vector.png" alt="Logo" class="logo">
        </div>
        <div class="navbar-right">
            <RouterLink to="/"><button class="nav-button">Accueil</button></RouterLink>
            <!-- <div v-if="isAuthenticated">
                <RouterLink to="/logout"><button class="nav-button">Déconnexion</button></RouterLink>
            </div> -->
            <!-- <div v-else> -->
                <RouterLink to="/login"><button class="nav-button">Connexion</button></RouterLink>
            <!-- </div> -->
        </div>
    </nav>
</template>

<script setup>
function isAuthenticated() {
    return !!localStorage.getItem('user-token')
}
</script>

<style scoped>
.navbar {
    margin-bottom: 30px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 1rem;
    background-color: #f8f9fa;
}

.navbar-right {
    width: 48%;
}
.nav-button{
    margin: 0 5px;
}
.navbar-left {
    width: 50%;
    flex: 1;
    display: flex;
    justify-content: end;
}

.logo {
    height: 40px;
    width: auto;
}

.nav-button {
    padding: 0.5rem 1rem;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.nav-button:hover {
    background-color: #0056b3;
}

.navbar-left {
    text-align: left;
}

.navbar-right {
    text-align: right;
}
</style>