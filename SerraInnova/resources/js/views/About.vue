<template>
    <div class="organic-bg min-h-screen pt-24 pb-16">
        <div class="container mx-auto px-6">
            <!-- Header -->
            <div class="text-center max-w-3xl mx-auto mb-20">
                <span class="inline-block px-4 py-1.5 bg-primary/20 text-forest text-[11px] font-black uppercase tracking-[0.2em] rounded-full mb-6 border border-primary/30">Nosotros</span>
                <h1 class="text-4xl md:text-6xl font-black text-forest dark:text-white mb-8 tracking-tight leading-tight">
                    Hacia un futuro <span class="text-primary italic">regenerativo</span>
                </h1>
                <p class="text-leaf/90 text-lg md:text-xl font-medium leading-relaxed">
                    SerraInnova nace de la convicción de que los espacios que habitamos deben ser parte de la solución climática, no del problema.
                </p>
            </div>

            <!-- ¿Quiénes Somos? -->
            <section class="mb-24">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                    <div class="space-y-10">
                        <div>
                            <h2 class="text-3xl font-black text-forest dark:text-white mb-6 flex items-center gap-3">
                                <span class="material-symbols-outlined text-primary text-4xl">diversity_3</span>
                                Quiénes Somos
                            </h2>
                            <p class="text-forest/80 dark:text-white/70 text-lg leading-relaxed mb-6">
                                Somos una consultora inmobiliaria especializada en activos de alta eficiencia energética y construcción sostenible. 
                                Nuestro enfoque va más allá del ladrillo; buscamos el equilibrio entre el bienestar humano y la salud planetaria.
                            </p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="bg-white/40 dark:bg-background-dark/40 backdrop-blur-sm p-6 rounded-3xl border border-leaf/10 hover:border-primary/30 transition-all group">
                                <h3 class="font-black text-forest dark:text-white mb-2 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary group-hover:rotate-12 transition-transform">rocket_launch</span>
                                    Misión
                                </h3>
                                <p class="text-sm text-forest/70 dark:text-white/60">Acelerar la transición hacia el Real Estate sostenible mediante educación y transparencia.</p>
                            </div>
                            <div class="bg-white/40 dark:bg-background-dark/40 backdrop-blur-sm p-6 rounded-3xl border border-leaf/10 hover:border-primary/30 transition-all group">
                                <h3 class="font-black text-forest dark:text-white mb-2 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary group-hover:scale-110 transition-transform">visibility</span>
                                    Visión
                                </h3>
                                <p class="text-sm text-forest/70 dark:text-white/60">Ser el referente europeo en la comercialización de viviendas de impacto positivo.</p>
                            </div>
                        </div>
                    </div>
                    <div class="relative group">
                        <div class="absolute -inset-4 bg-gradient-to-br from-primary/20 to-leaf/20 blur-3xl opacity-0 group-hover:opacity-100 transition-opacity"></div>
                        <img src="https://images.pexels.com/photos/3184291/pexels-photo-3184291.jpeg?auto=compress&cs=tinysrgb&w=1200" 
                             alt="Bosque sostenible" 
                             class="relative rounded-[40px] shadow-2xl border-2 border-primary/20 object-cover h-[500px] w-full">
                    </div>
                </div>
            </section>

            <!-- Valores y Compromisos -->
            <section class="mb-24 py-16 bg-forest/5 dark:bg-white/5 rounded-[40px] px-8 md:px-16 border border-leaf/5">
                <div class="text-center mb-16">
                    <h2 class="text-3xl font-black text-forest dark:text-white">Valores que nos mueven</h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="text-center space-y-4">
                        <div class="size-16 mx-auto rounded-2xl bg-primary/20 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-3xl">verified_user</span>
                        </div>
                        <h4 class="font-black text-xl text-forest dark:text-white">Rigor</h4>
                        <p class="text-sm text-forest/70 dark:text-white/60">Validamos cada dato técnico y certificación para garantizar la máxima transparencia.</p>
                    </div>
                    <div class="text-center space-y-4">
                        <div class="size-16 mx-auto rounded-2xl bg-primary/20 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-3xl">psychology</span>
                        </div>
                        <h4 class="font-black text-xl text-forest dark:text-white">Innovación</h4>
                        <p class="text-sm text-forest/70 dark:text-white/60">Aplicamos las últimas tecnologías en eficiencia para optimizar el ahorro.</p>
                    </div>
                    <div class="text-center space-y-4">
                        <div class="size-16 mx-auto rounded-2xl bg-primary/20 flex items-center justify-center text-primary">
                            <span class="material-symbols-outlined text-3xl">handshake</span>
                        </div>
                        <h4 class="font-black text-xl text-forest dark:text-white">Compromiso</h4>
                        <p class="text-sm text-forest/70 dark:text-white/60">No somos intermediarios, somos aliados en tu búsqueda hacia lo sostenible.</p>
                    </div>
                </div>
            </section>

            <!-- Impacto Ambiental (Stats) -->
            <section class="mb-24">
                <div class="bg-forest rounded-[50px] p-8 md:p-20 relative overflow-hidden shadow-2xl glow-primary">
                    <!-- Decoración abstracta -->
                    <div class="absolute top-0 right-0 opacity-10 text-primary scale-[4] translate-x-1/4 -translate-y-1/4">
                        <span class="material-symbols-outlined text-[150px]">eco</span>
                    </div>
                    
                    <div class="relative z-10 flex flex-col items-center text-center">
                        <div class="inline-flex items-center gap-2 bg-primary/20 px-6 py-2 rounded-full mb-8 border border-primary/30">
                            <span class="material-symbols-outlined text-primary text-sm">analytics</span>
                            <span class="text-xs font-black text-white uppercase tracking-widest">Métricas de Real Impacto</span>
                        </div>
                        
                        <h2 class="text-4xl md:text-6xl font-black text-white mb-12 max-w-4xl leading-tight">
                            Hemos ahorrado más de <span class="text-primary italic">5.247 toneladas</span> de CO2 al planeta
                        </h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-12 w-full max-w-4xl">
                            <div class="space-y-2">
                                <p class="text-5xl font-black text-primary">150+</p>
                                <p class="text-sm text-white/70 uppercase tracking-widest font-bold">Proyectos Eco</p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-5xl font-black text-primary">€2.4M</p>
                                <p class="text-sm text-white/70 uppercase tracking-widest font-bold">Ahorro en Facturas</p>
                            </div>
                            <div class="space-y-2">
                                <p class="text-5xl font-black text-primary">12k+</p>
                                <p class="text-sm text-white/70 uppercase tracking-widest font-bold">Árboles Equivalentes</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <!-- ODS Support -->
            <section>
                <div class="text-center mb-16">
                    <span class="inline-block px-4 py-1.5 bg-leaf/20 text-leaf text-[11px] font-black uppercase tracking-[0.2em] rounded-full mb-6 border border-leaf/30">Impacto Global</span>
                    <h2 class="text-3xl md:text-5xl font-black text-forest dark:text-white mb-6">Comprometidos con la ONU</h2>
                    <p class="text-forest/70 dark:text-white/60 max-w-2xl mx-auto italic text-lg">
                        Apoyamos activamente los Objetivos de Desarrollo Sostenible para transformar nuestro mundo.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- ODS 7 -->
                    <div class="flex flex-col gap-4 p-8 bg-white dark:bg-background-dark/30 rounded-3xl border-2 border-primary/5 hover:border-primary/40 transition-all hover:scale-[1.02] cursor-default">
                        <div class="size-14 rounded-2xl bg-yellow-500 flex items-center justify-center text-white text-3xl font-black">7</div>
                        <h4 class="text-xl font-bold text-forest dark:text-white">Energía Asequible y no Contaminante</h4>
                        <p class="text-sm text-forest/70 dark:text-white/60">Fomentamos viviendas con uso de renovables y autoconsumo.</p>
                    </div>
                    <!-- ODS 11 -->
                    <div class="flex flex-col gap-4 p-8 bg-white dark:bg-background-dark/30 rounded-3xl border-2 border-primary/5 hover:border-primary/40 transition-all hover:scale-[1.02] cursor-default">
                        <div class="size-14 rounded-2xl bg-orange-600 flex items-center justify-center text-white text-3xl font-black">11</div>
                        <h4 class="text-xl font-bold text-forest dark:text-white">Ciudades y Comunidades Sostenibles</h4>
                        <p class="text-sm text-forest/70 dark:text-white/60">Promovemos la urbanización inclusiva y sostenible.</p>
                    </div>
                    <!-- ODS 12 -->
                    <div class="flex flex-col gap-4 p-8 bg-white dark:bg-background-dark/30 rounded-3xl border-2 border-primary/5 hover:border-primary/40 transition-all hover:scale-[1.02] cursor-default">
                        <div class="size-14 rounded-2xl bg-orange-800 flex items-center justify-center text-white text-3xl font-black">12</div>
                        <h4 class="text-xl font-bold text-forest dark:text-white">Producción y Consumo Responsable</h4>
                        <p class="text-sm text-forest/70 dark:text-white/60">Uso eficiente de los recursos naturales en la construcción.</p>
                    </div>
                    <!-- ODS 13 -->
                    <div class="flex flex-col gap-4 p-8 bg-white dark:bg-background-dark/30 rounded-3xl border-2 border-primary/5 hover:border-primary/40 transition-all hover:scale-[1.02] cursor-default">
                        <div class="size-14 rounded-2xl bg-emerald-800 flex items-center justify-center text-white text-3xl font-black">13</div>
                        <h4 class="text-xl font-bold text-forest dark:text-white">Acción por el Clima</h4>
                        <p class="text-sm text-forest/70 dark:text-white/60">Medidas urgentes para combatir el cambio climático de raíz.</p>
                    </div>
                    <!-- ODS 15 -->
                    <div class="flex flex-col gap-4 p-8 bg-white dark:bg-background-dark/30 rounded-3xl border-2 border-primary/5 hover:border-primary/40 transition-all hover:scale-[1.02] cursor-default">
                        <div class="size-14 rounded-2xl bg-green-600 flex items-center justify-center text-white text-3xl font-black">15</div>
                        <h4 class="text-xl font-bold text-forest dark:text-white">Vida de Ecosistemas Terrestres</h4>
                        <p class="text-sm text-forest/70 dark:text-white/60">Protección de la biodiversidad en el entorno urbano.</p>
                    </div>
                    <!-- ODS 17 -->
                    <div class="flex flex-col gap-4 p-8 bg-white dark:bg-background-dark/30 rounded-3xl border-2 border-primary/5 hover:border-primary/40 transition-all hover:scale-[1.02] cursor-default">
                        <div class="size-14 rounded-2xl bg-sky-900 flex items-center justify-center text-white text-3xl font-black">17</div>
                        <h4 class="text-xl font-bold text-forest dark:text-white">Alianzas para lograr Objetivos</h4>
                        <p class="text-sm text-forest/70 dark:text-white/60">Colaboración con agentes locales por la sostenibilidad.</p>
                    </div>
                </div>
            </section>
        </div>
    </div>
</template>

<script setup>
// Lógica de About Us
</script>

<style scoped>
.size-14 { width: 3.5rem; height: 3.5rem; }
.size-16 { width: 4rem; height: 4rem; }
</style>

