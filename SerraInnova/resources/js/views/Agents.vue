<template>
    <div class="organic-bg min-h-screen pt-24 pb-16">
        <div class="container mx-auto px-6">
            <!-- Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block px-3 py-1 bg-primary text-forest text-[10px] font-bold uppercase tracking-widest rounded-full w-fit mb-4">Nuestro Equipo</span>
                <h1 class="text-3xl md:text-5xl font-black text-forest dark:text-white mb-6 tracking-tight">Expertos en vida sostenible</h1>
                <p class="text-leaf/80 text-lg font-medium leading-relaxed">
                    Conoce a los profesionales apasionados que te ayudarán a encontrar el hogar perfecto en armonía con la naturaleza.
                </p>
            </div>

            <!-- Loading State -->
            <div v-if="loading" class="flex justify-center items-center py-20">
                <div class="animate-spin rounded-full h-16 w-16 border-b-2 border-primary"></div>
            </div>

            <!-- Agents Grid -->
            <div v-else-if="agentes.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                <div v-for="agente in agentes" :key="agente.id_agente" 
                     class="bg-white dark:bg-background-dark/40 rounded-3xl overflow-hidden shadow-lg border border-leaf/5 hover:shadow-2xl transition-all group">
                    <div class="relative h-80 overflow-hidden">
                        <img :src="getAgentImage(agente)" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" 
                             :alt="agente.usuario?.nombre || 'Agente'">
                        <div class="absolute bottom-0 left-0 w-full bg-gradient-to-t from-forest/90 to-transparent p-6 pt-20">
                            <h3 class="text-2xl font-black text-white mb-1">{{ agente.usuario?.nombre || 'Agente SerraInnova' }}</h3>
                            <p class="text-primary font-bold text-xs uppercase tracking-widest">Licencia: {{ agente.licencia }}</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-forest/70 dark:text-white/70 mb-6 italic">"{{ getAgentQuote(agente) }}"</p>
                        <div class="border-t border-leaf/10 pt-4 flex justify-between items-center">
                            <a :href="'mailto:' + (agente.usuario?.email || '')" 
                               class="text-leaf hover:text-primary transition-colors flex items-center gap-2 font-bold text-sm">
                                <span class="material-symbols-outlined text-lg">mail</span> Contactar
                            </a>
                            <div class="flex gap-3">
                                <a href="#" class="text-leaf/60 hover:text-primary transition-colors"><i class="fab fa-linkedin text-lg"></i></a>
                                <a href="#" class="text-leaf/60 hover:text-primary transition-colors"><i class="fab fa-instagram text-lg"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- No Agents Found -->
            <div v-else class="text-center py-20">
                <p class="text-leaf/60 text-lg">No hay agentes disponibles en este momento.</p>
            </div>

            <!-- Join Us -->
             <div class="bg-primary/10 rounded-3xl p-8 md:p-12 text-center border border-primary/20">
                <h2 class="text-2xl md:text-3xl font-black text-forest dark:text-white mb-4">¿Te apasiona el sector inmobiliario sostenible?</h2>
                <p class="text-leaf mb-8 max-w-2xl mx-auto">Únete a nuestro equipo comprometido con el futuro.</p>
                <button class="bg-primary text-forest font-bold px-8 py-3 rounded-xl hover:bg-white transition-colors shadow-lg">Ver Vacantes</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const agentes = ref([]);
const loading = ref(true);

const fetchAgentes = async () => {
    loading.value = true;
    try {
        console.log('🔍 Fetching agentes from /api/agentes...');
        const response = await axios.get('/api/agentes');
        console.log('✅ Response received:', response);
        console.log('📦 Data:', response.data);
        console.log('🔢 Number of agentes:', response.data.length);
        agentes.value = response.data;
        console.log('✨ Agentes state updated:', agentes.value);
    } catch (error) {
        console.error('❌ Error cargando agentes:', error);
        console.error('Error details:', error.response);
    } finally {
        loading.value = false;
        console.log('🏁 Loading finished. Agentes length:', agentes.value.length);
    }
};

const getAgentImage = (agente) => {
    // Generar imagen con iniciales del agente
    const nombre = agente.usuario?.nombre || 'Agente';
    return `https://ui-avatars.com/api/?name=${encodeURIComponent(nombre)}&background=13ec5b&color=0d1b12&size=512`;
};

const getAgentQuote = (agente) => {
    const quotes = [
        'La verdadera sostenibilidad empieza en el hogar.',
        'Encontrar la casa perfecta es un viaje que hacemos juntos.',
        'Cada propiedad cuenta una historia única.',
        'Tu nuevo hogar eco-friendly te espera.',
    ];
    // Usar ID para seleccionar quote de manera consistente
    return quotes[agente.id_agente % quotes.length];
};

onMounted(() => {
    fetchAgentes();
});
</script>

