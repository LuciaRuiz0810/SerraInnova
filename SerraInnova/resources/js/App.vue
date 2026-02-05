<template>
    <div class="min-h-screen flex flex-col">
        <Navbar />
        
        <!-- Contenido principal -->
        <main class="flex-grow">
            <!-- Router View con transición suave -->
            <router-view v-slot="{ Component }">
                <transition name="fade" mode="out-in">
                    <component :is="Component" />
                </transition>
            </router-view>
        </main>

        <Footer />
    </div>
</template>

<script setup>
import Navbar from './components/Navbar.vue';
import Footer from './components/Footer.vue';
</script>

<style>
/* Transiciones de página */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>