<template>
    <div class="min-h-screen organic-bg px-4 py-12">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="mb-12 text-center">
                <span class="inline-block p-4 rounded-full bg-forest/10 dark:bg-white/10 mb-4 backdrop-blur-sm border border-forest/20">
                    <span class="material-symbols-outlined text-4xl text-forest dark:text-primary">admin_panel_settings</span>
                </span>
                <h1 class="text-4xl font-black text-forest dark:text-white mb-4">Panel de Administración</h1>
                <p class="text-xl text-leaf font-medium">Gestión y control de SerraInnova</p>
            </div>

            <!-- Dashboard Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                
                <!-- Stat Card: Usuarios -->
                <div class="glass-effect dark:glass-effect-dark rounded-3xl p-8 hover:transform hover:scale-105 transition-all duration-300 border-2 border-transparent hover:border-primary/30">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-blue-100 dark:bg-blue-900/30 rounded-xl text-blue-600 dark:text-blue-400">
                            <span class="material-symbols-outlined text-3xl">group</span>
                        </div>
                        <h3 class="text-2xl font-bold text-forest dark:text-white">Usuarios</h3>
                    </div>
                    <p class="text-4xl font-black text-forest dark:text-white mb-2">
                        <span v-if="loading" class="text-2xl animate-pulse">...</span>
                        <span v-else>{{ stats.usuarios }}</span>
                    </p>
                    <p class="text-leaf text-sm">Registrados totales</p>
                </div>

                <!-- Stat Card: Propiedades -->
                <div class="glass-effect dark:glass-effect-dark rounded-3xl p-8 hover:transform hover:scale-105 transition-all duration-300 border-2 border-transparent hover:border-primary/30">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-green-100 dark:bg-green-900/30 rounded-xl text-green-600 dark:text-green-400">
                            <span class="material-symbols-outlined text-3xl">home_work</span>
                        </div>
                        <h3 class="text-2xl font-bold text-forest dark:text-white">Propiedades</h3>
                    </div>
                    <p class="text-4xl font-black text-forest dark:text-white mb-2">
                         <span v-if="loading" class="text-2xl animate-pulse">...</span>
                         <span v-else>{{ stats.propiedades }}</span>
                    </p>
                    <p class="text-leaf text-sm">Activas en venta</p>
                </div>

                <!-- Stat Card: Ventas -->
                <div class="glass-effect dark:glass-effect-dark rounded-3xl p-8 hover:transform hover:scale-105 transition-all duration-300 border-2 border-transparent hover:border-primary/30">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="p-3 bg-yellow-100 dark:bg-yellow-900/30 rounded-xl text-yellow-600 dark:text-yellow-400">
                            <span class="material-symbols-outlined text-3xl">payments</span>
                        </div>
                        <h3 class="text-2xl font-bold text-forest dark:text-white">Ventas</h3>
                    </div>
                    <p class="text-4xl font-black text-forest dark:text-white mb-2">
                         <span v-if="loading" class="text-2xl animate-pulse">...</span>
                         <span v-else>{{ stats.ventas }}</span>
                    </p>
                    <p class="text-leaf text-sm">Cerradas histórico</p>
                </div>

            </div>

             <!-- Quick Actions -->
             <div class="mt-12">
                <h2 class="text-2xl font-bold text-forest dark:text-white mb-6 pl-4 border-l-4 border-primary">Acciones Rápidas</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                    <router-link to="/admin/propiedades" class="flex items-center gap-3 p-4 bg-white/50 dark:bg-background-dark/50 rounded-xl border-2 border-leaf/10 hover:border-primary/50 hover:bg-white/80 transition-all text-left group">
                        <span class="material-symbols-outlined text-forest dark:text-primary group-hover:scale-110 transition-transform">add_business</span>
                        <span class="font-bold text-forest dark:text-white">Gestión Propiedades</span>
                    </router-link>
                    
                    <router-link to="/admin/agentes" class="flex items-center gap-3 p-4 bg-white/50 dark:bg-background-dark/50 rounded-xl border-2 border-leaf/10 hover:border-primary/50 hover:bg-white/80 transition-all text-left group">
                        <span class="material-symbols-outlined text-forest dark:text-primary group-hover:scale-110 transition-transform">groups</span>
                        <span class="font-bold text-forest dark:text-white">Gestión Agentes</span>
                    </router-link>

                    <router-link to="/admin/usuarios" class="flex items-center gap-3 p-4 bg-white/50 dark:bg-background-dark/50 rounded-xl border-2 border-leaf/10 hover:border-primary/50 hover:bg-white/80 transition-all text-left group">
                        <span class="material-symbols-outlined text-forest dark:text-primary group-hover:scale-110 transition-transform">manage_accounts</span>
                        <span class="font-bold text-forest dark:text-white">Gestión Usuarios</span>
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const stats = ref({
    usuarios: 0,
    propiedades: 0,
    ventas: 0
});
const loading = ref(true);

const fetchStats = async () => {
    try {
        const { data } = await axios.get('/admin/stats');
        stats.value = data;
    } catch (error) {
        console.error('Error cargando estadísticas:', error);
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchStats();
});
</script>
