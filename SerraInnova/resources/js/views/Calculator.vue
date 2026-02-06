<template>
    <main class="organic-bg">
        <!-- Hero Section -->
        <section class="relative px-4 pt-12 pb-16 md:px-10 lg:px-20">
            <div class="mx-auto max-w-[1200px]">
                <div class="text-center mb-12">
                    <div class="inline-flex items-center gap-2 bg-primary/10 px-4 py-2 rounded-full mb-4">
                        <span class="material-symbols-outlined text-primary text-sm">eco</span>
                        <span class="text-xs font-bold text-forest dark:text-white uppercase tracking-wider">Herramienta Gratuita</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-forest dark:text-white mb-4 leading-tight">
                        Calcula el Potencial de tu Hogar
                    </h1>
                    <p class="text-lg md:text-xl text-leaf max-w-3xl mx-auto">
                        Descubre cuánto puedes ahorrar en energía y reduce tu huella de carbono con nuestras recomendaciones personalizadas de rehabilitación sostenible
                    </p>
                </div>
            </div>
        </section>

        <!-- Calculator Section -->
        <section class="px-4 pb-20 md:px-10 lg:px-20">
            <div class="mx-auto max-w-[900px]">
                <ImpactCalculator />
            </div>
        </section>

        <!-- Benefits Section -->
        <section class="px-4 py-16 md:px-10 lg:px-20 bg-sand dark:bg-background-dark/20">
            <div class="mx-auto max-w-[1200px]">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-black text-forest dark:text-white mb-4">
                        ¿Por qué rehabilitar tu vivienda?
                    </h2>
                    <p class="text-leaf text-lg">
                        La rehabilitación energética es una inversión que se paga sola
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Benefit 1 -->
                    <div class="bg-white dark:bg-background-dark/40 rounded-2xl p-6 border-2 border-leaf/10 hover:border-primary/30 hover:shadow-xl transition-all duration-300 group">
                        <div class="size-14 rounded-xl bg-gradient-to-br from-primary/20 to-leaf/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-forest dark:text-primary text-3xl">savings</span>
                        </div>
                        <h3 class="text-xl font-bold text-forest dark:text-white mb-2">Ahorro Económico</h3>
                        <p class="text-sm text-leaf">
                            Reduce tu factura energética hasta un 70% con las mejoras adecuadas
                        </p>
                    </div>

                    <!-- Benefit 2 -->
                    <div class="bg-white dark:bg-background-dark/40 rounded-2xl p-6 border-2 border-leaf/10 hover:border-primary/30 hover:shadow-xl transition-all duration-300 group">
                        <div class="size-14 rounded-xl bg-gradient-to-br from-primary/20 to-leaf/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-forest dark:text-primary text-3xl">trending_up</span>
                        </div>
                        <h3 class="text-xl font-bold text-forest dark:text-white mb-2">Revalorización</h3>
                        <p class="text-sm text-leaf">
                            Aumenta el valor de tu propiedad hasta un 25% con certificación energética A
                        </p>
                    </div>

                    <!-- Benefit 3 -->
                    <div class="bg-white dark:bg-background-dark/40 rounded-2xl p-6 border-2 border-leaf/10 hover:border-primary/30 hover:shadow-xl transition-all duration-300 group">
                        <div class="size-14 rounded-xl bg-gradient-to-br from-primary/20 to-leaf/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-forest dark:text-primary text-3xl">ac_unit</span>
                        </div>
                        <h3 class="text-xl font-bold text-forest dark:text-white mb-2">Mayor Confort</h3>
                        <p class="text-sm text-leaf">
                            Disfruta de una temperatura ideal todo el año sin corrientes ni humedades
                        </p>
                    </div>

                    <!-- Benefit 4 -->
                    <div class="bg-white dark:bg-background-dark/40 rounded-2xl p-6 border-2 border-leaf/10 hover:border-primary/30 hover:shadow-xl transition-all duration-300 group">
                        <div class="size-14 rounded-xl bg-gradient-to-br from-primary/20 to-leaf/20 flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                            <span class="material-symbols-outlined text-forest dark:text-primary text-3xl">public</span>
                        </div>
                        <h3 class="text-xl font-bold text-forest dark:text-white mb-2">Impacto Ambiental</h3>
                        <p class="text-sm text-leaf">
                            Contribuye a la lucha contra el cambio climático reduciendo emisiones de CO₂
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Subsidies Section -->
        <section class="px-4 py-16 md:px-10 lg:px-20">
            <div class="mx-auto max-w-[1200px]">
                <div class="bg-gradient-to-br from-forest to-leaf rounded-3xl p-8 md:p-12 relative overflow-hidden">
                    <div class="absolute top-0 right-0 opacity-10 text-primary scale-150">
                        <span class="material-symbols-outlined text-[150px]">account_balance</span>
                    </div>
                    
                    <div class="relative z-10">
                        <div class="max-w-3xl">
                            <div class="flex items-center gap-2 mb-4">
                                <span class="material-symbols-outlined text-primary text-3xl">euro</span>
                                <h2 class="text-3xl md:text-4xl font-black text-white">Ayudas y Subvenciones Disponibles</h2>
                            </div>
                            <p class="text-white/80 text-lg mb-8">
                                Aprovecha los programas de ayudas europeos, estatales y autonómicos para financiar tu rehabilitación energética
                            </p>
                            
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                    <div class="text-3xl font-black text-primary mb-1">40-80%</div>
                                    <div class="text-sm text-white/80">Subvención sobre inversión</div>
                                </div>
                                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                    <div class="text-3xl font-black text-primary mb-1">60%</div>
                                    <div class="text-sm text-white/80">Deducción IRPF</div>
                                </div>
                                <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 border border-white/20">
                                    <div class="text-3xl font-black text-primary mb-1">0%</div>
                                    <div class="text-sm text-white/80">Interés en préstamos ICO</div>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-4">
                                <button class="bg-primary text-forest font-bold px-8 py-4 rounded-xl hover:bg-white transition-all hover:scale-105 flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">info</span>
                                    Más Información sobre Ayudas
                                </button>
                                <button class="border-2 border-white/30 text-white font-bold px-8 py-4 rounded-xl hover:bg-white/10 transition-all flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined">contact_support</span>
                                    Asesoramiento Gratuito
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="px-4 py-16 md:px-10 lg:px-20 bg-sand dark:bg-background-dark/20">
            <div class="mx-auto max-w-[900px]">
                <div class="text-center mb-12">
                    <h2 class="text-3xl md:text-4xl font-black text-forest dark:text-white mb-4">
                        Preguntas Frecuentes
                    </h2>
                </div>

                <div class="space-y-4">
                    <details class="group bg-white dark:bg-background-dark/40 rounded-2xl border-2 border-leaf/10 overflow-hidden">
                        <summary class="cursor-pointer p-6 font-bold text-forest dark:text-white flex items-center justify-between hover:bg-sand/50 dark:hover:bg-background-dark/60 transition-colors">
                            <span>¿Cuánto tiempo tarda una rehabilitación energética completa?</span>
                            <span class="material-symbols-outlined text-leaf group-open:rotate-180 transition-transform">expand_more</span>
                        </summary>
                        <div class="px-6 pb-6 text-leaf">
                            Dependiendo del alcance, una rehabilitación puede tardar entre 2 y 8 semanas. Las mejoras básicas como cambio de ventanas o instalación de aerotermia pueden completarse en 1-2 semanas, mientras que proyectos integrales con aislamiento completo requieren más tiempo.
                        </div>
                    </details>

                    <details class="group bg-white dark:bg-background-dark/40 rounded-2xl border-2 border-leaf/10 overflow-hidden">
                        <summary class="cursor-pointer p-6 font-bold text-forest dark:text-white flex items-center justify-between hover:bg-sand/50 dark:hover:bg-background-dark/60 transition-colors">
                            <span>¿Puedo vivir en mi casa durante las obras?</span>
                            <span class="material-symbols-outlined text-leaf group-open:rotate-180 transition-transform">expand_more</span>
                        </summary>
                        <div class="px-6 pb-6 text-leaf">
                            En la mayoría de los casos sí, especialmente si las obras son por fases. Para intervenciones en fachadas exteriores o instalaciones, generalmente no es necesario desalojar la vivienda. Te informaremos detalladamente del proceso antes de comenzar.
                        </div>
                    </details>

                    <details class="group bg-white dark:bg-background-dark/40 rounded-2xl border-2 border-leaf/10 overflow-hidden">
                        <summary class="cursor-pointer p-6 font-bold text-forest dark:text-white flex items-center justify-between hover:bg-sand/50 dark:hover:bg-background-dark/60 transition-colors">
                            <span>¿Cuándo empiezo a ver el ahorro en mi factura?</span>
                            <span class="material-symbols-outlined text-leaf group-open:rotate-180 transition-transform">expand_more</span>
                        </summary>
                        <div class="px-6 pb-6 text-leaf">
                            El ahorro es inmediato desde el primer mes tras completar las mejoras. Con un aislamiento adecuado y sistemas eficientes, muchos clientes reportan reducciones del 40-60% en sus facturas energéticas desde el primer invierno.
                        </div>
                    </details>

                    <details class="group bg-white dark:bg-background-dark/40 rounded-2xl border-2 border-leaf/10 overflow-hidden">
                        <summary class="cursor-pointer p-6 font-bold text-forest dark:text-white flex items-center justify-between hover:bg-sand/50 dark:hover:bg-background-dark/60 transition-colors">
                            <span>¿Qué garantías ofrecen en las instalaciones?</span>
                            <span class="material-symbols-outlined text-leaf group-open:rotate-180 transition-transform">expand_more</span>
                        </summary>
                        <div class="px-6 pb-6 text-leaf">
                            Todos nuestros trabajos cuentan con garantía mínima de 2 años en mano de obra y hasta 10 años en materiales según el fabricante. Los equipos de aerotermia y paneles solares suelen tener garantías de 5-10 años del fabricante.
                        </div>
                    </details>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
import ImpactCalculator from '../components/sustainability/ImpactCalculator.vue';
</script>
