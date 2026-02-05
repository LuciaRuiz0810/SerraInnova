<template>
    <div class="glass-effect dark:glass-effect-dark rounded-3xl p-8 border-2 border-primary/20 shadow-2xl">
        <div class="flex items-center gap-3 mb-6">
            <span class="material-symbols-outlined text-primary text-4xl">eco</span>
            <h3 class="text-2xl font-bold gradient-text">Ficha Técnica Verde</h3>
        </div>
        
        <div class="flex flex-wrap gap-6 mb-8">
            <EnergyLabel :rating="certificacion" />
            <CarbonFootprint :annual-co2="huellaCarbono" :savings="ahorroCo2" />
        </div>
        
        <SustainabilityChecklist v-if="caracteristicas" :features="caracteristicas" />
        
        <!-- Certificaciones Externas -->
        <div v-if="certificacionesExternas && certificacionesExternas.length > 0" class="mt-8 pt-6 border-t-2 border-primary/10">
            <h4 class="text-lg font-bold text-forest dark:text-white mb-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-primary">workspace_premium</span>
                Certificaciones Externas
            </h4>
            <div class="flex flex-wrap gap-3">
                <span v-for="cert in certificacionesExternas" 
                      :key="cert"
                      class="px-4 py-2 bg-gradient-to-r from-primary to-leaf text-forest font-bold text-sm rounded-full shadow-lg glow-primary">
                    {{ cert }}
                </span>
            </div>
        </div>
        
        <!-- Tipo de Energía -->
        <div v-if="tipoEnergia" class="mt-6 bg-leaf/10 rounded-xl p-4 border border-leaf/20">
            <div class="flex items-center gap-2 text-sm">
                <span class="material-symbols-outlined text-primary">bolt</span>
                <span class="font-bold text-forest dark:text-white">Fuente de Energía:</span>
                <span class="text-leaf capitalize">{{ tipoEnergia }}</span>
            </div>
        </div>
    </div>
</template>

<script setup>
import EnergyLabel from './EnergyLabel.vue';
import CarbonFootprint from './CarbonFootprint.vue';
import SustainabilityChecklist from './SustainabilityChecklist.vue';

defineProps({
    certificacion: {
        type: String,
        default: 'A'
    },
    huellaCarbono: {
        type: Number,
        required: true
    },
    ahorroCo2: {
        type: Number,
        default: 0
    },
    caracteristicas: {
        type: Object,
        default: null
    },
    certificacionesExternas: {
        type: Array,
        default: () => []
    },
    tipoEnergia: {
        type: String,
        default: null
    }
});
</script>
