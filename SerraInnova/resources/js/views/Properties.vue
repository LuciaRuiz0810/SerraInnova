<template>
    <div class="organic-bg min-h-screen font-display text-forest dark:text-white transition-colors duration-300">
         <div class="container mx-auto px-6 pt-24 pb-16">
            <!-- Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
               <span class="inline-block px-3 py-1 bg-primary text-forest text-[10px] font-bold uppercase tracking-widest rounded-full w-fit mb-4">Portfolio Exclusivo</span>
                <h1 class="text-3xl md:text-5xl font-black text-forest dark:text-white mb-4 tracking-tight">Encuentra tu refugio sostenible</h1>
                <p class="text-leaf/80 text-lg font-medium">Explora nuestra colección selecta de viviendas de alta eficiencia energética.</p>
            </div>

            <!-- Filters Section (Flexbox) -->
            <div class="bg-white/80 dark:bg-background-dark/80 backdrop-blur-md p-6 rounded-2xl shadow-lg border border-leaf/10 mb-12">
                <div class="flex flex-col md:flex-row gap-4 items-end">
                    <!-- Location -->
                    <div class="flex-1 w-full">
                        <label class="block text-[10px] uppercase font-bold tracking-wider text-leaf mb-1">Ubicación</label>
                         <div class="flex items-center gap-2 border border-leaf/20 rounded-lg px-3 py-2 bg-background-light dark:bg-background-dark/50 hover:border-leaf/40 transition-colors">
                            <span class="material-symbols-outlined text-leaf text-sm">location_on</span>
                            <select v-model="filters.ubicacion" class="bg-transparent border-none p-0 text-sm focus:ring-0 w-full appearance-none text-forest font-bold cursor-pointer">
                                <option value="">Todas las zonas</option>
                                <option value="Valencia">Valencia Centro</option>
                                <option value="Ruzafa">Ruzafa</option>
                                <option value="Vella">Ciutat Vella</option>
                            </select>
                        </div>
                    </div>

                     <!-- Type -->
                    <div class="flex-1 w-full">
                        <label class="block text-[10px] uppercase font-bold tracking-wider text-leaf mb-1">Tipo</label>
                        <div class="flex items-center gap-2 border border-leaf/20 rounded-lg px-3 py-2 bg-background-light dark:bg-background-dark/50 hover:border-leaf/40 transition-colors">
                            <span class="material-symbols-outlined text-leaf text-sm">home</span>
                            <select v-model="filters.tipo" class="bg-transparent border-none p-0 text-sm focus:ring-0 w-full appearance-none text-forest font-bold cursor-pointer">
                                <option value="">Cualquier tipo</option>
                                <option value="Apartamento">Apartamento</option>
                                <option value="Casa">Casa</option>
                                <option value="Atico">Ático</option>
                            </select>
                         </div>
                    </div>

                    <!-- Operation -->
                    <div class="flex-1 w-full">
                         <label class="block text-[10px] uppercase font-bold tracking-wider text-leaf mb-1">Operación</label>
                        <div class="flex items-center gap-2 border border-leaf/20 rounded-lg px-3 py-2 bg-background-light dark:bg-background-dark/50 hover:border-leaf/40 transition-colors">
                             <span class="material-symbols-outlined text-leaf text-sm">key</span>
                            <select v-model="filters.operacion" class="bg-transparent border-none p-0 text-sm focus:ring-0 w-full appearance-none text-forest font-bold cursor-pointer">
                                <option value="">Venta y Alquiler</option>
                                <option value="venta">Venta</option>
                                <option value="alquiler">Alquiler</option>
                            </select>
                        </div>
                    </div>

                    <!-- Certificación Energética -->
                    <div class="flex-1 w-full">
                        <label class="block text-[10px] uppercase font-bold tracking-wider text-leaf mb-1">Certificación</label>
                        <div class="flex items-center gap-2 border border-leaf/20 rounded-lg px-3 py-2 bg-background-light dark:bg-background-dark/50 hover:border-leaf/40 transition-colors">
                            <span class="material-symbols-outlined text-leaf text-sm">energy_savings_leaf</span>
                            <select v-model="filters.certificacion" class="bg-transparent border-none p-0 text-sm focus:ring-0 w-full appearance-none text-forest font-bold cursor-pointer">
                                <option value="">Cualquier certificación</option>
                                <option value="A">A - Muy Eficiente</option>
                                <option value="B">B - Eficiente</option>
                                <option value="C">C - Moderada</option>
                                <option value="D">D - Media</option>
                                <option value="E">E - Normal</option>
                                <option value="F">F - Poco Eficiente</option>
                                <option value="G">G - Ineficiente</option>
                            </select>
                        </div>
                    </div>

                    <!-- Tipo de Energía -->
                    <div class="flex-1 w-full">
                        <label class="block text-[10px] uppercase font-bold tracking-wider text-leaf mb-1">Energía</label>
                        <div class="flex items-center gap-2 border border-leaf/20 rounded-lg px-3 py-2 bg-background-light dark:bg-background-dark/50 hover:border-leaf/40 transition-colors">
                            <span class="material-symbols-outlined text-leaf text-sm">solar_power</span>
                            <select v-model="filters.tipo_energia" class="bg-transparent border-none p-0 text-sm focus:ring-0 w-full appearance-none text-forest font-bold cursor-pointer">
                                <option value="">Tipo de energía</option>
                                <option value="aerotermia">Aerotermia</option>
                                <option value="placas_solares">Placas Solares</option>
                                <option value="biomasa">Biomasa</option>
                            </select>
                        </div>
                    </div>

                     <!-- Filter Button -->
                    <div class="w-full md:w-auto">
                        <button @click="fetchProperties" class="w-full bg-forest hover:bg-leaf text-white font-bold py-2.5 px-6 rounded-lg transition-colors shadow-lg flex items-center justify-center gap-2 h-[42px]">
                           <span class="material-symbols-outlined text-sm">filter_list</span>
                            Filtrar
                        </button>
                    </div>
                </div>
            </div>

            <!-- Properties List (Flexbox Grid) -->
             <div v-if="loading" class="flex justify-center py-20">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary"></div>
            </div>

            <div v-else-if="propiedades.length === 0" class="text-center py-20 bg-white/50 rounded-xl shadow-sm border border-leaf/10">
                <span class="material-symbols-outlined text-4xl text-leaf/50 mb-2">search_off</span>
                <p class="text-xl text-forest font-bold mb-4">No encontramos propiedades con esos filtros.</p>
                <button @click="clearFilters" class="text-leaf font-bold hover:text-primary transition-colors underline">Limpiar filtros</button>
            </div>

            <div v-else class="flex flex-wrap -mx-4">
                 <router-link 
                    v-for="propiedad in propiedades" 
                    :key="propiedad.id_propiedad" 
                    :to="{ name: 'PropertyDetail', params: { id: propiedad.id_propiedad }}"
                    class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8 block group"
                >
                    <div class="bg-white dark:bg-background-dark/40 rounded-2xl overflow-hidden shadow-lg border border-leaf/5 hover:shadow-2xl transition-all h-full flex flex-col">
                        <div class="relative h-64 overflow-hidden shrink-0">
                            <img :src="getCoverImage(propiedad)" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" 
                                 :alt="propiedad.titulo"
                            >
                            <div class="absolute top-4 left-4 text-forest text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest shadow-sm"
                                 :class="propiedad.tipo_operacion === 'venta' ? 'bg-primary' : 'bg-white'">
                                {{ propiedad.tipo_operacion }}
                            </div>
                            <!-- Energy Badge -->
                            <div v-if="propiedad.etiqueta_energetica" 
                                class="absolute top-4 right-4 text-white text-[12px] font-black w-8 h-8 rounded-full flex items-center justify-center shadow-sm border-2 border-white"
                                :class="getEnergyColor(propiedad.etiqueta_energetica)">
                                {{ propiedad.etiqueta_energetica }}
                            </div>
                            <div class="absolute bottom-4 right-4 bg-forest/90 backdrop-blur-sm text-white text-sm font-bold px-3 py-1 rounded-lg shadow-lg border border-leaf/20">
                                {{ formatPrice(propiedad) }}
                            </div>
                        </div>
                        <div class="p-6 flex flex-col flex-1">
                            <div class="flex items-center gap-1 mb-2">
                                <span class="material-symbols-outlined text-sm text-leaf">location_on</span>
                                <p class="text-leaf text-xs font-bold uppercase tracking-wider">{{ propiedad.ciudad }}</p>
                            </div>
                            <h3 class="text-xl font-black text-forest dark:text-white mb-3 group-hover:text-leaf transition-colors line-clamp-1">{{ propiedad.titulo }}</h3>
                            
                            <div class="flex items-center gap-4 text-leaf/70 text-sm mb-4 font-medium border-t border-leaf/10 pt-4 mt-auto">
                                 <span v-if="propiedad.habitaciones" class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">bed</span> {{ propiedad.habitaciones }}</span>
                                <span v-if="propiedad.banos" class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">bathtub</span> {{ propiedad.banos }}</span>
                                <span v-if="propiedad.metros_cuadrados" class="flex items-center gap-1"><span class="material-symbols-outlined text-sm">square_foot</span> {{ parseInt(propiedad.metros_cuadrados) }} m²</span>
                            </div>
                             <div class="text-center w-full">
                                <span class="text-primary font-bold text-xs uppercase tracking-widest group-hover:underline">Ver Detalles</span>
                            </div>
                        </div>
                    </div>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, reactive } from 'vue';
import axios from 'axios';
import { useRoute, useRouter } from 'vue-router';

const propiedades = ref([]);
const loading = ref(true);
const route = useRoute();
const router = useRouter();

// Estado de los filtros
const filters = reactive({
    ubicacion: route.query.ubicacion || '',
    tipo: route.query.tipo || '',
    operacion: route.query.operacion || '',
    certificacion: route.query.certificacion || '',
    tipo_energia: route.query.tipo_energia || ''
});

const fetchProperties = async () => {
    loading.value = true;
    try {
        // Actualizar URL sin recargar
        router.push({ query: { ...filters } });

        const response = await axios.get('/propiedades', {
            params: {
                ubicacion: filters.ubicacion,
                tipo: filters.tipo,
                operacion: filters.operacion,
                certificacion: filters.certificacion,
                tipo_energia: filters.tipo_energia
            }
        });
        propiedades.value = response.data;
    } catch (error) {
        console.error('Error cargando propiedades', error);
    } finally {
        loading.value = false;
    }
};

const clearFilters = () => {
    filters.ubicacion = '';
    filters.tipo = '';
    filters.operacion = '';
    filters.certificacion = '';
    filters.tipo_energia = '';
    fetchProperties();
};

const getEnergyColor = (label) => {
    const colors = {
        'A': 'bg-[#13ec5b]',
        'B': 'bg-[#4c9a66]',
        'C': 'bg-[#f4e04d]',
        'D': 'bg-[#f9a825]',
        'E': 'bg-[#ff8c00]',
        'F': 'bg-[#ff6347]',
        'G': 'bg-[#dc143c]',
    };
    return colors[label] || 'bg-gray-400';
};

const formatPrice = (propiedad) => {
    const precio = propiedad.tipo_operacion === 'venta' ? propiedad.precio_venta : propiedad.precio_alquiler;
    if (!precio) return 'Consultar';
    return new Intl.NumberFormat('es-ES', { 
        style: 'currency', 
        currency: 'EUR', 
        maximumFractionDigits: 0 
    }).format(precio) + (propiedad.tipo_operacion === 'alquiler' ? '/mes' : '');
};

const getCoverImage = (propiedad) => {
    // 1. Prioridad: Nueva tabla de imágenes (relación)
    if (propiedad.imagenes && propiedad.imagenes.length > 0) {
         // Ordenar por 'orden' ascendente y coger la primera
         const cover = [...propiedad.imagenes].sort((a, b) => a.orden - b.orden)[0];
         return cover.url;
    }
    
    // 2. Legacy: Campo JSON 'fotos'
    if (propiedad.fotos) {
        let fotosArray = [];
        try {
            fotosArray = typeof propiedad.fotos === 'string' 
                ? JSON.parse(propiedad.fotos) 
                : propiedad.fotos;
        } catch (e) {
            console.error('Error parsing fotos JSON', e);
        }
        
        if (Array.isArray(fotosArray) && fotosArray.length > 0) {
            return fotosArray[0];
        }
    }

    // 3. Fallback default
    return 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop';
};

onMounted(() => {
    fetchProperties();
});
</script>

<style scoped>
.organic-bg {
    background-image: radial-gradient(circle at 10% 20%, rgba(19, 236, 91, 0.05) 0%, transparent 20%),
                      radial-gradient(circle at 90% 80%, rgba(76, 154, 102, 0.05) 0%, transparent 20%);
}
</style>
