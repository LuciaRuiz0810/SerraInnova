<template>
    <header class="sticky top-0 z-50 w-full border-b border-leaf/10 bg-background-light/80 backdrop-blur-md dark:bg-background-dark/80 dark:border-white/10">
        <div class="mx-auto max-w-[1400px] px-6 md:px-10 py-4">
            <div class="flex items-center justify-between gap-8">
                <!-- Logo a la izquierda -->
                <router-link to="/" class="flex items-center gap-3 flex-shrink-0">
                    <img :src="logoImage" alt="SerraInnova Logo" class="h-15 w-15 object-cover rounded-xl drop-shadow-md">
                    <h2 class="text-xl font-extrabold tracking-tight text-forest dark:text-white hidden sm:block">SerraInnova</h2>
                </router-link>

            <!-- Desktop Navigation -->
            <nav class="hidden xl:flex flex-1 justify-center items-center gap-1">
                <!-- Páginas principales -->
                <router-link to="/" class="px-3 py-2 text-sm font-semibold hover:text-primary transition-colors rounded-lg hover:bg-primary/5">
                    Inicio
                </router-link>
                
                <router-link to="/propiedades" class="px-3 py-2 text-sm font-semibold hover:text-primary transition-colors rounded-lg hover:bg-primary/5">
                    Propiedades
                </router-link>
                
                <router-link to="/servicios" class="px-3 py-2 text-sm font-semibold hover:text-primary transition-colors rounded-lg hover:bg-primary/5">
                    Servicios
                </router-link>
                
                <!-- Separador visual -->
                <div class="h-6 w-px bg-leaf/20 dark:bg-white/10 mx-2"></div>
                
                <!-- Herramientas -->
                <router-link to="/calculadora" class="px-3 py-2 text-sm font-semibold hover:text-primary transition-colors rounded-lg hover:bg-primary/5 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-base">calculate</span>
                    Calculadora
                </router-link>
                
                <router-link to="/blog" class="px-3 py-2 text-sm font-semibold hover:text-primary transition-colors rounded-lg hover:bg-primary/5 flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-base">article</span>
                    Blog
                </router-link>
                
                <!-- Separador visual -->
                <div v-if="user && (user.tipo_usuario === 'administrador' || user.tipo_usuario === 'agente')" class="h-6 w-px bg-leaf/20 dark:bg-white/10 mx-2"></div>
                
                <!-- Panel Admin: solo para administradores -->
                <router-link v-if="user && user.tipo_usuario === 'administrador'" 
                             to="/admin" 
                             class="px-3 py-2 text-sm font-bold bg-forest/10 dark:bg-primary/10 text-forest dark:text-primary hover:bg-forest/20 dark:hover:bg-primary/20 transition-all rounded-lg flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-base">admin_panel_settings</span>
                    Admin
                </router-link>

                <!-- Vender: solo para agentes -->
                <router-link v-if="user && user.tipo_usuario === 'agente'" 
                             to="/vender" 
                             class="px-3 py-2 text-sm font-bold bg-primary/10 text-primary hover:bg-primary/20 transition-all rounded-lg flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-base">sell</span>
                    Vender
                </router-link>
                
                <!-- Separador visual -->
                <div class="h-6 w-px bg-leaf/20 dark:bg-white/10 mx-2"></div>
                
                <!-- Información -->
                <router-link to="/nosotros" class="px-3 py-2 text-sm font-semibold hover:text-primary transition-colors rounded-lg hover:bg-primary/5">
                    Nosotros
                </router-link>
                
                <router-link to="/contacto" class="px-3 py-2 text-sm font-semibold hover:text-primary transition-colors rounded-lg hover:bg-primary/5">
                    Contacto
                </router-link>
            </nav>

            <div class="flex items-center gap-4">
                <!-- Botones de autenticación -->
                <template v-if="!user">
                    <router-link to="/login" class="hidden xl:flex items-center justify-center rounded-lg h-10 px-6 bg-primary text-forest text-sm font-bold transition-transform hover:scale-105 active:scale-95">
                        Iniciar Sesión
                    </router-link>
                    <router-link to="/register" class="hidden xl:flex items-center justify-center rounded-lg h-10 px-6 border-2 border-primary text-primary text-sm font-bold transition-transform hover:scale-105 active:scale-95">
                        Registrarse
                    </router-link>
                </template>
                
                <!-- Usuario autenticado -->
                <template v-else>
                    <div class="hidden xl:flex items-center gap-3">
                        <span class="text-sm font-semibold text-forest dark:text-white">
                            {{ user.tipo_usuario === 'administrador' ? 'Administrador' : (user.agente?.nombre || user.cliente?.nombre || 'Usuario') }}
                        </span>
                        <button @click="handleLogout" class="flex items-center justify-center rounded-lg h-10 px-6 bg-red-500/10 border-2 border-red-500/30 text-red-600 dark:text-red-400 text-sm font-bold transition-transform hover:scale-105 active:scale-95">
                            Cerrar Sesión
                        </button>
                    </div>
                    <router-link to="/perfil" class="hidden xl:block size-10 rounded-full border-2 border-primary/20 bg-primary/20 flex items-center justify-center overflow-hidden hover:border-primary transition-all cursor-pointer">
                        <img v-if="user.foto_perfil" :src="user.foto_perfil" alt="Perfil" class="w-full h-full object-cover">
                        <span v-else class="material-symbols-outlined text-forest">person</span>
                    </router-link>
                </template>
                
                <!-- Mobile Menu Button -->
                <button @click="toggleMenu" class="xl:hidden flex items-center justify-center rounded-lg h-10 w-10 bg-primary/20 text-forest dark:text-white hover:bg-primary/30 transition-colors">
                    <span class="material-symbols-outlined">{{ isMenuOpen ? 'close' : 'menu' }}</span>
                </button>
            </div>
            </div>
        </div>

        <!-- Mobile Navigation Menu -->
        <transition name="mobile-menu">
            <div v-if="isMenuOpen" class="xl:hidden bg-background-light dark:bg-background-dark border-t border-leaf/10 dark:border-white/10">
                <nav class="flex flex-col px-6 py-4 space-y-1">
                    <!-- Páginas principales -->
                    <div class="text-xs font-bold text-leaf/60 dark:text-white/40 uppercase tracking-wider mb-2 mt-2">
                        Navegación
                    </div>
                    <router-link @click="closeMenu" to="/" class="px-3 py-2.5 text-sm font-semibold hover:text-primary hover:bg-primary/5 transition-all rounded-lg">
                        Inicio
                    </router-link>
                    
                    <router-link @click="closeMenu" to="/propiedades" class="px-3 py-2.5 text-sm font-semibold hover:text-primary hover:bg-primary/5 transition-all rounded-lg">
                        Propiedades
                    </router-link>
                    
                    <router-link @click="closeMenu" to="/servicios" class="px-3 py-2.5 text-sm font-semibold hover:text-primary hover:bg-primary/5 transition-all rounded-lg">
                        Servicios
                    </router-link>
                    
                    <!-- Herramientas -->
                    <div class="text-xs font-bold text-leaf/60 dark:text-white/40 uppercase tracking-wider mb-2 mt-4">
                        Herramientas
                    </div>
                    <router-link @click="closeMenu" to="/calculadora" class="px-3 py-2.5 text-sm font-semibold hover:text-primary hover:bg-primary/5 transition-all rounded-lg flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">calculate</span>
                        Calculadora de Impacto
                    </router-link>
                    
                    <router-link @click="closeMenu" to="/blog" class="px-3 py-2.5 text-sm font-semibold hover:text-primary hover:bg-primary/5 transition-all rounded-lg flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">article</span>
                        Blog
                    </router-link>
                    
                    <!-- Panel Admin / Vender -->
                    <template v-if="user && (user.tipo_usuario === 'administrador' || user.tipo_usuario === 'agente')">
                        <div class="text-xs font-bold text-leaf/60 dark:text-white/40 uppercase tracking-wider mb-2 mt-4">
                            Panel
                        </div>
                        
                        <!-- Panel Admin: solo para administradores -->
                        <router-link v-if="user.tipo_usuario === 'administrador'" 
                                     @click="closeMenu" 
                                     to="/admin" 
                                     class="px-3 py-2.5 text-sm font-bold bg-forest/10 dark:bg-primary/10 text-forest dark:text-primary hover:bg-forest/20 dark:hover:bg-primary/20 transition-all rounded-lg flex items-center gap-2">
                            <span class="material-symbols-outlined text-base">admin_panel_settings</span>
                            Panel Admin
                        </router-link>
                        
                        <!-- Vender: solo para agentes -->
                        <router-link v-if="user.tipo_usuario === 'agente'" 
                                     @click="closeMenu" 
                                     to="/vender" 
                                     class="px-3 py-2.5 text-sm font-bold bg-primary/10 text-primary hover:bg-primary/20 transition-all rounded-lg flex items-center gap-2">
                            <span class="material-symbols-outlined text-base">sell</span>
                            Vender Propiedad
                        </router-link>
                    </template>
                    
                    <!-- Información -->
                    <div class="text-xs font-bold text-leaf/60 dark:text-white/40 uppercase tracking-wider mb-2 mt-4">
                        Información
                    </div>
                    <router-link @click="closeMenu" to="/nosotros" class="px-3 py-2.5 text-sm font-semibold hover:text-primary hover:bg-primary/5 transition-all rounded-lg">
                        Nosotros
                    </router-link>
                    
                    <router-link @click="closeMenu" to="/contacto" class="px-3 py-2.5 text-sm font-semibold hover:text-primary hover:bg-primary/5 transition-all rounded-lg">
                        Contacto
                    </router-link>
                    
                    <!-- Botones móviles de autenticación -->
                    <div class="border-t border-leaf/10 dark:border-white/10 mt-4 pt-4">
                        <template v-if="!user">
                            <router-link @click="closeMenu" to="/login" class="flex items-center justify-center rounded-lg h-11 px-6 bg-primary text-forest text-sm font-bold mb-2 hover:scale-[1.02] transition-transform">
                                Iniciar Sesión
                            </router-link>
                            <router-link @click="closeMenu" to="/register" class="flex items-center justify-center rounded-lg h-11 px-6 border-2 border-primary text-primary text-sm font-bold hover:scale-[1.02] transition-transform">
                                Registrarse
                            </router-link>
                        </template>
                        <template v-else>
                            <div class="px-3 py-2 text-sm font-semibold text-forest dark:text-white bg-primary/5 rounded-lg mb-2 flex items-center gap-2">
                                <span class="material-symbols-outlined text-base">person</span>
                                {{ user.tipo_usuario === 'administrador' ? 'Administrador' : (user.agente?.nombre || user.cliente?.nombre || 'Usuario') }}
                            </div>
                            <router-link @click="closeMenu" to="/perfil" class="flex items-center justify-center rounded-lg h-11 px-6 bg-primary/10 text-primary text-sm font-bold mb-2 hover:bg-primary/20 transition-all">
                                <span class="material-symbols-outlined text-base mr-2">account_circle</span>
                                Mi Perfil
                            </router-link>
                            <button @click="handleLogout" class="w-full flex items-center justify-center rounded-lg h-11 px-6 bg-red-500/10 border-2 border-red-500/30 text-red-600 dark:text-red-400 text-sm font-bold hover:bg-red-500/20 transition-all">
                                <span class="material-symbols-outlined text-base mr-2">logout</span>
                                Cerrar Sesión
                            </button>
                        </template>
                    </div>
                </nav>
            </div>
        </transition>
    </header>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';
import logoImage from '../images/logo.png';

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