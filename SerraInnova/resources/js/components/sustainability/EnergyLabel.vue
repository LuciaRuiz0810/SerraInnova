<template>
    <div class="inline-flex items-center gap-3 bg-white dark:bg-background-dark/40 rounded-2xl p-4 shadow-lg border-2 glow-primary" :style="{ borderColor: ratingColor }">
        <div class="relative">
            <div class="w-16 h-16 rounded-xl flex items-center justify-center text-2xl font-black shadow-inner transition-all duration-500 hover:scale-110"
                 :style="{ background: `linear-gradient(135deg, ${ratingColor}, ${darkenColor(ratingColor)})` }">
                <span class="text-forest">{{ rating }}</span>
            </div>
            <div class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-primary animate-pulse"></div>
        </div>
        <div class="flex flex-col">
            <span class="text-xs uppercase font-bold tracking-wider text-leaf">Certificación</span>
            <span class="text-sm font-semibold text-forest dark:text-white">{{ ratingText }}</span>
        </div>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    rating: {
        type: String,
        default: 'A',
        validator: (value) => ['A', 'B', 'C', 'D', 'E', 'F', 'G'].includes(value)
    }
});

const ratingColors = {
    'A': '#13ec5b',
    'B': '#4c9a66',
    'C': '#f4e04d',
    'D': '#f9a825',
    'E': '#ff8c00',
    'F': '#ff6347',
    'G': '#dc143c'
};

const ratingTexts = {
    'A': 'Muy Eficiente',
    'B': 'Eficiente',
    'C': 'Moderada',
    'D': 'Media',
    'E': 'Normal',
    'F': 'Poco Eficiente',
    'G': 'Ineficiente'
};

const ratingColor = computed(() => ratingColors[props.rating] || '#cccccc');
const ratingText = computed(() => ratingTexts[props.rating] || 'Desconocida');

const darkenColor = (color) => {
    // Simple darkening function
    const num = parseInt(color.replace('#', ''), 16);
    const amt = -30;
    const R = (num >> 16) + amt;
    const G = (num >> 8 & 0x00FF) + amt;
    const B = (num & 0x0000FF) + amt;
    return '#' + (0x1000000 + (R < 255 ? R < 1 ? 0 : R : 255) * 0x10000 +
        (G < 255 ? G < 1 ? 0 : G : 255) * 0x100 +
        (B < 255 ? B < 1 ? 0 : B : 255))
        .toString(16).slice(1);
};
</script>

<style scoped>
@keyframes pulse-glow {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.animate-pulse {
    animation: pulse-glow 2s ease-in-out infinite;
}
</style>
