<template>
    <main class="organic-bg min-h-screen">
        <!-- Hero Section -->
        <section class="relative px-4 pt-6 pb-16 md:px-10 lg:px-20">
            <div class="mx-auto max-w-[1200px]">
                <div class="relative min-h-[400px] flex flex-col items-center justify-center rounded-3xl overflow-hidden bg-cover bg-center p-8 shadow-2xl" 
                     style='background-image: linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(13,27,18,0.8)), url("https://images.unsplash.com/photo-1497366216548-37526070297c?w=1200&auto=format&fit=crop");'>
                    <div class="relative z-10 max-w-3xl text-center space-y-6">
                        <h1 class="text-4xl md:text-6xl font-black text-white leading-[1.1] tracking-tight">
                            Área de <span class="text-primary">Normativa</span>
                        </h1>
                        <p class="text-lg md:text-xl text-white/90 font-medium">
                            Actualidad sobre estilos de vida sostenibles, Agenda 2030 y subvenciones verdes
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Category Filters -->
        <section class="px-4 pb-8 md:px-10 lg:px-20">
            <div class="mx-auto max-w-[1200px]">
                <div class="flex flex-wrap gap-3 justify-center">
                    <button @click="categoriaSeleccionada = 'todas'" 
                            :class="categoriaSeleccionada === 'todas' ? 'bg-primary text-forest' : 'bg-white dark:bg-background-dark/40 text-leaf dark:text-white/70 hover:border-primary/40'"
                            class="px-6 py-3 rounded-xl font-bold border-2 border-transparent transition-all duration-300 hover:scale-105">
                        Todas
                    </button>
                    <button @click="categoriaSeleccionada = 'ahorro_energetico'" 
                            :class="categoriaSeleccionada === 'ahorro_energetico' ? 'bg-primary text-forest' : 'bg-white dark:bg-background-dark/40 text-leaf dark:text-white/70 hover:border-primary/40'"
                            class="px-6 py-3 rounded-xl font-bold border-2 border-transparent transition-all duration-300 hover:scale-105">
                        💡 Ahorro Energético
                    </button>
                    <button @click="categoriaSeleccionada = 'subvenciones'" 
                            :class="categoriaSeleccionada === 'subvenciones' ? 'bg-primary text-forest' : 'bg-white dark:bg-background-dark/40 text-leaf dark:text-white/70 hover:border-primary/40'"
                            class="px-6 py-3 rounded-xl font-bold border-2 border-transparent transition-all duration-300 hover:scale-105">
                        💰 Subvenciones
                    </button>
                    <button @click="categoriaSeleccionada = 'agenda_2030'" 
                            :class="categoriaSeleccionada === 'agenda_2030' ? 'bg-primary text-forest' : 'bg-white dark:bg-background-dark/40 text-leaf dark:text-white/70 hover:border-primary/40'"
                            class="px-6 py-3 rounded-xl font-bold border-2 border-transparent transition-all duration-300 hover:scale-105">
                        🌍 Agenda 2030
                    </button>
                    <button @click="categoriaSeleccionada = 'domotica_verde'" 
                            :class="categoriaSeleccionada === 'domotica_verde' ? 'bg-primary text-forest' : 'bg-white dark:bg-background-dark/40 text-leaf dark:text-white/70 hover:border-primary/40'"
                            class="px-6 py-3 rounded-xl font-bold border-2 border-transparent transition-all duration-300 hover:scale-105">
                        🏠 Domótica Verde
                    </button>
                </div>
            </div>
        </section>

        <!-- Articles Grid -->
        <section class="px-4 pb-16 md:px-10 lg:px-20">
            <div class="mx-auto max-w-[1200px]">
                <!-- Loading State -->
                <div v-if="cargando" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div v-for="i in 6" :key="i" class="bg-white dark:bg-background-dark/40 rounded-3xl overflow-hidden shadow-xl animate-pulse">
                        <div class="h-56 bg-gray-300 dark:bg-gray-700"></div>
                        <div class="p-6 space-y-4">
                            <div class="h-4 bg-gray-300 dark:bg-gray-700 rounded w-1/3"></div>
                            <div class="h-6 bg-gray-300 dark:bg-gray-700 rounded"></div>
                            <div class="h-4 bg-gray-300 dark:bg-gray-700 rounded w-full"></div>
                            <div class="h-4 bg-gray-300 dark:bg-gray-700 rounded w-2/3"></div>
                        </div>
                    </div>
                </div>

                <!-- Articles List -->
                <div v-else-if="articulos.data && articulos.data.length > 0" class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <article v-for="articulo in articulos.data" :key="articulo.id" 
                             @click="irAArticulo(articulo.slug)"
                             class="group cursor-pointer bg-white dark:bg-background-dark/40 rounded-3xl overflow-hidden shadow-xl border-2 border-leaf/5 hover:shadow-2xl hover:border-primary/30 hover:-translate-y-2 transition-all duration-500">
                        <!-- Featured Image -->
                        <div class="relative h-56 overflow-hidden">
                            <img :src="articulo.imagen_destacada || 'https://images.unsplash.com/photo-1497366216548-37526070297c?w=800'" 
                                 :alt="articulo.titulo"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-forest/60 to-transparent"></div>
                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4">
                                <span class="bg-primary text-forest text-xs font-bold px-3 py-1.5 rounded-full shadow-lg">
                                    {{ getCategoriaLabel(articulo.categoria) }}
                                </span>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <!-- Date and Author -->
                            <div class="flex items-center gap-2 text-xs text-leaf dark:text-white/60 mb-3">
                                <span class="material-symbols-outlined text-sm">calendar_today</span>
                                <span>{{ formatearFecha(articulo.fecha_publicacion) }}</span>
                                <span v-if="articulo.autor" class="ml-auto">
                                    {{ getAutorNombre(articulo.autor) }}
                                </span>
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-bold text-forest dark:text-white mb-3 line-clamp-2 group-hover:text-primary transition-colors">
                                {{ articulo.titulo }}
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-sm text-leaf dark:text-white/70 line-clamp-3 mb-4">
                                {{ articulo.extracto }}
                            </p>

                            <!-- Read More -->
                            <div class="flex items-center gap-2 text-primary font-semibold group-hover:gap-3 transition-all">
                                <span>Leer más</span>
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Empty State -->
                <div v-else class="text-center py-20">
                    <span class="material-symbols-outlined text-6xl text-leaf/30 dark:text-white/20 mb-4">article</span>
                    <h3 class="text-2xl font-bold text-forest dark:text-white mb-2">No hay artículos disponibles</h3>
                    <p class="text-leaf dark:text-white/70">Intenta con otra categoría</p>
                </div>

                <!-- Pagination -->
                <div v-if="articulos.data && articulos.data.length > 0 && articulos.last_page > 1" class="mt-12 flex justify-center gap-2">
                    <button @click="cambiarPagina(paginaActual - 1)" 
                            :disabled="paginaActual === 1"
                            :class="paginaActual === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-primary/20'"
                            class="px-4 py-2 rounded-lg border-2 border-leaf/20 text-forest dark:text-white font-semibold transition-all">
                        Anterior
                    </button>
                    
                    <div class="flex gap-2">
                        <button v-for="pagina in paginas" :key="pagina" 
                                @click="cambiarPagina(pagina)"
                                :class="pagina === paginaActual ? 'bg-primary text-forest' : 'bg-white dark:bg-background-dark/40 text-leaf dark:text-white/70 hover:border-primary/40'"
                                class="px-4 py-2 rounded-lg border-2 border-transparent font-bold transition-all">
                            {{ pagina }}
                        </button>
                    </div>

                    <button @click="cambiarPagina(paginaActual + 1)" 
                            :disabled="paginaActual === articulos.last_page"
                            :class="paginaActual === articulos.last_page ? 'opacity-50 cursor-not-allowed' : 'hover:bg-primary/20'"
                            class="px-4 py-2 rounded-lg border-2 border-leaf/20 text-forest dark:text-white font-semibold transition-all">
                        Siguiente
                    </button>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
import { ref, watch, computed, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();
const articulos = ref({ data: [] });
const cargando = ref(true);
const categoriaSeleccionada = ref('todas');
const paginaActual = ref(1);

const cargarArticulos = async () => {
    cargando.value = true;
    console.log('🔍 DEBUG: Iniciando carga de artículos...');
    try {
        const params = {
            page: paginaActual.value
        };
        if (categoriaSeleccionada.value !== 'todas') {
            params.categoria = categoriaSeleccionada.value;
        }
        
        console.log('🔍 DEBUG: Params:', params);
        const response = await axios.get('/articulos', { params });
        console.log('🔍 DEBUG: Response completa:', response);
        console.log('🔍 DEBUG: Response.data:', response.data);
        console.log('🔍 DEBUG: Número de artículos:', response.data?.data?.length);
        articulos.value = response.data;
        console.log('🔍 DEBUG: articulos.value después de asignar:', articulos.value);
    } catch (error) {
        console.error('❌ Error al cargar artículos:', error);
        console.error('❌ Error completo:', error.response);
    } finally {
        cargando.value = false;
        console.log('🔍 DEBUG: Cargando = false');
    }
};

const irAArticulo = (slug) => {
    router.push(`/blog/${slug}`);
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

const cambiarPagina = (pagina) => {
    paginaActual.value = pagina;
    window.scrollTo({ top: 0, behavior: 'smooth' });
};

const paginas = computed(() => {
    const total = articulos.value.last_page || 1;
    const current = paginaActual.value;
    const delta = 2;
    const range = [];
    
    for (let i = Math.max(2, current - delta); i <= Math.min(total - 1, current + delta); i++) {
        range.push(i);
    }
    
    if (current - delta > 2) {
        range.unshift('...');
    }
    if (current + delta < total - 1) {
        range.push('...');
    }
    
    range.unshift(1);
    if (total > 1) {
        range.push(total);
    }
    
    return range.filter((v, i, a) => a.indexOf(v) === i);
});

watch(categoriaSeleccionada, () => {
    paginaActual.value = 1;
    cargarArticulos();
});

watch(paginaActual, () => {
    cargarArticulos();
});

onMounted(() => {
    cargarArticulos();
});
</script>
