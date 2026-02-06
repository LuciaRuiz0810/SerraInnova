<template>
    <main class="organic-bg">
        <!-- Hero Section -->
        <section class="relative px-4 pt-6 pb-20 md:px-10 lg:px-20">
            <div class="mx-auto max-w-[1200px]">
                <div class="relative min-h-[560px] flex flex-col items-center justify-center rounded-3xl overflow-hidden bg-cover bg-center p-8 shadow-2xl" 
                     style='background-image: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(13,27,18,0.7)), url("https://images.unsplash.com/photo-1497366216548-37526070297c?w=1200&auto=format&fit=crop");'>
                    <div class="relative z-10 max-w-3xl text-center space-y-6">
                        <h1 class="text-4xl md:text-6xl font-black text-white leading-[1.1] tracking-tight">
                            Nuestros Servicios de 
                            <span class="text-primary">Consultoría Sostenible</span>
                        </h1>
                        <p class="text-lg md:text-xl text-white/90 font-medium">
                            No solo vendemos propiedades, te asesoramos en cada paso hacia un hogar más eficiente y sostenible
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Overview -->
        <section class="px-4 pb-16 md:px-10 lg:px-20">
            <div class="mx-auto max-w-[1200px]">
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Service Card 1: Auditorías -->
                    <div @click="scrollToSection('auditorias')" 
                         class="group cursor-pointer bg-white dark:bg-background-dark/40 rounded-3xl overflow-hidden shadow-xl border-2 border-leaf/5 hover:shadow-2xl hover:border-primary/30 hover:-translate-y-2 transition-all duration-500 hover:scale-[1.02] p-8">
                        <div class="size-16 rounded-2xl bg-gradient-to-br from-primary/20 to-leaf/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined text-4xl text-leaf">query_stats</span>
                        </div>
                        <h3 class="text-2xl font-bold text-forest dark:text-white mb-3">Auditorías Energéticas</h3>
                        <p class="text-leaf dark:text-white/70 mb-4">
                            Análisis completo de viviendas antiguas para identificar mejoras de eficiencia
                        </p>
                        <div class="flex items-center gap-2 text-primary font-semibold group-hover:gap-3 transition-all">
                            <span>Más información</span>
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </div>
                    </div>

                    <!-- Service Card 2: Subvenciones -->
                    <div @click="scrollToSection('subvenciones')"
                         class="group cursor-pointer bg-white dark:bg-background-dark/40 rounded-3xl overflow-hidden shadow-xl border-2 border-leaf/5 hover:shadow-2xl hover:border-primary/30 hover:-translate-y-2 transition-all duration-500 hover:scale-[1.02] p-8">
                        <div class="size-16 rounded-2xl bg-gradient-to-br from-primary/20 to-leaf/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined text-4xl text-leaf">account_balance</span>
                        </div>
                        <h3 class="text-2xl font-bold text-forest dark:text-white mb-3">Gestión de Subvenciones</h3>
                        <p class="text-leaf dark:text-white/70 mb-4">
                            Te ayudamos a acceder a fondos Next Generation y otras ayudas para rehabilitación
                        </p>
                        <div class="flex items-center gap-2 text-primary font-semibold group-hover:gap-3 transition-all">
                            <span>Más información</span>
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </div>
                    </div>

                    <!-- Service Card 3: Rehabilitación -->
                    <div @click="scrollToSection('rehabilitacion')"
                         class="group cursor-pointer bg-white dark:bg-background-dark/40 rounded-3xl overflow-hidden shadow-xl border-2 border-leaf/5 hover:shadow-2xl hover:border-primary/30 hover:-translate-y-2 transition-all duration-500 hover:scale-[1.02] p-8">
                        <div class="size-16 rounded-2xl bg-gradient-to-br from-primary/20 to-leaf/20 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined text-4xl text-leaf">home_repair_service</span>
                        </div>
                        <h3 class="text-2xl font-bold text-forest dark:text-white mb-3">Proyectos de Rehabilitación</h3>
                        <p class="text-leaf dark:text-white/70 mb-4">
                            Transformamos tu vivienda con reformas que mejoran la eficiencia energética
                        </p>
                        <div class="flex items-center gap-2 text-primary font-semibold group-hover:gap-3 transition-all">
                            <span>Más información</span>
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Auditorías Energéticas Section -->
        <section id="auditorias" class="px-4 py-20 md:px-10 lg:px-20 bg-sand dark:bg-background-dark/20">
            <div class="mx-auto max-w-[1200px]">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div class="order-2 md:order-1">
                        <div class="inline-block bg-primary/10 rounded-full px-4 py-2 mb-6">
                            <span class="text-sm font-bold text-forest dark:text-primary uppercase tracking-wider">Servicio #1</span>
                        </div>
                        <h2 class="text-3xl md:text-5xl font-extrabold text-forest dark:text-white mb-6">
                            Auditorías Energéticas Profesionales
                        </h2>
                        <p class="text-lg text-leaf dark:text-white/80 mb-8">
                            Analizamos viviendas antiguas para identificar oportunidades de mejora energética. Nuestro equipo de expertos realiza un estudio completo de tu propiedad.
                        </p>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex items-start gap-4">
                                <div class="size-12 rounded-xl bg-primary/20 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-leaf">fact_check</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-forest dark:text-white mb-1">Análisis completo</h4>
                                    <p class="text-sm text-leaf dark:text-white/70">Evaluación de aislamientos, instalaciones y consumos energéticos</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="size-12 rounded-xl bg-primary/20 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-leaf">description</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-forest dark:text-white mb-1">Informe detallado</h4>
                                    <p class="text-sm text-leaf dark:text-white/70">Recibe un documento completo con recomendaciones priorizadas</p>
                                </div>
                            </div>
                            <div class="flex items-start gap-4">
                                <div class="size-12 rounded-xl bg-primary/20 flex items-center justify-center flex-shrink-0">
                                    <span class="material-symbols-outlined text-leaf">savings</span>
                                </div>
                                <div>
                                    <h4 class="font-bold text-forest dark:text-white mb-1">Estimación de ahorro</h4>
                                    <p class="text-sm text-leaf dark:text-white/70">Cálculo del retorno de inversión de cada mejora propuesta</p>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-4">
                            <button class="bg-gradient-to-r from-forest to-leaf text-primary font-bold py-4 px-8 rounded-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 glow-primary-hover">
                                Solicitar auditoría
                            </button>
                            <button class="border-2 border-leaf/20 text-forest dark:text-white font-bold py-4 px-8 rounded-xl hover:border-primary/40 transition-all">
                                Ver casos de éxito
                            </button>
                        </div>
                    </div>
                    
                    <div class="order-1 md:order-2">
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                            <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?w=800&auto=format&fit=crop" 
                                 alt="Auditoría energética" 
                                 class="w-full h-auto">
                            <div class="absolute inset-0 bg-gradient-to-t from-forest/60 to-transparent"></div>
                            <div class="absolute bottom-8 left-8 right-8">
                                <div class="glass-effect dark:glass-effect-dark rounded-2xl p-6">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-sm font-bold text-forest dark:text-white">Ahorro Promedio</span>
                                        <span class="text-2xl font-black text-primary">-45%</span>
                                    </div>
                                    <p class="text-xs text-leaf dark:text-white/70">en facturas energéticas tras implementar mejoras</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Gestión de Subvenciones Section -->
        <section id="subvenciones" class="px-4 py-20 md:px-10 lg:px-20">
            <div class="mx-auto max-w-[1200px]">
                <div class="grid md:grid-cols-2 gap-12 items-center">
                    <div>
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?w=800&auto=format&fit=crop" 
                                 alt="Gestión de subvenciones" 
                                 class="w-full h-auto">
                            <div class="absolute top-6 right-6">
                                <div class="bg-primary text-forest font-black px-4 py-2 rounded-full text-sm shadow-xl">
                                    Hasta 12.000€ disponibles
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div>
                        <div class="inline-block bg-primary/10 rounded-full px-4 py-2 mb-6">
                            <span class="text-sm font-bold text-forest dark:text-primary uppercase tracking-wider">Servicio #2</span>
                        </div>
                        <h2 class="text-3xl md:text-5xl font-extrabold text-forest dark:text-white mb-6">
                            Accede a Fondos Next Generation
                        </h2>
                        <p class="text-lg text-leaf dark:text-white/80 mb-8">
                            Te guiamos en el proceso de solicitud de subvenciones para rehabilitación energética. Maximizamos tus opciones de financiación.
                        </p>

                        <!-- Funding Cards -->
                        <div class="space-y-4 mb-8">
                            <div class="bg-white dark:bg-background-dark/40 rounded-2xl p-6 border-2 border-leaf/10 hover:border-primary/30 transition-all">
                                <div class="flex items-center gap-4 mb-3">
                                    <div class="size-10 rounded-lg bg-gradient-to-br from-primary to-leaf flex items-center justify-center">
                                        <span class="material-symbols-outlined text-forest text-xl">euro</span>
                                    </div>
                                    <h4 class="font-bold text-forest dark:text-white">Next Generation EU</h4>
                                </div>
                                <p class="text-sm text-leaf dark:text-white/70 mb-2">
                                    Ayudas de hasta 12.000€ para mejoras de eficiencia energética en viviendas
                                </p>
                                <span class="text-xs font-semibold text-primary">Vigente hasta 2026</span>
                            </div>

                            <div class="bg-white dark:bg-background-dark/40 rounded-2xl p-6 border-2 border-leaf/10 hover:border-primary/30 transition-all">
                                <div class="flex items-center gap-4 mb-3">
                                    <div class="size-10 rounded-lg bg-gradient-to-br from-leaf to-forest flex items-center justify-center">
                                        <span class="material-symbols-outlined text-primary text-xl">solar_power</span>
                                    </div>
                                    <h4 class="font-bold text-forest dark:text-white">Bonificaciones IBI</h4>
                                </div>
                                <p class="text-sm text-leaf dark:text-white/70 mb-2">
                                    Reducciones fiscales por instalación de sistemas de energía renovable
                                </p>
                                <span class="text-xs font-semibold text-primary">Según municipio</span>
                            </div>

                            <div class="bg-white dark:bg-background-dark/40 rounded-2xl p-6 border-2 border-leaf/10 hover:border-primary/30 transition-all">
                                <div class="flex items-center gap-4 mb-3">
                                    <div class="size-10 rounded-lg bg-gradient-to-br from-primary/60 to-leaf/60 flex items-center justify-center">
                                        <span class="material-symbols-outlined text-forest text-xl">home</span>
                                    </div>
                                    <h4 class="font-bold text-forest dark:text-white">Plan Rehabilita</h4>
                                </div>
                                <p class="text-sm text-leaf dark:text-white/70 mb-2">
                                    Líneas de financiación preferente para rehabilitación integral
                                </p>
                                <span class="text-xs font-semibold text-primary">Consultar condiciones</span>
                            </div>
                        </div>

                        <div class="bg-forest/5 dark:bg-primary/5 rounded-2xl p-6 border-2 border-dashed border-leaf/20">
                            <div class="flex items-start gap-4">
                                <span class="material-symbols-outlined text-primary text-2xl">info</span>
                                <div>
                                    <h4 class="font-bold text-forest dark:text-white mb-2">Te acompañamos en todo el proceso</h4>
                                    <p class="text-sm text-leaf dark:text-white/70">
                                        Desde la documentación inicial hasta la justificación final. Nuestro equipo se encarga de toda la gestión administrativa.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <button class="mt-8 bg-gradient-to-r from-forest to-leaf text-primary font-bold py-4 px-8 rounded-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 glow-primary-hover w-full md:w-auto">
                            Consultar elegibilidad
                        </button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Proyectos de Rehabilitación Section -->
        <section id="rehabilitacion" class="px-4 py-20 md:px-10 lg:px-20 bg-sand dark:bg-background-dark/20">
            <div class="mx-auto max-w-[1200px]">
                <div class="text-center mb-16">
                    <div class="inline-block bg-primary/10 rounded-full px-4 py-2 mb-6">
                        <span class="text-sm font-bold text-forest dark:text-primary uppercase tracking-wider">Servicio #3</span>
                    </div>
                    <h2 class="text-3xl md:text-5xl font-extrabold text-forest dark:text-white mb-6">
                        Proyectos de Rehabilitación
                    </h2>
                    <p class="text-lg text-leaf dark:text-white/80 max-w-3xl mx-auto">
                        Transformamos viviendas antiguas en hogares eficientes y modernos. Descubre el antes y después de nuestros proyectos.
                    </p>
                </div>

                <!-- Before/After Projects Grid -->
                <div class="space-y-12">
                    <!-- Project 1 -->
                    <div class="bg-white dark:bg-background-dark/40 rounded-3xl overflow-hidden shadow-xl border-2 border-leaf/5">
                        <div class="grid md:grid-cols-2">
                            <!-- Before -->
                            <div class="relative group overflow-hidden">
                                <div class="absolute top-4 left-4 z-10 bg-red-500/90 text-white text-xs font-black px-3 py-1.5 rounded-full uppercase">
                                    Antes
                                </div>
                                <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=800&auto=format&fit=crop" 
                                     alt="Casa antes de rehabilitación" 
                                     class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 right-4 text-white">
                                    <p class="text-sm font-semibold">Consumo: 280 kWh/m²·año</p>
                                    <p class="text-xs opacity-80">Calificación: G</p>
                                </div>
                            </div>
                            
                            <!-- After -->
                            <div class="relative group overflow-hidden">
                                <div class="absolute top-4 left-4 z-10 bg-primary text-forest text-xs font-black px-3 py-1.5 rounded-full uppercase shadow-lg">
                                    Después
                                </div>
                                <img src="https://images.unsplash.com/photo-1600596542815-ffad4c1539a9?w=800&auto=format&fit=crop" 
                                     alt="Casa después de rehabilitación" 
                                     class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-forest/60 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 right-4 text-white">
                                    <p class="text-sm font-semibold">Consumo: 35 kWh/m²·año</p>
                                    <p class="text-xs opacity-80">Calificación: A+</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-forest dark:text-white mb-4">Casa Rural en Serra de Tramuntana</h3>
                            <p class="text-leaf dark:text-white/80 mb-6">
                                Rehabilitación integral con aislamiento térmico, instalación de aerotermia y paneles solares. Reducción del 87% en consumo energético.
                            </p>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                <div class="bg-sand dark:bg-background-dark rounded-xl p-4 text-center">
                                    <div class="text-2xl font-black text-primary mb-1">-87%</div>
                                    <div class="text-xs text-leaf dark:text-white/70">Consumo</div>
                                </div>
                                <div class="bg-sand dark:bg-background-dark rounded-xl p-4 text-center">
                                    <div class="text-2xl font-black text-primary mb-1">8.5kW</div>
                                    <div class="text-xs text-leaf dark:text-white/70">Solar</div>
                                </div>
                                <div class="bg-sand dark:bg-background-dark rounded-xl p-4 text-center">
                                    <div class="text-2xl font-black text-primary mb-1">A+</div>
                                    <div class="text-xs text-leaf dark:text-white/70">Certificado</div>
                                </div>
                                <div class="bg-sand dark:bg-background-dark rounded-xl p-4 text-center">
                                    <div class="text-2xl font-black text-primary mb-1">9.500€</div>
                                    <div class="text-xs text-leaf dark:text-white/70">Subvención</div>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-3">
                                <span class="bg-primary/10 text-forest dark:text-primary text-xs font-semibold px-3 py-1.5 rounded-full">
                                    <span class="material-symbols-outlined text-xs align-middle">check_circle</span>
                                    Aislamiento SATE
                                </span>
                                <span class="bg-primary/10 text-forest dark:text-primary text-xs font-semibold px-3 py-1.5 rounded-full">
                                    <span class="material-symbols-outlined text-xs align-middle">check_circle</span>
                                    Aerotermia
                                </span>
                                <span class="bg-primary/10 text-forest dark:text-primary text-xs font-semibold px-3 py-1.5 rounded-full">
                                    <span class="material-symbols-outlined text-xs align-middle">check_circle</span>
                                    Solar fotovoltaica
                                </span>
                                <span class="bg-primary/10 text-forest dark:text-primary text-xs font-semibold px-3 py-1.5 rounded-full">
                                    <span class="material-symbols-outlined text-xs align-middle">check_circle</span>
                                    Ventanas PVC
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Project 2 -->
                    <div class="bg-white dark:bg-background-dark/40 rounded-3xl overflow-hidden shadow-xl border-2 border-leaf/5">
                        <div class="grid md:grid-cols-2">
                            <!-- Before -->
                            <div class="relative group overflow-hidden">
                                <div class="absolute top-4 left-4 z-10 bg-red-500/90 text-white text-xs font-black px-3 py-1.5 rounded-full uppercase">
                                    Antes
                                </div>
                                <img src="https://images.unsplash.com/photo-1502672260266-1c1ef2d93688?w=800&auto=format&fit=crop" 
                                     alt="Apartamento antes de rehabilitación" 
                                     class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 right-4 text-white">
                                    <p class="text-sm font-semibold">Consumo: 195 kWh/m²·año</p>
                                    <p class="text-xs opacity-80">Calificación: E</p>
                                </div>
                            </div>
                            
                            <!-- After -->
                            <div class="relative group overflow-hidden">
                                <div class="absolute top-4 left-4 z-10 bg-primary text-forest text-xs font-black px-3 py-1.5 rounded-full uppercase shadow-lg">
                                    Después
                                </div>
                                <img src="https://images.unsplash.com/photo-1502672023488-70e25813eb80?w=800&auto=format&fit=crop" 
                                     alt="Apartamento después de rehabilitación" 
                                     class="w-full h-80 object-cover transition-transform duration-500 group-hover:scale-105">
                                <div class="absolute inset-0 bg-gradient-to-t from-forest/60 to-transparent"></div>
                                <div class="absolute bottom-4 left-4 right-4 text-white">
                                    <p class="text-sm font-semibold">Consumo: 48 kWh/m²·año</p>
                                    <p class="text-xs opacity-80">Calificación: B</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="p-8">
                            <h3 class="text-2xl font-bold text-forest dark:text-white mb-4">Apartamento Urbano en Barcelona</h3>
                            <p class="text-leaf dark:text-white/80 mb-6">
                                Actualización completa de instalaciones con domótica, mejora de envolvente térmica y sistema de ventilación mecánica. Reducción del 75% en consumo.
                            </p>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                                <div class="bg-sand dark:bg-background-dark rounded-xl p-4 text-center">
                                    <div class="text-2xl font-black text-primary mb-1">-75%</div>
                                    <div class="text-xs text-leaf dark:text-white/70">Consumo</div>
                                </div>
                                <div class="bg-sand dark:bg-background-dark rounded-xl p-4 text-center">
                                    <div class="text-2xl font-black text-primary mb-1">VMC</div>
                                    <div class="text-xs text-leaf dark:text-white/70">Ventilación</div>
                                </div>
                                <div class="bg-sand dark:bg-background-dark rounded-xl p-4 text-center">
                                    <div class="text-2xl font-black text-primary mb-1">B</div>
                                    <div class="text-xs text-leaf dark:text-white/70">Certificado</div>
                                </div>
                                <div class="bg-sand dark:bg-background-dark rounded-xl p-4 text-center">
                                    <div class="text-2xl font-black text-primary mb-1">6.200€</div>
                                    <div class="text-xs text-leaf dark:text-white/70">Subvención</div>
                                </div>
                            </div>

                            <div class="flex flex-wrap gap-3">
                                <span class="bg-primary/10 text-forest dark:text-primary text-xs font-semibold px-3 py-1.5 rounded-full">
                                    <span class="material-symbols-outlined text-xs align-middle">check_circle</span>
                                    Ventanas doble acristalamiento
                                </span>
                                <span class="bg-primary/10 text-forest dark:text-primary text-xs font-semibold px-3 py-1.5 rounded-full">
                                    <span class="material-symbols-outlined text-xs align-middle">check_circle</span>
                                    Sistema VMC
                                </span>
                                <span class="bg-primary/10 text-forest dark:text-primary text-xs font-semibold px-3 py-1.5 rounded-full">
                                    <span class="material-symbols-outlined text-xs align-middle">check_circle</span>
                                    Domótica
                                </span>
                                <span class="bg-primary/10 text-forest dark:text-primary text-xs font-semibold px-3 py-1.5 rounded-full">
                                    <span class="material-symbols-outlined text-xs align-middle">check_circle</span>
                                    LED inteligente
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Process Timeline -->
                <div class="mt-20">
                    <h3 class="text-3xl font-extrabold text-forest dark:text-white text-center mb-12">
                        Nuestro Proceso de Trabajo
                    </h3>
                    
                    <div class="grid md:grid-cols-4 gap-8">
                        <div class="text-center">
                            <div class="size-20 rounded-full bg-gradient-to-br from-primary to-leaf flex items-center justify-center mx-auto mb-4 shadow-xl">
                                <span class="text-2xl font-black text-forest">1</span>
                            </div>
                            <h4 class="font-bold text-forest dark:text-white mb-2">Auditoría Inicial</h4>
                            <p class="text-sm text-leaf dark:text-white/70">Evaluamos el estado actual de tu vivienda</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="size-20 rounded-full bg-gradient-to-br from-primary to-leaf flex items-center justify-center mx-auto mb-4 shadow-xl">
                                <span class="text-2xl font-black text-forest">2</span>
                            </div>
                            <h4 class="font-bold text-forest dark:text-white mb-2">Proyecto Técnico</h4>
                            <p class="text-sm text-leaf dark:text-white/70">Diseñamos las mejoras más eficientes</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="size-20 rounded-full bg-gradient-to-br from-primary to-leaf flex items-center justify-center mx-auto mb-4 shadow-xl">
                                <span class="text-2xl font-black text-forest">3</span>
                            </div>
                            <h4 class="font-bold text-forest dark:text-white mb-2">Gestión de Ayudas</h4>
                            <p class="text-sm text-leaf dark:text-white/70">Tramitamos todas las subvenciones</p>
                        </div>
                        
                        <div class="text-center">
                            <div class="size-20 rounded-full bg-gradient-to-br from-primary to-leaf flex items-center justify-center mx-auto mb-4 shadow-xl">
                                <span class="text-2xl font-black text-forest">4</span>
                            </div>
                            <h4 class="font-bold text-forest dark:text-white mb-2">Ejecución</h4>
                            <p class="text-sm text-leaf dark:text-white/70">Realizamos la obra con garantías</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Final CTA -->
        <section class="px-4 py-20 md:px-10 lg:px-20">
            <div class="mx-auto max-w-[1200px]">
                <div class="bg-gradient-to-br from-forest to-leaf rounded-3xl p-8 md:p-16 text-center relative overflow-hidden">
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-10 left-10 size-40 rounded-full bg-primary blur-3xl"></div>
                        <div class="absolute bottom-10 right-10 size-60 rounded-full bg-white blur-3xl"></div>
                    </div>
                    
                    <div class="relative z-10 max-w-3xl mx-auto">
                        <h2 class="text-3xl md:text-5xl font-extrabold text-white mb-6">
                            ¿Listo para transformar tu vivienda?
                        </h2>
                        <p class="text-lg text-primary/90 mb-8">
                            Agenda una consulta gratuita con nuestros expertos y descubre cuánto puedes ahorrar
                        </p>
                        
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            <button class="bg-white text-forest font-bold px-8 py-4 rounded-xl hover:bg-primary hover:text-forest transition-all shadow-2xl">
                                Agenda tu consulta
                            </button>
                            <button class="border-2 border-white/30 text-white font-bold px-8 py-4 rounded-xl hover:bg-white/10 transition-all">
                                Descargar catálogo
                            </button>
                        </div>
                        
                        <div class="mt-12 grid grid-cols-3 gap-8 max-w-2xl mx-auto">
                            <div>
                                <div class="text-3xl font-black text-primary mb-1">500+</div>
                                <div class="text-sm text-white/80">Proyectos realizados</div>
                            </div>
                            <div>
                                <div class="text-3xl font-black text-primary mb-1">98%</div>
                                <div class="text-sm text-white/80">Clientes satisfechos</div>
                            </div>
                            <div>
                                <div class="text-3xl font-black text-primary mb-1">-60%</div>
                                <div class="text-sm text-white/80">Ahorro medio</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</template>

<script setup>
const scrollToSection = (sectionId) => {
    const element = document.getElementById(sectionId);
    if (element) {
        element.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
};
</script>
