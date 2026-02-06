<template>
    <div class="min-h-screen flex flex-col">
        <Navbar v-if="!hideNavAndFooter" />
        
        <!-- Contenido principal -->
        <main class="flex-grow">
            <!-- Router View con transición suave -->
            <router-view v-slot="{ Component }">
                <transition name="fade" mode="out-in">
                    <component :is="Component" />
                </transition>
            </router-view>
        </main>

        <Footer v-if="!hideNavAndFooter" />
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { useRoute } from 'vue-router';
import Navbar from './components/Navbar.vue';
import Footer from './components/Footer.vue';

const route = useRoute();

const hideNavAndFooter = computed(() => {
    return ['Welcome', 'Login', 'Register'].includes(route.name);
});
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