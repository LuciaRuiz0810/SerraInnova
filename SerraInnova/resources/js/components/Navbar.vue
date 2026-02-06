<template>
    <header class="sticky top-0 z-50 w-full border-b border-leaf/10 bg-background-light/80 backdrop-blur-md dark:bg-background-dark/80 dark:border-white/10">
        <div class="mx-auto flex max-w-[1280px] items-center justify-between px-6 md:px-10 py-4">
            <div class="flex items-center gap-3">
                <img src="../../images/logo.png" alt="SerraInnova Logo" class="h-12 w-auto object-contain drop-shadow-md">
                <h2 class="text-xl font-extrabold tracking-tight text-forest dark:text-white hidden sm:block">SerraInnova</h2>
            </div>

            <!-- Desktop Navigation -->
            <nav class="hidden md:flex flex-1 justify-center gap-10">
                <router-link to="/" class="text-sm font-semibold hover:text-primary transition-colors">Inicio</router-link>
                
                <router-link to="/calculadora" class="text-sm font-semibold hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">calculate</span>
                    Calculadora
                </router-link>
                
                <!-- Panel Admin: solo para administradores -->
                <router-link v-if="user && user.tipo_usuario === 'administrador'" to="/admin" class="text-sm font-semibold hover:text-primary transition-colors flex items-center gap-1">
                    <span class="material-symbols-outlined text-sm">admin_panel_settings</span>
                    Panel Admin
                </router-link>

                <!-- Vender: solo para agentes -->
                <router-link v-if="user && user.tipo_usuario === 'agente'" to="/vender" class="text-sm font-semibold hover:text-primary transition-colors">Vender</router-link>
                
                <a href="#" class="text-sm font-semibold hover:text-primary transition-colors">Contacto</a>
            </nav>

            <div class="flex items-center gap-4">
                <!-- Botones de autenticación -->
                <template v-if="!user">
                    <router-link to="/login" class="hidden lg:flex items-center justify-center rounded-lg h-10 px-6 bg-primary text-forest text-sm font-bold transition-transform hover:scale-105 active:scale-95">
                        Iniciar Sesión
                    </router-link>
                    <router-link to="/register" class="hidden lg:flex items-center justify-center rounded-lg h-10 px-6 border-2 border-primary text-primary text-sm font-bold transition-transform hover:scale-105 active:scale-95">
                        Registrarse
                    </router-link>
                </template>
                
                <!-- Usuario autenticado -->
                <template v-else>
                    <div class="hidden lg:flex items-center gap-3">
                        <span class="text-sm font-semibold text-forest dark:text-white">
                            {{ user.tipo_usuario === 'administrador' ? 'Administrador' : (user.agente?.nombre || user.cliente?.nombre || 'Usuario') }}
                        </span>
                        <button @click="handleLogout" class="flex items-center justify-center rounded-lg h-10 px-6 bg-red-500/10 border-2 border-red-500/30 text-red-600 dark:text-red-400 text-sm font-bold transition-transform hover:scale-105 active:scale-95">
                            Cerrar Sesión
                        </button>
                    </div>
                    <router-link to="/perfil" class="hidden md:block size-10 rounded-full border-2 border-primary/20 bg-primary/20 flex items-center justify-center overflow-hidden hover:border-primary transition-all cursor-pointer">
                        <img v-if="user.foto_perfil" :src="user.foto_perfil" alt="Perfil" class="w-full h-full object-cover">
                        <span v-else class="material-symbols-outlined text-forest">person</span>
                    </router-link>
                </template>
                
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
                    
                    <router-link @click="closeMenu" to="/calculadora" class="text-sm font-semibold hover:text-primary transition-colors py-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-sm">calculate</span>
                        Calculadora de Impacto
                    </router-link>
                    
                    <!-- Vender: solo para agentes -->
                    <router-link v-if="user && user.tipo_usuario === 'agente'" @click="closeMenu" to="/vender" class="text-sm font-semibold hover:text-primary transition-colors py-2">Vender</router-link>
                    
                    <a @click="closeMenu" href="#" class="text-sm font-semibold hover:text-primary transition-colors py-2">Contacto</a>
                    <router-link @click="closeMenu" to="/nosotros" class="text-sm font-semibold hover:text-primary transition-colors py-2">Nosotros</router-link>
                    <router-link @click="closeMenu" to="/agentes" class="text-sm font-semibold hover:text-primary transition-colors py-2">Agentes</router-link>
                    
                    <!-- Botones móviles de autenticación -->
                    <template v-if="!user">
                        <router-link @click="closeMenu" to="/login" class="flex items-center justify-center rounded-lg h-10 px-6 bg-primary text-forest text-sm font-bold mt-2">
                            Iniciar Sesión
                        </router-link>
                        <router-link @click="closeMenu" to="/register" class="flex items-center justify-center rounded-lg h-10 px-6 border-2 border-primary text-primary text-sm font-bold">
                            Registrarse
                        </router-link>
                    </template>
                    <template v-else>
                        <div class="text-sm font-semibold text-forest dark:text-white py-2">
                            {{ user.tipo_usuario === 'administrador' ? 'Administrador' : (user.agente?.nombre || user.cliente?.nombre || 'Usuario') }}
                        </div>
                        <button @click="handleLogout" class="flex items-center justify-center rounded-lg h-10 px-6 bg-red-500/10 border-2 border-red-500/30 text-red-600 dark:text-red-400 text-sm font-bold">
                            Cerrar Sesión
                        </button>
                    </template>
                </nav>
            </div>
        </transition>
    </header>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();
const isMenuOpen = ref(false);
const user = ref(null);

const toggleMenu = () => {
    isMenuOpen.value = !isMenuOpen.value;
};

const closeMenu = () => {
    isMenuOpen.value = false;
};

const loadUser = () => {
    const storedUser = localStorage.getItem('user');
    if (storedUser) {
        user.value = JSON.parse(storedUser);
    }
    
    // Configurar token en axios si existe
    const token = localStorage.getItem('token');
    if (token) {
        axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
    }
};

const handleLogout = async () => {
    try {
        await axios.post('/logout');
    } catch (error) {
        console.error('Error al cerrar sesión:', error);
    } finally {
        // Limpiar localStorage
        localStorage.removeItem('token');
        localStorage.removeItem('user');
        delete axios.defaults.headers.common['Authorization'];
        
        // Recargar página y llevar al login
        window.location.href = '/login';
    }
};

onMounted(() => {
    loadUser();
});
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
