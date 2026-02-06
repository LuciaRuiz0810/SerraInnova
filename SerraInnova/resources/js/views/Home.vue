<template>
    <main class="organic-bg">
        <!-- Hero Section with Integrated Search -->
        <section class="relative px-4 pt-6 pb-20 md:px-10 lg:px-20">
            <div class="mx-auto max-w-[1200px]">
                <div class="relative min-h-[560px] flex flex-col items-center justify-center rounded-3xl overflow-hidden bg-cover bg-center p-8 shadow-2xl" 
                     data-alt="Modern sustainable home with floor to ceiling glass walls and lush green plants" 
                     style='background-image: linear-gradient(to bottom, rgba(0,0,0,0.2), rgba(0,0,0,0.6)), url("https://lh3.googleusercontent.com/aida-public/AB6AXuADA9E12guztlbVWG2VBOcMo_p7oUfKxacZRhLWz67Gr_oSVX37Qr5IMOxN2RYroaII3kXh4c29JyiuWtpSMasPFS_GxvLkutY4mz22pDrloN1HvlQU2VLVSfMAhGDoySMflQYqilVzwLXjWcx4cfyvWWRof4XP0m-xHxLdTltp38Yi4PhSWF5yDw1dwSmaU_GswGpH6JeBk_zZWq8HPKEH_Qs8WiV0fhTTUPOgdiB0SpUK5Bak9FIX4Znvlhm04_nkZ8Las08QsYo");'>
                    <div class="relative z-10 max-w-3xl text-center space-y-6">
                        <h1 class="text-4xl md:text-6xl font-black text-white leading-[1.1] tracking-tight">
                            Tu futuro es verde y sostenible
                        </h1>
                        <p class="text-lg md:text-xl text-white/90 font-medium">
                            Descubre hogares diseñados para convivir con la naturaleza, sin renunciar al máximo confort y tecnología.
                        </p>
                    </div>

                    <!-- Floating Search Bar -->
                    <div class="mt-12 w-full max-w-4xl glass-effect dark:glass-effect-dark rounded-3xl shadow-2xl p-4 md:p-6 flex flex-wrap gap-4 border-2 border-primary/10 glow-primary">
                        <!-- Tabs for Search - Solo para clientes y no autenticados -->
                        <div v-if="!user || user.tipo_usuario === 'cliente'" class="w-full flex border-b-2 border-primary/10 mb-4">
                            <button 
                                @click="filters.operacion = 'venta'"
                                class="px-6 py-2 text-sm font-bold border-b-2 text-forest dark:text-white"
                                :class="filters.operacion === 'venta' ? 'border-primary' : 'border-transparent text-leaf hover:text-forest dark:hover:text-white'">
                                Comprar
                            </button>
                            <button 
                                @click="filters.operacion = 'alquiler'"
                                class="px-6 py-2 text-sm font-medium text-leaf hover:text-forest dark:hover:text-white border-b-2"
                                :class="filters.operacion === 'alquiler' ? 'border-primary' : 'border-transparent'">
                                Alquilar
                            </button>
                        </div>

                        <!-- Título para vendedores -->
                        <div v-if="user && user.tipo_usuario === 'agente'" class="w-full mb-2">
                            <h3 class="text-lg font-bold text-forest dark:text-white">Buscar Propiedades</h3>
                            <p class="text-sm text-leaf">Encuentra propiedades en el mercado</p>
                        </div>

                        <div class="flex flex-col gap-1.5 w-full md:flex-1 md:min-w-[200px]">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-leaf">Localización</span>
                            <div class="flex items-center gap-2 border-2 border-leaf/20 rounded-xl px-4 py-3 bg-background-light dark:bg-background-dark/50 hover:border-primary/40 transition-all duration-300 shadow-sm hover:shadow-md">
                                <span class="material-symbols-outlined text-leaf text-sm">location_on</span>
                                <input v-model="filters.ubicacion" class="bg-transparent border-none p-0 text-sm focus:ring-0 w-full placeholder:text-leaf/50" placeholder="¿Dónde buscas?" type="text"/>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5 w-full md:flex-1 md:min-w-[200px]">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-leaf">Tipo de Propiedad</span>
                            <div class="flex items-center gap-2 border-2 border-leaf/20 rounded-xl px-4 py-3 bg-background-light dark:bg-background-dark/50 hover:border-primary/40 transition-all duration-300 shadow-sm hover:shadow-md">
                                <span class="material-symbols-outlined text-leaf text-sm">home</span>
                                <select v-model="filters.tipo" class="bg-transparent border-none p-0 text-sm focus:ring-0 w-full appearance-none">
                                    <option value="">Todas</option>
                                    <option value="casa">Casa</option>
                                    <option value="apartamento">Apartamento</option>
                                    <option value="local">Local</option>
                                    <option value="terreno">Terreno</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-col gap-1.5 w-full md:flex-1 md:min-w-[200px]">
                            <span class="text-[10px] uppercase font-bold tracking-wider text-leaf">Presupuesto</span>
                            <div class="flex items-center gap-2 border-2 border-leaf/20 rounded-xl px-4 py-3 bg-background-light dark:bg-background-dark/50 hover:border-primary/40 transition-all duration-300 shadow-sm hover:shadow-md">
                                <span class="material-symbols-outlined text-leaf text-sm">payments</span>
                                <select class="bg-transparent border-none p-0 text-sm focus:ring-0 w-full appearance-none">
                                    <option>Cualquier precio</option>
                                    <option>200k - 400k</option>
                                    <option>400k - 800k</option>
                                    <option>+800k</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-end w-full md:w-auto md:min-w-[140px]">
                            <button @click="search" class="w-full bg-gradient-to-r from-forest to-leaf text-primary font-bold py-3 px-6 rounded-xl flex items-center justify-center gap-2 hover:shadow-2xl hover:scale-105 transition-all duration-300 glow-primary-hover">
                                <span class="material-symbols-outlined">search</span>
                                Buscar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Propiedades Destacadas -->
        <section class="px-4 py-16 md:px-10 lg:px-20">
            <div class="mx-auto max-w-[1200px]">
                <div class="flex items-end justify-between mb-12">
                    <div>
                        <h2 class="text-3xl font-extrabold text-forest dark:text-white mb-2">Propiedades Destacadas</h2>
                        <p class="text-leaf">Nuestra selección exclusiva de viviendas eficientes</p>
                    </div>
                    <router-link to="/propiedades" class="text-sm font-bold text-forest dark:text-white flex items-center gap-1 hover:text-primary transition-colors">
                        Ver todo
                        <span class="material-symbols-outlined text-sm">arrow_forward</span>
                    </router-link>
                </div>
                <div class="flex flex-wrap -mx-4">
                    <!-- Loading State -->
                    <div v-if="loading" class="w-full text-center py-12">
                        <p class="text-leaf text-lg">Cargando propiedades...</p>
                    </div>

                    <!-- Property Cards - Dynamic -->
                    <div v-else-if="featuredProperties.length > 0" 
                         v-for="propiedad in featuredProperties" 
                         :key="propiedad.id_propiedad"
                         class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                        <router-link :to="{ name: 'PropertyDetail', params: { id: propiedad.id_propiedad }}" class="block h-full">
                            <div class="group bg-white dark:bg-background-dark/40 rounded-3xl overflow-hidden shadow-xl border-2 border-leaf/5 hover:shadow-2xl hover:border-primary/30 hover:-translate-y-2 transition-all duration-500 h-full hover:scale-[1.02]">
                                <div class="relative h-64 overflow-hidden">
                                    <div class="absolute top-4 left-4 z-10 bg-gradient-to-r from-primary to-leaf text-forest text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg glow-primary">
                                        {{ propiedad.tipo_operacion === 'venta' ? 'En Venta' : 'En Alquiler' }}
                                    </div>
                                    <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" 
                                         :src="getPropertyImage(propiedad)" 
                                         :alt="propiedad.titulo">
                                </div>
                                <div class="p-6">
                                    <div class="flex justify-between items-start mb-4">
                                        <h3 class="text-xl font-bold text-forest dark:text-white line-clamp-1">{{ propiedad.titulo }}</h3>
                                        <p class="text-xl font-black text-leaf whitespace-nowrap">{{ formatPrice(propiedad) }}</p>
                                    </div>
                                    <div class="flex items-center gap-1 text-leaf/70 text-sm mb-6">
                                        <span class="material-symbols-outlined text-sm">location_on</span>
                                        {{ propiedad.ciudad }}, {{ propiedad.provincia }}
                                    </div>
                                    <div class="flex justify-between border-t border-leaf/10 pt-4">
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-leaf">square_foot</span>
                                            <span class="text-sm font-semibold">{{ parseInt(propiedad.metros_cuadrados) }} m²</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-leaf">bed</span>
                                            <span class="text-sm font-semibold">{{ propiedad.habitaciones }} Hab</span>
                                        </div>
                                        <div class="flex items-center gap-2">
                                            <span class="material-symbols-outlined text-leaf">bathtub</span>
                                            <span class="text-sm font-semibold">{{ propiedad.banos }} Baños</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </router-link>
                    </div>

                    <!-- Empty State -->
                    <div v-else class="w-full text-center py-12">
                        <p class="text-leaf text-lg">No hay propiedades destacadas disponibles en este momento.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Calculator CTA Section -->
        <section class="px-4 py-16 md:px-10 lg:px-20">
            <div class="mx-auto max-w-[1200px]">
                <div class="bg-gradient-to-br from-primary/10 via-leaf/10 to-forest/10 dark:from-primary/20 dark:via-leaf/20 dark:to-forest/20 rounded-3xl p-8 md:p-12 border-2 border-primary/30 relative overflow-hidden glow-primary">
                    <!-- Background decoration -->
                    <div class="absolute top-0 right-0 opacity-5 text-forest dark:text-primary scale-150">
                        <span class="material-symbols-outlined text-[180px]">calculate</span>
                    </div>
                    
                    <div class="relative z-10 grid grid-cols-1 lg:grid-cols-2 gap-8 items-center">
                        <!-- Left: Content -->
                        <div class="space-y-6">
                            <div class="inline-flex items-center gap-2 bg-primary/20 px-4 py-2 rounded-full">
                                <span class="material-symbols-outlined text-forest dark:text-primary text-sm">new_releases</span>
                                <span class="text-xs font-black text-forest dark:text-white uppercase tracking-wider">Herramienta Gratuita</span>
                            </div>
                            
                            <h2 class="text-3xl md:text-4xl lg:text-5xl font-black text-forest dark:text-white leading-tight">
                                ¿Cuánto puedes ahorrar en tu hogar?
                            </h2>
                            
                            <p class="text-lg text-leaf dark:text-leaf/90">
                                Descubre el potencial de ahorro energético de tu vivienda con nuestra calculadora inteligente. 
                                Obtén recomendaciones personalizadas de rehabilitación en menos de 2 minutos.
                            </p>
                            
                            <div class="grid grid-cols-2 gap-4">
                                <div class="bg-white/60 dark:bg-background-dark/60 backdrop-blur-sm rounded-xl p-4 border border-leaf/20">
                                    <div class="text-2xl font-black text-forest dark:text-primary mb-1">40-70%</div>
                                    <div class="text-xs text-leaf font-semibold">Ahorro energético</div>
                                </div>
                                <div class="bg-white/60 dark:bg-background-dark/60 backdrop-blur-sm rounded-xl p-4 border border-leaf/20">
                                    <div class="text-2xl font-black text-forest dark:text-primary mb-1">100%</div>
                                    <div class="text-xs text-leaf font-semibold">Gratis y sin compromiso</div>
                                </div>
                            </div>
                            
                            <router-link 
                                to="/calculadora"
                                class="inline-flex items-center justify-center gap-3 bg-gradient-to-r from-forest to-leaf text-primary font-black py-5 px-8 rounded-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 glow-primary-hover"
                            >
                                <span class="material-symbols-outlined text-2xl">calculate</span>
                                Calcular Ahora
                                <span class="material-symbols-outlined text-xl">arrow_forward</span>
                            </router-link>
                        </div>
                        
                        <!-- Right: Benefits -->
                        <div class="space-y-4">
                            <div class="bg-white/80 dark:bg-background-dark/80 backdrop-blur-sm rounded-2xl p-5 border-2 border-leaf/20 hover:border-primary/40 transition-all group">
                                <div class="flex items-start gap-4">
                                    <div class="size-12 rounded-xl bg-gradient-to-br from-primary/20 to-leaf/20 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <span class="material-symbols-outlined text-forest dark:text-primary text-2xl">speed</span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-forest dark:text-white mb-1">Resultados Instantáneos</h4>
                                        <p class="text-sm text-leaf">Análisis completo en menos de 2 minutos</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white/80 dark:bg-background-dark/80 backdrop-blur-sm rounded-2xl p-5 border-2 border-leaf/20 hover:border-primary/40 transition-all group">
                                <div class="flex items-start gap-4">
                                    <div class="size-12 rounded-xl bg-gradient-to-br from-primary/20 to-leaf/20 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <span class="material-symbols-outlined text-forest dark:text-primary text-2xl">psychology</span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-forest dark:text-white mb-1">Recomendaciones Personalizadas</h4>
                                        <p class="text-sm text-leaf">Servicios adaptados a tu vivienda específica</p>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="bg-white/80 dark:bg-background-dark/80 backdrop-blur-sm rounded-2xl p-5 border-2 border-leaf/20 hover:border-primary/40 transition-all group">
                                <div class="flex items-start gap-4">
                                    <div class="size-12 rounded-xl bg-gradient-to-br from-primary/20 to-leaf/20 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <span class="material-symbols-outlined text-forest dark:text-primary text-2xl">euro</span>
                                    </div>
                                    <div>
                                        <h4 class="font-bold text-forest dark:text-white mb-1">Estimación de Costes</h4>
                                        <p class="text-sm text-leaf">Conoce la inversión y el retorno esperado</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- CTA Section -->
        <section class="px-4 py-20 md:px-10 lg:px-20 bg-sand dark:bg-background-dark/20">
            <div class="mx-auto max-w-[1200px] bg-forest rounded-3xl p-8 md:p-16 flex flex-col md:flex-row items-center gap-12 overflow-hidden relative">
                <!-- Abstract leaf shape background -->
                <div class="absolute -right-20 -bottom-20 opacity-20 text-primary scale-[5]">
                    <span class="material-symbols-outlined text-[200px]">eco</span>
                </div>
                <div class="flex-1 space-y-6 relative z-10 text-center md:text-left">
                    <h2 class="text-3xl md:text-5xl font-extrabold text-white leading-tight">¿Quieres vender tu propiedad de forma consciente?</h2>
                    <p class="text-leaf/80 text-lg">Nos especializamos en poner en valor las características sostenibles de tu vivienda para encontrar al comprador ideal.</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start">
                        <button class="bg-primary text-forest font-bold px-8 py-4 rounded-xl hover:bg-white transition-colors">Vender mi casa</button>
                        <button class="border border-white/20 text-white font-bold px-8 py-4 rounded-xl hover:bg-white/10 transition-colors">Saber más</button>
                    </div>
                </div>
                <div class="flex-1 relative z-10 w-full md:w-auto">
                    <div class="bg-white/10 backdrop-blur-md p-6 rounded-2xl border border-white/10 shadow-xl">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="size-12 rounded-full bg-primary/20 flex items-center justify-center text-primary">
                                <span class="material-symbols-outlined">analytics</span>
                            </div>
                            <div>
                                <h4 class="text-white font-bold">Valoración Gratuita</h4>
                                <p class="text-leaf text-xs">Análisis de eficiencia energética incluido</p>
                            </div>
                        </div>
                        <input class="w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white mb-3 placeholder:text-white/30 focus:ring-primary focus:border-primary" placeholder="Tu email" type="email"/>
                        <button class="w-full bg-white text-forest font-bold py-3 rounded-lg hover:bg-primary transition-colors">Solicitar estudio</button>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
import { reactive, ref, onMounted } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();

const filters = reactive({
    tipo: '',
    ubicacion: '',
    operacion: 'venta'
});

const featuredProperties = ref([]);
const loading = ref(true);
const user = ref(null);

onMounted(() => {
    fetchFeaturedProperties();
    
    // Cargar usuario desde localStorage
    const storedUser = localStorage.getItem('user');
    if (storedUser) {
        user.value = JSON.parse(storedUser);
    }
});

const fetchFeaturedProperties = async () => {
    try {
        loading.value = true;
        const response = await axios.get('/propiedades/featured');
        featuredProperties.value = response.data;
    } catch (error) {
        console.error('Error al cargar propiedades destacadas:', error);
    } finally {
        loading.value = false;
    }
};

const formatPrice = (propiedad) => {
    if (propiedad.tipo_operacion === 'venta' && propiedad.precio_venta) {
        return new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR', maximumFractionDigits: 0 }).format(propiedad.precio_venta);
    } else if (propiedad.tipo_operacion === 'alquiler' && propiedad.precio_alquiler) {
        return new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR', maximumFractionDigits: 0 }).format(propiedad.precio_alquiler) + '/mes';
    }
    return 'Precio no disponible';
};

const getPropertyImage = (propiedad) => {
    if (propiedad.fotos && propiedad.fotos.length > 0) {
        return propiedad.fotos[0];
    }
    return 'https://via.placeholder.com/400x300?text=Sin+Imagen';
};

const search = () => {
    router.push({ 
        name: 'Properties', 
        query: { 
            tipo: filters.tipo, 
            ubicacion: filters.ubicacion,
            operacion: filters.operacion
        } 
    });
};

onMounted(() => {
    fetchFeaturedProperties();
});
</script>
