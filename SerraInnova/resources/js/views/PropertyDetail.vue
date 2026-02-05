<template>
    <div class="organic-bg min-h-screen pt-24 pb-16">
        <div class="container mx-auto px-6" v-if="propiedad">
            <!-- Header + Price Section -->
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-8 gap-4">
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-3">
                        <span :class="propiedad.tipo_operacion === 'venta' ? 'bg-primary text-forest' : 'bg-leaf text-white'" 
                              class="text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">
                            {{ propiedad.tipo_operacion }}
                        </span>
                        <span class="text-leaf text-sm font-bold uppercase tracking-wider flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">location_on</span> {{ propiedad.ciudad }}
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-5xl font-black text-forest dark:text-white leading-tight tracking-tight">{{ propiedad.titulo }}</h1>
                    <p class="text-leaf/80 mt-2 text-lg font-medium">{{ propiedad.direccion }}</p>
                </div>
                <!-- Price Box -->
                <div class="mt-4 md:mt-0">
                    <div class="bg-forest text-primary px-8 py-4 rounded-xl shadow-xl border border-leaf/20">
                         <p class="text-3xl font-black">{{ formatPrice(propiedad) }}</p>
                    </div>
                </div>
            </div>

            <!-- Gallery -->
            <div class="grid grid-cols-1 md:grid-cols-4 md:grid-rows-2 gap-4 h-[500px] mb-12 rounded-2xl overflow-hidden shadow-lg">
                <div class="col-span-1 md:col-span-2 md:row-span-2 relative group">
                    <img :src="getCoverImage(propiedad.fotos)" class="w-full h-full object-cover" alt="Main">
                </div>
                <div class="relative group overflow-hidden bg-gray-200">
                    <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?q=80&w=2070" class="w-full h-full object-cover" alt="Detail 1">
                </div>
                <div class="relative group overflow-hidden bg-gray-200">
                    <img src="https://images.unsplash.com/photo-1613490493576-7fde63acd811?q=80&w=2071" class="w-full h-full object-cover" alt="Detail 2">
                </div>
                <div class="relative group overflow-hidden bg-gray-200">
                    <img src="https://images.unsplash.com/photo-1600566753086-00f18fb6b3ea?q=80&w=2070" class="w-full h-full object-cover" alt="Detail 3">
                </div>
                <div class="relative group overflow-hidden bg-gray-200">
                    <img src="https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=2074" class="w-full h-full object-cover" alt="Detail 4">
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Main Info Column -->
                <div class="lg:col-span-2">
                    <!-- Features -->
                    <div class="bg-white/80 dark:bg-background-dark/80 backdrop-blur-md rounded-2xl p-8 shadow-sm border border-leaf/10 mb-8">
                        <h3 class="text-2xl font-black text-forest dark:text-white mb-6 tracking-tight">Características principales</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            <div class="text-center p-4 bg-background-light dark:bg-background-dark/50 rounded-lg">
                                <span class="material-symbols-outlined text-2xl text-leaf mb-2 block">bed</span>
                                <p class="text-sm text-gray-500">Habitaciones</p>
                                <p class="font-bold text-primary">{{ propiedad.habitaciones }}</p>
                            </div>
                            <div class="text-center p-4 bg-background-light dark:bg-background-dark/50 rounded-lg">
                                <span class="material-symbols-outlined text-2xl text-leaf mb-2 block">bathtub</span>
                                <p class="text-sm text-gray-500">Baños</p>
                                <p class="font-bold text-primary">{{ propiedad.banos }}</p>
                            </div>
                            <div class="text-center p-4 bg-background-light dark:bg-background-dark/50 rounded-lg">
                                <span class="material-symbols-outlined text-2xl text-leaf mb-2 block">square_foot</span>
                                <p class="text-sm text-gray-500">Superficie</p>
                                <p class="font-bold text-primary">{{ parseInt(propiedad.metros_cuadrados) }} m²</p>
                            </div>
                            <div class="text-center p-4 bg-background-light dark:bg-background-dark/50 rounded-lg">
                                <span class="material-symbols-outlined text-2xl text-leaf mb-2 block">home</span>
                                <p class="text-sm text-gray-500">Tipo</p>
                                <p class="font-bold text-primary capitalize">{{ propiedad.tipo_propiedad }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="bg-white/80 dark:bg-background-dark/80 backdrop-blur-md rounded-2xl p-8 shadow-sm border border-leaf/10 mb-8">
                        <h3 class="text-2xl font-black text-forest dark:text-white mb-4 tracking-tight">Descripción</h3>
                        <div class="prose max-w-none text-gray-600 leading-relaxed">
                            <p>{{ propiedad.descripcion }}</p>
                        </div>
                    </div>

                    <!-- Sostenibilidad & Eficiencia -->
                    <div v-if="sustainabilityData" class="mb-8">
                        <GreenTechSheet 
                            :certificacion="sustainabilityData.certificacion"
                            :huella-carbono="sustainabilityData.huellaCarbono"
                            :ahorro-co2="sustainabilityData.ahorroCo2"
                            :caracteristicas="sustainabilityData.caracteristicas"
                            :certificaciones-externas="sustainabilityData.certificacionesExternas"
                            :tipo-energia="sustainabilityData.tipoEnergia"
                        />
                    </div>

                    <!-- Map -->
                    <div class="bg-white/80 dark:bg-background-dark/80 backdrop-blur-md rounded-2xl p-8 shadow-sm border border-leaf/10">
                        <h3 class="text-2xl font-black text-forest dark:text-white mb-4 tracking-tight">Ubicación</h3>
                        <div class="bg-gray-200 h-64 rounded-lg flex items-center justify-center text-gray-500">
                            <p><span class="material-symbols-outlined mr-2">map</span> Mapa interactivo aquí</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-forest text-white rounded-2xl p-8 shadow-2xl border border-leaf/20 sticky top-28">
                        <div class="flex items-center mb-8 border-b border-white/10 pb-6">
                            <div class="size-16 rounded-full bg-white/10 overflow-hidden mr-4 border-2 border-primary">
                                <img src="https://ui-avatars.com/api/?name=Agente&background=13ec5b&color=0d1b12&size=128" alt="Agente" class="w-full h-full object-cover" />
                            </div>
                            <div>
                                <p class="text-[10px] text-primary font-black uppercase tracking-widest">Tu Eco-Agente</p>
                                <h4 class="text-xl font-bold">{{ propiedad.agente?.nombre || 'Agente SerraInnova' }}</h4>
                                <p class="text-sm text-white/50">Licencia: {{ propiedad.agente?.licencia || 'A-1234' }}</p>
                            </div>
                        </div>

                        <form class="space-y-4">
                            <div>
                                <label class="block text-xs font-bold text-white/70 mb-1 uppercase tracking-wider">Nombre</label>
                                <input type="text" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-1 focus:ring-primary focus:outline-none text-white" placeholder="Tu nombre">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-white/70 mb-1 uppercase tracking-wider">Email</label>
                                <input type="email" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-1 focus:ring-primary focus:outline-none text-white" placeholder="tu@email.com">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-white/70 mb-1 uppercase tracking-wider">Teléfono</label>
                                <input type="tel" class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-1 focus:ring-primary focus:outline-none text-white" placeholder="+34 600 000 000">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-white/70 mb-1 uppercase tracking-wider">Mensaje</label>
                                <textarea class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl focus:ring-1 focus:ring-primary focus:outline-none h-32 text-white" placeholder="Hola, me interesa..."></textarea>
                            </div>
                            <button type="submit" class="w-full bg-primary hover:bg-white hover:text-forest text-forest font-bold py-4 rounded-xl transition-all shadow-lg text-sm uppercase tracking-widest mt-4">
                                Contactar Ahora
                            </button>
                            <button type="button" class="w-full bg-transparent border border-white/20 text-white hover:bg-white/10 font-bold py-4 rounded-xl transition-colors flex items-center justify-center gap-2 text-sm uppercase tracking-widest">
                                <i class="fab fa-whatsapp text-lg"></i> WhatsApp
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Loading State -->
        <div v-else class="flex justify-center items-center h-screen">
             <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-primary"></div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { useRoute } from 'vue-router';
import axios from 'axios';
import GreenTechSheet from '../components/sustainability/GreenTechSheet.vue';

const route = useRoute();
const propiedad = ref(null);

// Computed sustainability data from loaded property
const sustainabilityData = computed(() => {
    if (!propiedad.value) return null;
    
    return {
        certificacion: propiedad.value.certificacion_energetica || 'C',
        huellaCarbono: parseFloat(propiedad.value.huella_carbono_anual) || 0,
        ahorroCo2: parseFloat(propiedad.value.ahorro_co2_vs_estandar) || 0,
        tipoEnergia: propiedad.value.tipo_energia || null,
        certificacionesExternas: propiedad.value.certificaciones ? JSON.parse(propiedad.value.certificaciones) : [],
        caracteristicas: propiedad.value.caracteristicas_sostenibles || null
    };
});

const fetchPropiedad = async () => {
    try {
        const response = await axios.get(`/propiedades/${route.params.id}`);
        propiedad.value = response.data;
    } catch (error) {
        console.error('Error cargando propiedad', error);
    }
};

const formatPrice = (propiedad) => {
    const precio = propiedad.tipo_operacion === 'venta' ? propiedad.precio_venta : propiedad.precio_alquiler;
    if (!precio) return 'Consultar Precio';
    
    return new Intl.NumberFormat('es-ES', { 
        style: 'currency', 
        currency: 'EUR', 
        maximumFractionDigits: 0 
    }).format(precio) + (propiedad.tipo_operacion === 'alquiler' ? '/mes' : '');
};

const getCoverImage = () => {
    return 'https://images.unsplash.com/photo-1600585154340-be6161a56a0c?q=80&w=2070&auto=format&fit=crop';
};

onMounted(() => {
    fetchPropiedad();
});
</script>
