<template>
    <div class="bg-white dark:bg-background-dark/40 rounded-3xl overflow-hidden shadow-2xl border-2 border-leaf/10 hover:border-primary/30 transition-all duration-500">
        <!-- Header -->
        <div class="bg-gradient-to-br from-forest to-leaf p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 opacity-10 text-primary scale-150">
                <span class="material-symbols-outlined text-[120px]">calculate</span>
            </div>
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-3">
                    <span class="material-symbols-outlined text-primary text-3xl">eco</span>
                    <h2 class="text-2xl md:text-3xl font-black text-white">Calculadora de Impacto</h2>
                </div>
                <p class="text-white/80 text-sm md:text-base">
                    Descubre el potencial de ahorro energético de tu vivienda y recibe recomendaciones personalizadas
                </p>
            </div>
        </div>

        <!-- Form Section -->
        <div class="p-6 md:p-8">
            <form @submit.prevent="calculateImpact" class="space-y-6">
                <!-- Metros Cuadrados -->
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-bold text-forest dark:text-white uppercase tracking-wider">
                        <span class="material-symbols-outlined text-leaf">square_foot</span>
                        Superficie de tu vivienda
                    </label>
                    <div class="relative">
                        <input 
                            v-model.number="formData.squareMeters"
                            type="number"
                            min="20"
                            max="1000"
                            step="1"
                            required
                            class="w-full bg-sand dark:bg-background-dark border-2 border-leaf/20 rounded-xl px-4 py-4 text-forest dark:text-white font-semibold focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                            placeholder="Ej: 120"
                        />
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-leaf font-bold">m²</span>
                    </div>
                    <p class="text-xs text-leaf/70 ml-1">Entre 20 y 1000 m²</p>
                </div>

                <!-- Consumo Energético Actual -->
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-bold text-forest dark:text-white uppercase tracking-wider">
                        <span class="material-symbols-outlined text-leaf">bolt</span>
                        Consumo energético mensual
                    </label>
                    <div class="relative">
                        <input 
                            v-model.number="formData.monthlyConsumption"
                            type="number"
                            min="0"
                            max="10000"
                            step="10"
                            required
                            class="w-full bg-sand dark:bg-background-dark border-2 border-leaf/20 rounded-xl px-4 py-4 text-forest dark:text-white font-semibold focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                            placeholder="Ej: 250"
                        />
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-leaf font-bold">kWh</span>
                    </div>
                    <p class="text-xs text-leaf/70 ml-1">Revisa tu factura eléctrica mensual</p>
                </div>

                <!-- Tipo de Calefacción -->
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-bold text-forest dark:text-white uppercase tracking-wider">
                        <span class="material-symbols-outlined text-leaf">thermostat</span>
                        Sistema de calefacción actual
                    </label>
                    <select 
                        v-model="formData.heatingType"
                        required
                        class="w-full bg-sand dark:bg-background-dark border-2 border-leaf/20 rounded-xl px-4 py-4 text-forest dark:text-white font-semibold focus:ring-2 focus:ring-primary focus:border-primary transition-all appearance-none cursor-pointer"
                    >
                        <option value="">Selecciona una opción</option>
                        <option value="gas">Gas Natural</option>
                        <option value="electric">Eléctrica</option>
                        <option value="diesel">Gasóleo</option>
                        <option value="biomass">Biomasa</option>
                        <option value="heat-pump">Bomba de Calor</option>
                    </select>
                </div>

                <!-- Año de Construcción -->
                <div class="space-y-2">
                    <label class="flex items-center gap-2 text-sm font-bold text-forest dark:text-white uppercase tracking-wider">
                        <span class="material-symbols-outlined text-leaf">calendar_month</span>
                        Año de construcción
                    </label>
                    <input 
                        v-model.number="formData.buildYear"
                        type="number"
                        min="1900"
                        :max="currentYear"
                        step="1"
                        required
                        class="w-full bg-sand dark:bg-background-dark border-2 border-leaf/20 rounded-xl px-4 py-4 text-forest dark:text-white font-semibold focus:ring-2 focus:ring-primary focus:border-primary transition-all"
                        placeholder="Ej: 1985"
                    />
                    <p class="text-xs text-leaf/70 ml-1">Esto nos ayuda a estimar el aislamiento</p>
                </div>

                <!-- Submit Button -->
                <button 
                    type="submit"
                    class="w-full bg-gradient-to-r from-forest to-leaf text-primary font-black py-5 px-6 rounded-xl flex items-center justify-center gap-3 hover:shadow-2xl hover:scale-105 transition-all duration-300 glow-primary-hover uppercase tracking-wider text-sm"
                >
                    <span class="material-symbols-outlined text-2xl">analytics</span>
                    Calcular Potencial de Ahorro
                </button>
            </form>

            <!-- Results Section -->
            <transition name="fade-slide">
                <div v-if="showResults" class="mt-8 space-y-6">
                    <!-- Divider -->
                    <div class="border-t-2 border-leaf/10 pt-8">
                        <h3 class="text-xl font-black text-forest dark:text-white mb-6 flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">insights</span>
                            Resultados del Análisis
                        </h3>
                    </div>

                    <!-- Key Metrics Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <!-- Current Consumption -->
                        <div class="bg-gradient-to-br from-red-50 to-orange-50 dark:from-red-900/20 dark:to-orange-900/20 rounded-2xl p-5 border-2 border-red-200/50 dark:border-red-700/30">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-red-600 dark:text-red-400 text-sm">trending_up</span>
                                <span class="text-xs font-bold text-red-700 dark:text-red-300 uppercase tracking-wider">Consumo Actual</span>
                            </div>
                            <div class="text-3xl font-black text-red-700 dark:text-red-300">{{ results.currentAnnualConsumption }}</div>
                            <div class="text-xs text-red-600/70 dark:text-red-400/70">kWh/año</div>
                        </div>

                        <!-- Potential Savings -->
                        <div class="bg-gradient-to-br from-primary/10 to-leaf/10 dark:from-primary/20 dark:to-leaf/20 rounded-2xl p-5 border-2 border-primary/30 glow-primary">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-primary text-sm">trending_down</span>
                                <span class="text-xs font-bold text-forest dark:text-white uppercase tracking-wider">Ahorro Potencial</span>
                            </div>
                            <div class="text-3xl font-black text-forest dark:text-white">{{ results.potentialSavings }}%</div>
                            <div class="text-xs text-leaf">{{ results.savingsKwh }} kWh/año</div>
                        </div>

                        <!-- CO2 Reduction -->
                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 rounded-2xl p-5 border-2 border-blue-200/50 dark:border-blue-700/30">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="material-symbols-outlined text-blue-600 dark:text-blue-400 text-sm">co2</span>
                                <span class="text-xs font-bold text-blue-700 dark:text-blue-300 uppercase tracking-wider">Reducción CO₂</span>
                            </div>
                            <div class="text-3xl font-black text-blue-700 dark:text-blue-300">{{ results.co2Reduction }}</div>
                            <div class="text-xs text-blue-600/70 dark:text-blue-400/70">kg CO₂/año</div>
                        </div>
                    </div>

                    <!-- Energy Rating -->
                    <div class="bg-gradient-to-r from-sand to-white dark:from-background-dark/60 dark:to-background-dark/40 rounded-2xl p-6 border-2 border-leaf/10">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h4 class="text-sm font-bold text-forest dark:text-white uppercase tracking-wider mb-1">Calificación Energética</h4>
                                <p class="text-xs text-leaf">Estimación basada en tus datos</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="text-xs font-bold text-forest dark:text-white">Actual:</span>
                                    <div :class="getRatingClass(results.currentRating)" class="px-4 py-1 rounded-lg font-black text-white text-sm">
                                        {{ results.currentRating }}
                                    </div>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="text-xs font-bold text-forest dark:text-white">Potencial:</span>
                                    <div :class="getRatingClass(results.potentialRating)" class="px-4 py-1 rounded-lg font-black text-white text-sm">
                                        {{ results.potentialRating }}
                                    </div>
                                    <span class="material-symbols-outlined text-primary text-xl animate-pulse">arrow_upward</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recommendations -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-black text-forest dark:text-white flex items-center gap-2">
                            <span class="material-symbols-outlined text-primary">construction</span>
                            Servicios de Rehabilitación Recomendados
                        </h4>
                        
                        <div class="space-y-3">
                            <div 
                                v-for="(service, index) in results.recommendations" 
                                :key="index"
                                class="group bg-gradient-to-r from-sand to-white dark:from-background-dark/60 dark:to-background-dark/40 rounded-xl p-5 border-2 border-leaf/10 hover:border-primary/40 hover:shadow-lg transition-all duration-300 cursor-pointer"
                            >
                                <div class="flex items-start gap-4">
                                    <div class="size-12 rounded-xl bg-gradient-to-br from-primary/20 to-leaf/20 flex items-center justify-center flex-shrink-0 group-hover:scale-110 transition-transform">
                                        <span class="material-symbols-outlined text-forest dark:text-primary text-2xl">{{ service.icon }}</span>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-start justify-between mb-2">
                                            <h5 class="font-bold text-forest dark:text-white">{{ service.title }}</h5>
                                            <div class="flex items-center gap-1 bg-primary/20 px-3 py-1 rounded-full">
                                                <span class="material-symbols-outlined text-forest text-xs">priority_high</span>
                                                <span class="text-xs font-black text-forest uppercase">{{ service.priority }}</span>
                                            </div>
                                        </div>
                                        <p class="text-sm text-leaf mb-3">{{ service.description }}</p>
                                        <div class="flex flex-wrap gap-4 text-xs">
                                            <div class="flex items-center gap-1">
                                                <span class="material-symbols-outlined text-primary text-sm">savings</span>
                                                <span class="font-semibold text-forest dark:text-white">Ahorro: {{ service.savings }}</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <span class="material-symbols-outlined text-leaf text-sm">schedule</span>
                                                <span class="font-semibold text-forest dark:text-white">{{ service.timeframe }}</span>
                                            </div>
                                            <div class="flex items-center gap-1">
                                                <span class="material-symbols-outlined text-leaf text-sm">euro</span>
                                                <span class="font-semibold text-forest dark:text-white">{{ service.investment }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- CTA -->
                    <div class="bg-gradient-to-br from-forest to-leaf rounded-2xl p-6 md:p-8 relative overflow-hidden">
                        <div class="absolute top-0 right-0 opacity-10 text-primary scale-150">
                            <span class="material-symbols-outlined text-[100px]">verified</span>
                        </div>
                        <div class="relative z-10 text-center space-y-4">
                            <h4 class="text-xl md:text-2xl font-black text-white">¿Listo para transformar tu hogar?</h4>
                            <p class="text-white/80 text-sm md:text-base">Nuestros expertos pueden ayudarte a implementar estas mejoras</p>
                            <div class="flex flex-col sm:flex-row gap-3 justify-center">
                                <button class="bg-primary text-forest font-bold px-6 py-3 rounded-xl hover:bg-white transition-all hover:scale-105 flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">contact_support</span>
                                    Solicitar Consultoría
                                </button>
                                <button class="border-2 border-white/30 text-white font-bold px-6 py-3 rounded-xl hover:bg-white/10 transition-all flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">download</span>
                                    Descargar Informe
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref, computed } from 'vue';

const currentYear = new Date().getFullYear();

const formData = reactive({
    squareMeters: null,
    monthlyConsumption: null,
    heatingType: '',
    buildYear: null
});

const showResults = ref(false);
const results = reactive({
    currentAnnualConsumption: 0,
    potentialSavings: 0,
    savingsKwh: 0,
    co2Reduction: 0,
    currentRating: '',
    potentialRating: '',
    recommendations: []
});

const calculateImpact = () => {
    // Calculate annual consumption
    const annualConsumption = formData.monthlyConsumption * 12;
    results.currentAnnualConsumption = annualConsumption.toLocaleString('es-ES');

    // Calculate consumption per m²
    const consumptionPerM2 = annualConsumption / formData.squareMeters;

    // Determine building age factor
    const buildingAge = currentYear - formData.buildYear;
    let ageFactor = 1.0;
    if (buildingAge > 40) ageFactor = 1.5;
    else if (buildingAge > 25) ageFactor = 1.3;
    else if (buildingAge > 15) ageFactor = 1.1;
    else if (buildingAge > 5) ageFactor = 1.0;
    else ageFactor = 0.8;

    // Heating type efficiency factor
    const heatingFactors = {
        'gas': 1.2,
        'electric': 1.4,
        'diesel': 1.5,
        'biomass': 0.9,
        'heat-pump': 0.7
    };
    const heatingFactor = heatingFactors[formData.heatingType] || 1.2;

    // Calculate potential savings (30-70% based on factors)
    const baseSavings = 40;
    const additionalSavings = (ageFactor - 0.8) * 20 + (heatingFactor - 0.7) * 15;
    const totalSavingsPercent = Math.min(70, Math.max(25, Math.round(baseSavings + additionalSavings)));
    
    results.potentialSavings = totalSavingsPercent;
    results.savingsKwh = Math.round(annualConsumption * (totalSavingsPercent / 100)).toLocaleString('es-ES');

    // Calculate CO2 reduction (0.3 kg CO2 per kWh average)
    const co2PerKwh = 0.3;
    results.co2Reduction = Math.round(annualConsumption * (totalSavingsPercent / 100) * co2PerKwh).toLocaleString('es-ES');

    // Determine energy ratings
    results.currentRating = getEnergyRating(consumptionPerM2);
    const improvedConsumption = consumptionPerM2 * (1 - totalSavingsPercent / 100);
    results.potentialRating = getEnergyRating(improvedConsumption);

    // Generate recommendations
    results.recommendations = generateRecommendations(buildingAge, formData.heatingType, consumptionPerM2);

    showResults.value = true;

    // Scroll to results
    setTimeout(() => {
        const resultsElement = document.querySelector('.fade-slide-enter-active');
        if (resultsElement) {
            resultsElement.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
    }, 100);
};

const getEnergyRating = (consumptionPerM2) => {
    if (consumptionPerM2 < 40) return 'A';
    if (consumptionPerM2 < 60) return 'B';
    if (consumptionPerM2 < 100) return 'C';
    if (consumptionPerM2 < 150) return 'D';
    if (consumptionPerM2 < 200) return 'E';
    if (consumptionPerM2 < 250) return 'F';
    return 'G';
};

const getRatingClass = (rating) => {
    const classes = {
        'A': 'bg-green-600',
        'B': 'bg-lime-500',
        'C': 'bg-yellow-500',
        'D': 'bg-orange-500',
        'E': 'bg-red-500',
        'F': 'bg-red-700',
        'G': 'bg-red-900'
    };
    return classes[rating] || 'bg-gray-500';
};

const generateRecommendations = (buildingAge, heatingType, consumptionPerM2) => {
    const recommendations = [];

    // Insulation recommendation
    if (buildingAge > 20 || consumptionPerM2 > 100) {
        recommendations.push({
            icon: 'home_repair_service',
            title: 'Aislamiento Térmico Integral',
            description: 'Mejora del aislamiento en fachadas, cubiertas y suelos para reducir pérdidas de calor y mejorar el confort térmico.',
            priority: 'Alta',
            savings: '25-40%',
            timeframe: '2-4 semanas',
            investment: '8.000-15.000€'
        });
    }

    // Windows recommendation
    if (buildingAge > 15) {
        recommendations.push({
            icon: 'window',
            title: 'Sustitución de Ventanas',
            description: 'Instalación de ventanas de doble o triple acristalamiento con rotura de puente térmico para eliminar infiltraciones.',
            priority: buildingAge > 30 ? 'Alta' : 'Media',
            savings: '15-25%',
            timeframe: '1-2 semanas',
            investment: '4.000-8.000€'
        });
    }

    // Heating system upgrade
    if (heatingType === 'diesel' || heatingType === 'electric' || heatingType === 'gas') {
        recommendations.push({
            icon: 'heat_pump',
            title: 'Bomba de Calor Aerotérmica',
            description: 'Sistema de climatización eficiente que aprovecha la energía del aire exterior, compatible con energía solar.',
            priority: heatingType === 'diesel' ? 'Alta' : 'Media',
            savings: '30-50%',
            timeframe: '1-2 semanas',
            investment: '6.000-12.000€'
        });
    }

    // Solar panels
    if (consumptionPerM2 > 80) {
        recommendations.push({
            icon: 'solar_power',
            title: 'Instalación Fotovoltaica',
            description: 'Paneles solares para autoconsumo con posibilidad de baterías de almacenamiento y compensación de excedentes.',
            priority: 'Alta',
            savings: '40-60%',
            timeframe: '2-3 semanas',
            investment: '5.000-10.000€'
        });
    }

    // Smart home
    recommendations.push({
        icon: 'home_app_logo',
        title: 'Domótica y Control Inteligente',
        description: 'Sistema de gestión energética inteligente con termostatos programables y monitorización en tiempo real.',
        priority: 'Baja',
        savings: '10-15%',
        timeframe: '3-5 días',
        investment: '1.500-3.000€'
    });

    // LED lighting
    if (buildingAge > 10) {
        recommendations.push({
            icon: 'lightbulb',
            title: 'Iluminación LED Eficiente',
            description: 'Sustitución completa de iluminación por tecnología LED de bajo consumo con sensores de presencia.',
            priority: 'Baja',
            savings: '5-10%',
            timeframe: '1-2 días',
            investment: '800-1.500€'
        });
    }

    return recommendations;
};
</script>

<style scoped>
/* Smooth transitions */
.fade-slide-enter-active,
.fade-slide-leave-active {
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.fade-slide-enter-from {
    opacity: 0;
    transform: translateY(20px);
}

.fade-slide-leave-to {
    opacity: 0;
    transform: translateY(-20px);
}

/* Remove spinner from number inputs */
input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    margin: 0;
}

input[type="number"] {
    -moz-appearance: textfield;
}

/* Custom select arrow */
select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%234c9a66'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 1rem center;
    background-size: 1.5em 1.5em;
    padding-right: 3rem;
}
</style>
