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
                        <!-- Tabs for Search -->
                        <div class="w-full flex border-b-2 border-primary/10 mb-4">
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
                                    <option value="">Casas Eco</option>
                                    <option value="Casa">Áticos</option>
                                    <option value="Apartamento">Villas</option>
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
                    <!-- Property Card 1 -->
                    <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                        <div class="group bg-white dark:bg-background-dark/40 rounded-3xl overflow-hidden shadow-xl border-2 border-leaf/5 hover:shadow-2xl hover:border-primary/30 hover:-translate-y-2 transition-all duration-500 h-full hover:scale-[1.02]">
                        <div class="relative h-64 overflow-hidden">
                            <div class="absolute top-4 left-4 z-10 bg-gradient-to-r from-primary to-leaf text-forest text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg glow-primary">
                                Sostenible A++
                            </div>
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuCCET_VQhQ0iCl_oK4WIotHpT8a8LMtB9m0ByMHFJrPmvpNxkgynrQxydM-p5P6fF5z_p-VZyVA9Svdf4f1BQ_QQFHH9DaczSz2MyLECn5X9T5gwZcRX2Ctiy0NVmXzG7_jDWWxoJykQiHCjXqpx3Ab3ObLW3CyeYIWEEiTLqHLuupiqEfM7ZnegscWYcxnU8t7K9LJRFh8r8Y8WKZKWI2O0Vzzj8NemXGH-ruKiQJYaPCPI1X_ObTDLAa6tgaPGzCetDTz4uMSN3M" alt="Villa Natura II">
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-forest dark:text-white">Villa Natura II</h3>
                                <p class="text-xl font-black text-leaf">425.000€</p>
                            </div>
                            <div class="flex items-center gap-1 text-leaf/70 text-sm mb-6">
                                <span class="material-symbols-outlined text-sm">location_on</span>
                                Serra de Tramuntana, Mallorca
                            </div>
                            <div class="flex justify-between border-t border-leaf/10 pt-4">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-leaf">square_foot</span>
                                    <span class="text-sm font-semibold">180 m²</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-leaf">bed</span>
                                    <span class="text-sm font-semibold">3 Hab</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-leaf">energy_savings_leaf</span>
                                    <span class="text-sm font-semibold">Passivhaus</span>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Property Card 2 -->
                    <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                    <div class="group bg-white dark:bg-background-dark/40 rounded-2xl overflow-hidden shadow-lg border border-leaf/5 hover:shadow-2xl transition-all">
                        <div class="relative h-64 overflow-hidden">
                            <div class="absolute top-4 left-4 z-10 bg-gradient-to-r from-primary to-leaf text-forest text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg glow-primary">
                                Obra Nueva
                            </div>
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuD_j-cUSKl6Ozt8U-3y10-1kQ8ciijZFTaGFnTyqV1yZ6IGKQYMWaYMLID9rLKWm8ykLTbDnOrj8d0tGObEAaUIibNgZPiQ3_qGnlcrKaxY78YbQxmXZecY-j4eBo4lvZzhtI08cotAHYu-faDoGNoKQ5bWGfo1q5GMfBt5bn9hXwrPMV0rb3GxYd_kJzNxL9KzjMq3ByYf5y1MJe_95DfCfcU4z2VX6zKCneIKPs7wx6IGjlw3JF_1MXHS1e_fTch_lj06tZh6ULs" alt="Refugio Forestal">
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-forest dark:text-white">Refugio Forestal</h3>
                                <p class="text-xl font-black text-leaf">290.000€</p>
                            </div>
                            <div class="flex items-center gap-1 text-leaf/70 text-sm mb-6">
                                <span class="material-symbols-outlined text-sm">location_on</span>
                                Valle de Arán, Pirineos
                            </div>
                            <div class="flex justify-between border-t border-leaf/10 pt-4">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-leaf">square_foot</span>
                                    <span class="text-sm font-semibold">120 m²</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-leaf">bed</span>
                                    <span class="text-sm font-semibold">2 Hab</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-leaf">solar_power</span>
                                    <span class="text-sm font-semibold">Self-Suffic</span>
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <!-- Property Card 3 -->
                    <div class="w-full md:w-1/2 lg:w-1/3 px-4 mb-8">
                    <div class="group bg-white dark:bg-background-dark/40 rounded-2xl overflow-hidden shadow-lg border border-leaf/5 hover:shadow-2xl transition-all">
                        <div class="relative h-64 overflow-hidden">
                            <div class="absolute top-4 left-4 z-10 bg-gradient-to-r from-primary to-leaf text-forest text-[10px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-lg glow-primary">
                                Alquiler Eco
                            </div>
                            <img class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110" src="https://lh3.googleusercontent.com/aida-public/AB6AXuAG82VebUhKsUbt4qW0DnjRc9rie3Dmy3PkivoEmYb8rXKF3YLcEPacoR8_Fv8uikaE1S2-VOIdo88xDV_NL4nwjTmUI5aa0n2i6S6qB6xnf0uTbpQKyZ8eoYntvYswr8KsEyhaxk7hSH1HFYHC7qKiXPbZrxLeLykhTk8iA28tsuPB5r0tmCvNRcme0YfGAThpgfSi7pdI4V5tfg26-T_7VsjUsDJFktCvbN35fpNvwA20V1jl9IqUWcn72lEW2kqz6fDpKXxQTHg" alt="Loft Bio-Climático">
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <h3 class="text-xl font-bold text-forest dark:text-white">Loft Bio-Climático</h3>
                                <p class="text-xl font-black text-leaf">1.450€/mes</p>
                            </div>
                            <div class="flex items-center gap-1 text-leaf/70 text-sm mb-6">
                                <span class="material-symbols-outlined text-sm">location_on</span>
                                Maresme, Barcelona
                            </div>
                            <div class="flex justify-between border-t border-leaf/10 pt-4">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-leaf">square_foot</span>
                                    <span class="text-sm font-semibold">95 m²</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-leaf">bed</span>
                                    <span class="text-sm font-semibold">1 Hab</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-leaf">water_drop</span>
                                    <span class="text-sm font-semibold">Eco-Friendly</span>
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
import { reactive } from 'vue';
import { useRouter } from 'vue-router';

const router = useRouter();

const filters = reactive({
    tipo: '',
    ubicacion: '',
    operacion: 'venta'
});

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
</script>
