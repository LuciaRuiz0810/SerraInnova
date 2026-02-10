<template>
    <div class="min-h-screen organic-bg px-4 py-12">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-black text-forest dark:text-white flex items-center gap-3">
                        <span class="material-symbols-outlined text-4xl">article</span>
                        Gestión de Artículos
                    </h1>
                    <p class="text-leaf">Administra el blog de normativa y sostenibilidad</p>
                </div>
                <router-link to="/admin/blog/create" class="bg-primary hover:bg-primary-dark text-forest font-bold py-3 px-6 rounded-xl flex items-center gap-2 transition-all shadow-lg hover:shadow-primary/50">
                    <span class="material-symbols-outlined">add</span>
                    Nuevo Artículo
                </router-link>
            </div>

            <!-- Error/Success Messages -->
            <div v-if="error" class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg flex items-center gap-2">
                <span class="material-symbols-outlined">error</span>
                {{ error }}
            </div>

            <!-- Loading State -->
            <div v-if="loading" class="flex justify-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary"></div>
            </div>

            <!-- Articles Table -->
            <div v-else class="glass-effect dark:glass-effect-dark rounded-3xl overflow-hidden shadow-xl border border-white/20">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-forest/5 dark:bg-white/5 border-b border-leaf/10 text-left">
                            <tr>
                                <th class="p-4 text-forest dark:text-white font-bold">Título</th>
                                <th class="p-4 text-forest dark:text-white font-bold">Categoría</th>
                                <th class="p-4 text-forest dark:text-white font-bold">Estado</th>
                                <th class="p-4 text-forest dark:text-white font-bold">Fecha</th>
                                <th class="p-4 text-forest dark:text-white font-bold text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="articulo in articulos.data" :key="articulo.id" class="border-b border-leaf/5 hover:bg-white/50 dark:hover:bg-white/5 transition-colors">
                                <td class="p-4">
                                    <div>
                                        <p class="font-bold text-forest dark:text-white">{{ articulo.titulo }}</p>
                                        <p class="text-xs text-leaf line-clamp-1">{{ articulo.extracto }}</p>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span class="inline-block px-3 py-1 rounded-full text-xs font-bold"
                                          :class="getCategoriaClass(articulo.categoria)">
                                        {{ getCategoriaLabel(articulo.categoria) }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <span v-if="articulo.publicado" class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                                        Publicado
                                    </span>
                                    <span v-else class="inline-block px-3 py-1 bg-gray-100 text-gray-800 rounded-full text-xs font-bold">
                                        Borrador
                                    </span>
                                </td>
                                <td class="p-4 text-forest dark:text-gray-300 text-sm">
                                    {{ formatearFecha(articulo.fecha_publicacion) }}
                                </td>
                                <td class="p-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <router-link :to="`/admin/blog/${articulo.id}/edit`" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Editar">
                                            <span class="material-symbols-outlined">edit</span>
                                        </router-link>
                                        <button @click="confirmDelete(articulo)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Eliminar">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div v-if="articulos.data && articulos.last_page > 1" class="p-4 flex justify-center gap-2 border-t border-leaf/10">
                    <button @click="cambiarPagina(paginaActual - 1)" 
                            :disabled="paginaActual === 1"
                            :class="paginaActual === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-primary/20'"
                            class="px-4 py-2 rounded-lg border-2 border-leaf/20 text-forest dark:text-white font-semibold transition-all">
                        Anterior
                    </button>
                    
                    <span class="px-4 py-2 text-forest dark:text-white font-semibold">
                        Página {{ paginaActual }} de {{ articulos.last_page }}
                    </span>

                    <button @click="cambiarPagina(paginaActual + 1)" 
                            :disabled="paginaActual === articulos.last_page"
                            :class="paginaActual === articulos.last_page ? 'opacity-50 cursor-not-allowed' : 'hover:bg-primary/20'"
                            class="px-4 py-2 rounded-lg border-2 border-leaf/20 text-forest dark:text-white font-semibold transition-all">
                        Siguiente
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, watch } from 'vue';
import axios from 'axios';

const articulos = ref({ data: [] });
const loading = ref(true);
const error = ref('');
const paginaActual = ref(1);

const fetchArticulos = async () => {
    loading.value = true;
    error.value = '';
    try {
        const { data } = await axios.get('/admin/articulos', {
            params: { page: paginaActual.value }
        });
        articulos.value = data;
    } catch (err) {
        console.error(err);
        error.value = err.response?.data?.message || 'Error al cargar artículos';
    } finally {
        loading.value = false;
    }
};

const confirmDelete = async (articulo) => {
    if (!confirm(`¿Estás seguro de eliminar "${articulo.titulo}"?`)) return;
    
    try {
        await axios.delete(`/articulos/${articulo.id}`);
        fetchArticulos(); // Reload list
    } catch (err) {
        alert('Error al eliminar artículo: ' + (err.response?.data?.message || err.message));
    }
};

const getCategoriaLabel = (categoria) => {
    const labels = {
        ahorro_energetico: 'Ahorro Energético',
        subvenciones: 'Subvenciones',
        agenda_2030: 'Agenda 2030',
        domotica_verde: 'Domótica Verde',
        general: 'General'
    };
    return labels[categoria] || categoria;
};

const getCategoriaClass = (categoria) => {
    const classes = {
        ahorro_energetico: 'bg-yellow-100 text-yellow-800',
        subvenciones: 'bg-green-100 text-green-800',
        agenda_2030: 'bg-blue-100 text-blue-800',
        domotica_verde: 'bg-purple-100 text-purple-800',
        general: 'bg-gray-100 text-gray-800'
    };
    return classes[categoria] || 'bg-gray-100 text-gray-800';
};

const formatearFecha = (fecha) => {
    if (!fecha) return 'Sin publicar';
    const date = new Date(fecha);
    return date.toLocaleDateString('es-ES', { day: '2-digit', month: 'short', year: 'numeric' });
};

const cambiarPagina = (pagina) => {
    paginaActual.value = pagina;
};

watch(paginaActual, () => {
    fetchArticulos();
});

onMounted(() => {
    fetchArticulos();
});
</script>
