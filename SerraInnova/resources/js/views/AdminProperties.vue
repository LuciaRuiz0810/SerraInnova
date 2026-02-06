<template>
    <div class="min-h-screen organic-bg px-4 py-12">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-8">
                <div>
                    <h1 class="text-4xl font-black text-forest dark:text-white mb-2">Gestión de Inmuebles</h1>
                    <p class="text-xl text-leaf font-medium">Administra el catálogo de propiedades</p>
                </div>
                <router-link to="/admin/propiedades/create" class="flex items-center gap-2 bg-primary hover:bg-primary/90 text-forest font-bold py-3 px-6 rounded-xl transition-transform hover:scale-105 shadow-lg shadow-primary/20">
                    <span class="material-symbols-outlined">add_home</span>
                    Nueva Propiedad
                </router-link>
            </div>

            <!-- Loading State -->
            <div v-if="loading" class="flex justify-center py-20">
                <div class="animate-spin rounded-full h-16 w-16 border-t-4 border-b-4 border-primary"></div>
            </div>

            <!-- Error State -->
            <div v-else-if="error" class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-8 rounded shadow-sm" role="alert">
                <p class="font-bold">Error</p>
                <p>{{ error }}</p>
            </div>

            <!-- Empty State -->
            <div v-else-if="properties.length === 0" class="text-center py-20 bg-white/50 dark:bg-black/20 rounded-3xl border-2 border-dashed border-gray-300 dark:border-gray-700">
                <span class="material-symbols-outlined text-6xl text-gray-400 mb-4">home_work</span>
                <p class="text-2xl font-bold text-gray-500">No hay propiedades registradas</p>
                <router-link to="/admin/propiedades/create" class="text-primary hover:underline font-bold mt-2 inline-block">
                    Crear la primera propiedad
                </router-link>
            </div>

            <!-- Properties Table -->
            <div v-else class="glass-effect dark:glass-effect-dark rounded-3xl overflow-hidden shadow-2xl border border-white/20">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead class="bg-forest/5 dark:bg-white/5 border-b border-forest/10 dark:border-white/10">
                            <tr>
                                <th class="p-6 font-bold text-forest dark:text-white">Propiedad</th>
                                <th class="p-6 font-bold text-forest dark:text-white hidden md:table-cell">Precio</th>
                                <th class="p-6 font-bold text-forest dark:text-white hidden lg:table-cell">Estado</th>
                                <th class="p-6 font-bold text-forest dark:text-white text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-forest/10 dark:divide-white/10">
                            <tr v-for="property in properties" :key="property.id_propiedad" class="hover:bg-forest/5 dark:hover:bg-white/5 transition-colors">
                                <td class="p-6">
                                    <div class="flex items-center gap-4">
                                        <div class="w-16 h-16 rounded-xl overflow-hidden bg-gray-200 shrink-0">
                                            <img :src="getMainImage(property)" alt="Propiedad" class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <h3 class="font-bold text-forest dark:text-white text-lg line-clamp-1">{{ property.titulo }}</h3>
                                            <p class="text-sm text-leaf line-clamp-1">{{ property.ciudad }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-6 font-bold text-forest dark:text-white hidden md:table-cell">
                                    {{ formatPrice(property) }}
                                </td>
                                <td class="p-6 hidden lg:table-cell">
                                    <span :class="getStatusClass(property.estado)" class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider">
                                        {{ property.estado }}
                                    </span>
                                </td>
                                <td class="p-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <router-link :to="`/admin/propiedades/${property.id_propiedad}/edit`" class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors" title="Editar">
                                            <span class="material-symbols-outlined">edit</span>
                                        </router-link>
                                        <button @click="confirmDelete(property)" class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-colors" title="Eliminar">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const properties = ref([]);
const loading = ref(true);
const error = ref('');

const fetchProperties = async () => {
    try {
        loading.value = true;
        // Ahora usamos el endpoint específico de admin que es seguro y devuelve todo
        const response = await axios.get('/admin/propiedades');
        properties.value = response.data;
    } catch (err) {
        console.error(err);
        error.value = `Error: ${err.response?.status || ''} - ${err.response?.data?.message || err.message}`;
    } finally {
        loading.value = false;
    }
};

const getMainImage = (property) => {
    if (property.imagenes && property.imagenes.length > 0) {
        return property.imagenes[0].url;
    }
    // Fallback to legacy fotos
    if (property.fotos && property.fotos.length > 0) {
        try {
            const fotos = typeof property.fotos === 'string' ? JSON.parse(property.fotos) : property.fotos;
            return fotos[0] || '/images/placeholder-property.jpg';
        } catch (e) { return '/images/placeholder-property.jpg'; }
    }
    return '/images/placeholder-property.jpg';
};

const formatPrice = (property) => {
    if (property.tipo_operacion === 'venta' || property.tipo_operacion === 'ambos') {
        return new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR' }).format(property.precio_venta || 0);
    }
    return new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR' }).format(property.precio_alquiler || 0) + '/mes';
};

const getStatusClass = (status) => {
    switch (status) {
        case 'disponible': return 'bg-green-100 text-green-700';
        case 'reservado': return 'bg-yellow-100 text-yellow-700';
        case 'vendido': return 'bg-red-100 text-red-700';
        case 'alquilado': return 'bg-blue-100 text-blue-700';
        default: return 'bg-gray-100 text-gray-700';
    }
};

const confirmDelete = async (property) => {
    if (confirm(`¿Estás seguro de que quieres eliminar "${property.titulo}"? Esta acción no se puede deshacer.`)) {
        try {
            await axios.delete(`/propiedades/${property.id_propiedad}`);
            properties.value = properties.value.filter(p => p.id_propiedad !== property.id_propiedad);
            alert('Propiedad eliminada correctamente');
        } catch (err) {
            console.error(err);
            alert('Error al eliminar la propiedad');
        }
    }
};

onMounted(() => {
    fetchProperties();
});
</script>
