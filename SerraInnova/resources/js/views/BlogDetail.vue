<template>
    <main class="organic-bg min-h-screen">
        <!-- Loading State -->
        <div v-if="cargando" class="px-4 py-20 md:px-10 lg:px-20">
            <div class="mx-auto max-w-[900px]">
                <div class="animate-pulse space-y-8">
                    <div class="h-8 bg-gray-300 dark:bg-gray-700 rounded w-3/4"></div>
                    <div class="h-96 bg-gray-300 dark:bg-gray-700 rounded"></div>
                    <div class="space-y-4">
                        <div class="h-4 bg-gray-300 dark:bg-gray-700 rounded"></div>
                        <div class="h-4 bg-gray-300 dark:bg-gray-700 rounded"></div>
                        <div class="h-4 bg-gray-300 dark:bg-gray-700 rounded w-5/6"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Article Content -->
        <article v-else-if="articulo" class="px-4 py-12 md:px-10 lg:px-20">
            <div class="mx-auto max-w-[900px]">
                <!-- Back Button -->
                <button @click="$router.push('/blog')" 
                        class="flex items-center gap-2 text-leaf dark:text-white/70 hover:text-primary dark:hover:text-primary transition-colors mb-8 font-semibold">
                    <span class="material-symbols-outlined">arrow_back</span>
                    <span>Volver al blog</span>
                </button>

                <!-- Category Badge -->
                <div class="mb-6">
                    <span class="bg-primary text-forest text-sm font-bold px-4 py-2 rounded-full shadow-lg">
                        {{ getCategoriaLabel(articulo.categoria) }}
                    </span>
                </div>

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl font-black text-forest dark:text-white mb-6 leading-tight">
                    {{ articulo.titulo }}
                </h1>

                <!-- Meta Info -->
                <div class="flex flex-wrap items-center gap-6 text-sm text-leaf dark:text-white/60 mb-8 pb-8 border-b-2 border-leaf/10">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined">calendar_today</span>
                        <span>{{ formatearFecha(articulo.fecha_publicacion) }}</span>
                    </div>
                    <div v-if="articulo.autor" class="flex items-center gap-2">
                        <span class="material-symbols-outlined">person</span>
                        <span>{{ getAutorNombre(articulo.autor) }}</span>
                    </div>
                </div>

                <!-- Featured Image -->
                <div v-if="articulo.imagen_destacada" class="mb-12 rounded-3xl overflow-hidden shadow-2xl">
                    <img :src="articulo.imagen_destacada" 
                         :alt="articulo.titulo"
                         class="w-full h-auto">
                </div>

                <!-- Excerpt -->
                <div v-if="articulo.extracto" class="bg-primary/10 dark:bg-primary/5 rounded-2xl p-6 md:p-8 mb-12 border-l-4 border-primary">
                    <p class="text-lg md:text-xl text-forest dark:text-white font-medium italic">
                        {{ articulo.extracto }}
                    </p>
                </div>

                <!-- Article Content -->
                <div class="prose prose-lg dark:prose-invert max-w-none mb-16
                            prose-headings:font-black prose-headings:text-forest dark:prose-headings:text-white
                            prose-h2:text-3xl prose-h2:mt-12 prose-h2:mb-6
                            prose-h3:text-2xl prose-h3:mt-8 prose-h3:mb-4
                            prose-p:text-leaf dark:prose-p:text-white/80 prose-p:leading-relaxed
                            prose-li:text-leaf dark:prose-li:text-white/80
                            prose-a:text-primary prose-a:font-semibold hover:prose-a:underline
                            prose-strong:text-forest dark:prose-strong:text-white
                            prose-ul:my-6 prose-ol:my-6"
                     v-html="articulo.contenido">
                </div>

                <!-- Share Section -->
                <div class="bg-sand dark:bg-background-dark/40 rounded-3xl p-8 mb-16">
                    <h3 class="text-2xl font-bold text-forest dark:text-white mb-4">
                        ¿Te ha resultado útil?
                    </h3>
                    <p class="text-leaf dark:text-white/70 mb-6">
                        Comparte este artículo para ayudar a más personas a vivir de forma sostenible
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <button class="flex items-center gap-2 bg-white dark:bg-background-dark px-6 py-3 rounded-xl font-semibold text-forest dark:text-white hover:bg-primary hover:text-forest transition-all shadow-lg hover:scale-105">
                            <span class="material-symbols-outlined">share</span>
                            <span>Compartir</span>
                        </button>
                    </div>
                </div>

                <!-- Back to Blog -->
                <div class="text-center">
                    <button @click="$router.push('/blog')" 
                            class="bg-gradient-to-r from-forest to-leaf text-primary font-bold py-4 px-8 rounded-xl hover:shadow-2xl hover:scale-105 transition-all duration-300">
                        Ver más artículos
                    </button>
                </div>
            </div>
        </article>

        <!-- Error State -->
        <div v-else class="px-4 py-20 md:px-10 lg:px-20 text-center">
            <span class="material-symbols-outlined text-6xl text-leaf/30 dark:text-white/20 mb-4">error</span>
            <h2 class="text-2xl font-bold text-forest dark:text-white mb-4">Artículo no encontrado</h2>
            <p class="text-leaf dark:text-white/70 mb-8">El artículo que buscas no existe o ha sido eliminado</p>
            <button @click="$router.push('/blog')" 
                    class="bg-primary text-forest font-bold py-3 px-6 rounded-xl hover:scale-105 transition-all">
                Volver al blog
            </button>
        </div>
    </main>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';

const route = useRoute();
const articulo = ref(null);
const cargando = ref(true);

const cargarArticulo = async () => {
    try {
        const response = await axios.get(`/articulos/${route.params.slug}`);
        articulo.value = response.data;
    } catch (error) {
        console.error('Error al cargar artículo:', error);
        articulo.value = null;
    } finally {
        cargando.value = false;
    }
};

const getCategoriaLabel = (categoria) => {
    const labels = {
        ahorro_energetico: '💡 Ahorro Energético',
        subvenciones: '💰 Subvenciones',
        agenda_2030: '🌍 Agenda 2030',
        domotica_verde: '🏠 Domótica Verde',
        general: '📄 General'
    };
    return labels[categoria] || categoria;
};

const formatearFecha = (fecha) => {
    if (!fecha) return '';
    const date = new Date(fecha);
    return date.toLocaleDateString('es-ES', { day: '2-digit', month: 'long', year: 'numeric' });
};

const getAutorNombre = (autor) => {
    if (autor.agente) return autor.agente.nombre;
    if (autor.cliente) return autor.cliente.nombre;
    return 'SerraInnova';
};

onMounted(() => {
    cargarArticulo();
});
</script>
