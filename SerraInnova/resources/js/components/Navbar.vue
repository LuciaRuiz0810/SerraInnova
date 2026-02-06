<template>
    <header class="sticky top-0 z-50 w-full border-b border-leaf/10 bg-background-light/80 backdrop-blur-md dark:bg-background-dark/80 dark:border-white/10">
        <div class="mx-auto flex max-w-[1280px] items-center justify-between px-6 md:px-10 py-4">
            <div class="flex items-center gap-2">
                <div class="text-primary">
                    <span class="material-symbols-outlined text-3xl">eco</span>
                </div>
                <h2 class="text-xl font-extrabold tracking-tight text-forest dark:text-white">SerraInnova</h2>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex flex-1 justify-center gap-10">
                <router-link to="/" class="text-sm font-semibold hover:text-primary transition-colors">Inicio</router-link>
                <router-link to="/propiedades" class="text-sm font-semibold hover:text-primary transition-colors">Comprar</router-link>
                <router-link to="/propiedades?operacion=alquiler" class="text-sm font-semibold hover:text-primary transition-colors">Alquilar</router-link>
                <router-link to="/calculadora" class="text-sm font-semibold hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">calculate</span>
                    Calculadora
                </router-link>
                <a href="#" class="text-sm font-semibold hover:text-primary transition-colors">Vender</a>
                <a href="#" class="text-sm font-semibold hover:text-primary transition-colors">Contacto</a>
            </nav>

            <div class="flex items-center gap-4">
                <button class="hidden lg:flex items-center justify-center rounded-lg h-10 px-6 bg-primary text-forest text-sm font-bold transition-transform hover:scale-105 active:scale-95">
                    Acceso
                </button>
                <div class="hidden md:block size-10 rounded-full border-2 border-primary/20 bg-cover bg-center" style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBXJAOYkDz1blBqopg1ol1goCnzyAEWQOpNH2lClZXDL96EjfpUNEr-BjVDh60rlWVA6KzBBPVmEy2E2SK4uLqYTHidvWpSiUhTx9Ve9iaJrcYRyj0U0tZ71DcZy2wAgR9-rA9DZytjJMPCL3eQGuaa_I000Yf6RfmoJTqfljGzdqXD9KkOXVuevt9pfBcixL0i3SyeG5_CrPV50JowzZBbeQOxU20-DfMURONOBWhgaeuI7MC3BhKyQFiQ0au9Jhyape3uXSmNsv4");'></div>
                
                <!-- Mobile Menu Button -->
                <button @click="toggleMenu" class="md:hidden flex items-center justify-center rounded-lg h-10 w-10 bg-primary/20 text-forest dark:text-white hover:bg-primary/30 transition-colors">
                    <span class="material-symbols-outlined">{{ isMenuOpen ? 'close' : 'menu' }}</span>
                </button>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <transition name="mobile-menu">
            <div v-if="isMenuOpen" class="md:hidden bg-background-light dark:bg-background-dark border-t border-leaf/10 dark:border-white/10">
                <nav class="flex flex-col px-6 py-4 space-y-4">
                    <router-link @click="closeMenu" to="/" class="text-sm font-semibold hover:text-primary transition-colors py-2">Inicio</router-link>
                    <router-link @click="closeMenu" to="/propiedades" class="text-sm font-semibold hover:text-primary transition-colors py-2">Comprar</router-link>
                    <router-link @click="closeMenu" to="/propiedades?operacion=alquiler" class="text-sm font-semibold hover:text-primary transition-colors py-2">Alquilar</router-link>
                    <router-link @click="closeMenu" to="/calculadora" class="text-sm font-semibold hover:text-primary transition-colors py-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">calculate</span>
                        Calculadora de Impacto
                    </router-link>
                    <a @click="closeMenu" href="#" class="text-sm font-semibold hover:text-primary transition-colors py-2">Vender</a>
                    <a @click="closeMenu" href="#" class="text-sm font-semibold hover:text-primary transition-colors py-2">Contacto</a>
                    <router-link @click="closeMenu" to="/nosotros" class="text-sm font-semibold hover:text-primary transition-colors py-2">Nosotros</router-link>
                    <router-link @click="closeMenu" to="/agentes" class="text-sm font-semibold hover:text-primary transition-colors py-2">Agentes</router-link>
                    <button class="flex items-center justify-center rounded-lg h-10 px-6 bg-primary text-forest text-sm font-bold mt-2">
                        Acceso
                    </button>
                </nav>
            </div>
        </transition>
    </header>
</template>

<script setup>
import { ref } from 'vue';

const isMenuOpen = ref(false);

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

const closeMenu = () => {
    isMenuOpen.value = false;
};
</script>

<style scoped>
.mobile-menu-enter-active,
.mobile-menu-leave-active {
    transition: all 0.3s ease;
}

.mobile-menu-enter-from {
    opacity: 0;
    transform: translateY(-10px);
}

.mobile-menu-leave-to {
    opacity: 0;
    transform: translateY(-10px);
}
</style>
