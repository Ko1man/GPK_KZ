<template>
    <header class="header">
        <div class="container">
            <div class="logo">
                <img src="/logo.png" alt="Логотип">
                <h1>Новости</h1>
            </div>
            <nav>
                <ul>
                    <li><RouterLink to="/">Главная</RouterLink></li>
                    <li><RouterLink to="/news">Новости</RouterLink></li>
                    <li><RouterLink to="/about">О нас</RouterLink></li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<script setup>
import {ref} from "vue";

const menuItems = ref([
    {name: "Главная", path: "/"},
    {name: "Новости", path: "/news"},
    {name: "О нас", path: "/about"}
]);
</script>

<style scoped>
.header {
    background: #42b983;
    padding: 15px 0;
    color: white;
}

.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

.logo {
    display: flex;
    align-items: center;
}

.logo img {
    width: 40px;
    margin-right: 10px;
}

nav ul {
    list-style: none;
    display: flex;
    gap: 15px;
}

nav a {
    color: white;
    text-decoration: none;
    font-weight: bold;
}
</style>
