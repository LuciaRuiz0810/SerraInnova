<template>
    <div class="bg-gradient-to-br from-forest to-leaf rounded-2xl p-6 shadow-xl text-white relative overflow-hidden">
        <div class="absolute top-0 right-0 opacity-10 text-primary scale-150">
            <span class="material-symbols-outlined text-[80px]">public</span>
        </div>
        
        <div class="relative z-10">
            <div class="flex items-center gap-2 mb-3">
                <span class="material-symbols-outlined text-primary">co2</span>
                <h4 class="text-sm font-bold uppercase tracking-wider">Huella de Carbono</h4>
            </div>
            
            <div class="mb-4">
                <div class="text-4xl font-black">{{ annualCo2 }}</div>
                <div class="text-xs opacity-80">kg CO₂/año</div>
            </div>
            
            <div v-if="savings > 0" class="bg-white/20 backdrop-blur-sm rounded-xl p-3 border border-white/30">
                <div class="flex items-center gap-2 mb-1">
                    <span class="material-symbols-outlined text-primary text-sm">trending_down</span>
                    <span class="text-xs font-bold">Ahorro vs. Estándar</span>
                </div>
                <div class="text-2xl font-black text-primary">-{{ savings }} kg</div>
                <div class="text-xs opacity-80">{{ savingsPercentage }}% menos emisiones</div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    annualCo2: {
        type: Number,
        required: true
    },
    savings: {
        type: Number,
        default: 0
    }
});

const savingsPercentage = computed(() => {
    if (props.savings === 0) return 0;
    const standard = props.annualCo2 + props.savings;
    return Math.round((props.savings / standard) * 100);
});
</script>
