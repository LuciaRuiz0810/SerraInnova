<template>
    <div class="bg-white dark:bg-background-dark/40 rounded-2xl p-6 shadow-lg border-2 border-leaf/10">
        <h4 class="text-lg font-bold text-forest dark:text-white mb-6 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">checklist</span>
            Características Sostenibles
        </h4>
        
        <div class="flex flex-wrap gap-x-8 gap-y-4">
            <!-- Aislamiento -->
            <div v-if="features.aislamiento_termico || features.ventanas_climalit || features.sistema_sate" class="w-full">
                <h5 class="text-xs uppercase font-bold text-leaf mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">foundation</span>
                    Aislamiento
                </h5>
                <div class="flex flex-col gap-2">
                    <CheckItem v-if="features.aislamiento_termico" label="Aislamiento Térmico" />
                    <CheckItem v-if="features.ventanas_climalit" label="Ventanas Climalit" />
                    <CheckItem v-if="features.sistema_sate" label="Sistema SATE" />
                </div>
            </div>
            
            <!-- Energía -->
            <div v-if="features.aerotermia || features.placas_solares" class="w-full">
                <h5 class="text-xs uppercase font-bold text-leaf mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">solar_power</span>
                    Energía Renovable
                </h5>
                <div class="flex flex-col gap-2">
                    <CheckItem v-if="features.aerotermia" label="Aerotermia" />
                    <CheckItem v-if="features.placas_solares" label="Paneles Solares" />
                </div>
            </div>
            
            <!-- Agua -->
            <div v-if="features.recuperacion_pluviales" class="w-full">
                <h5 class="text-xs uppercase font-bold text-leaf mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">water_drop</span>
                    Gestión de Agua
                </h5>
                <div class="flex flex-col gap-2">
                    <CheckItem label="Recuperación Pluvial" />
                </div>
            </div>
            
            <!-- Materiales -->
            <div v-if="features.pinturas_ecologicas || features.maderas_certificadas" class="w-full">
                <h5 class="text-xs uppercase font-bold text-leaf mb-3 flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm">palette</span>
                    Materiales Ecológicos
                </h5>
                <div class="flex flex-col gap-2">
                    <CheckItem v-if="features.pinturas_ecologicas" label="Pinturas Ecológicas" />
                    <CheckItem v-if="features.maderas_certificadas" label="Maderas Certificadas" />
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
defineProps({
    features: {
        type: Object,
        default: () => ({
            aislamiento_termico: false,
            ventanas_climalit: false,
            sistema_sate: false,
            aerotermia: false,
            placas_solares: false,
            recuperacion_pluviales: false,
            pinturas_ecologicas: false,
            maderas_certificadas: false
        })
    }
});
</script>

<script>
export default {
    components: {
        CheckItem: {
            props: ['label'],
            template: `
                <div class="flex items-center gap-3 text-sm">
                    <div class="flex-shrink-0 w-5 h-5 rounded-full bg-primary/20 flex items-center justify-center">
                        <span class="material-symbols-outlined text-primary text-xs">check</span>
                    </div>
                    <span class="text-forest dark:text-white font-medium">{{ label }}</span>
                </div>
            `
        }
    }
};
</script>
