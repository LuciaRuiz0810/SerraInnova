<template>
    <div class="organic-bg min-h-screen pt-24 pb-16">
        <div class="container mx-auto px-6">
            <!-- Header -->
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="inline-block px-3 py-1 bg-primary text-forest text-[10px] font-bold uppercase tracking-widest rounded-full w-fit mb-4">Sobre Nosotros</span>
                <h1 class="text-3xl md:text-5xl font-black text-forest dark:text-white mb-6 tracking-tight">Construyendo un futuro sostenible</h1>
                <p class="text-leaf/80 text-lg font-medium leading-relaxed">
                    En SerraInnova, creemos que el sector inmobiliario puede ser un motor de cambio positivo. 
                    Nos especializamos en conectar personas con hogares que respetan el medio ambiente.
                </p>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center mb-20">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-leaf/10 group">
                    <img src="https://images.unsplash.com/photo-1518531933037-91b2f5d2294a?q=80&w=2070" 
                         alt="Equipo SerraInnova" 
                         class="w-full h-auto">
                </div>
                <div class="space-y-8">
                    <div class="flex gap-4">
                        <div class="size-12 rounded-xl bg-primary/20 flex items-center justify-center shrink-0 text-primary">
                            <span class="material-symbols-outlined text-2xl">eco</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-forest dark:text-white mb-2">Compromiso Verde</h3>
                            <p class="text-forest/70 dark:text-white/70">Solo gestionamos propiedades con certificado energético B o superior.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="size-12 rounded-xl bg-primary/20 flex items-center justify-center shrink-0 text-primary">
                            <span class="material-symbols-outlined text-2xl">diversity_3</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-forest dark:text-white mb-2">Trato Humano</h3>
                            <p class="text-forest/70 dark:text-white/70">Acompañamos a nuestros clientes en cada paso del proceso.</p>
                        </div>
                    </div>
                    <div class="flex gap-4">
                        <div class="size-12 rounded-xl bg-primary/20 flex items-center justify-center shrink-0 text-primary">
                            <span class="material-symbols-outlined text-2xl">verified</span>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-forest dark:text-white mb-2">Transparencia Total</h3>
                            <p class="text-forest/70 dark:text-white/70">Sin letra pequeña. Te explicamos cada detalle con claridad.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="bg-forest rounded-3xl p-12 text-center text-white relative overflow-hidden">
                <div class="relative z-10 grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div>
                        <p class="text-4xl md:text-5xl font-black text-primary mb-2">150+</p>
                        <p class="text-sm uppercase tracking-widest opacity-70">Casas Eco Vendidas</p>
                    </div>
                    <div>
                        <p class="text-4xl md:text-5xl font-black text-primary mb-2">98%</p>
                        <p class="text-sm uppercase tracking-widest opacity-70">Clientes Felices</p>
                    </div>
                    <div>
                        <p class="text-4xl md:text-5xl font-black text-primary mb-2">5K+</p>
                        <p class="text-sm uppercase tracking-widest opacity-70">Toneladas CO2 Ahorradas</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
</script>
