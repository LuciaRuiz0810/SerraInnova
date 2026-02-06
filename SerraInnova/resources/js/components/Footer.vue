<template>
    <footer class="bg-forest pt-20 pb-10 px-6 text-white/80 relative overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none opacity-20">
            <div class="absolute -top-20 -right-20 w-96 h-96 bg-primary/20 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-leaf/20 rounded-full blur-3xl"></div>
        </div>

        <div class="mx-auto max-w-7xl relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-16">
                
                <!-- Brand -->
                <div class="space-y-6">
                    <div class="flex items-center gap-3 text-white">
                        <img src="../../images/logo.png" alt="SerraInnova Logo" class="h-16 w-auto object-contain bg-white/5 rounded-xl p-2 border border-white/10 backdrop-blur-sm">
                        <h2 class="text-2xl font-black tracking-tight font-display">SerraInnova</h2>
                    </div>
                    <p class="text-base leading-relaxed text-white/60">
                        Redefiniendo el sector inmobiliario con un enfoque sostenible. Construimos hogares que respetan el futuro.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 hover:bg-primary hover:text-forest transition-all duration-300">
                            <i class="fa-brands fa-instagram text-lg"></i>
                        </a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 hover:bg-primary hover:text-forest transition-all duration-300">
                            <i class="fa-brands fa-linkedin-in text-lg"></i>
                        </a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-white/5 hover:bg-primary hover:text-forest transition-all duration-300">
                            <i class="fa-brands fa-twitter text-lg"></i>
                        </a>
                    </div>
                </div>

                <!-- Explorar -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6 border-l-4 border-primary pl-3">Explorar</h4>
                    <ul class="space-y-3">
                        <li><router-link to="/propiedades" class="hover:text-primary hover:translate-x-1 transition-all inline-block">Propiedades</router-link></li>
                        <li><router-link to="/calculadora" class="hover:text-primary hover:translate-x-1 transition-all inline-block">Calculadora Eco</router-link></li>
                        <li><router-link to="/agentes" class="hover:text-primary hover:translate-x-1 transition-all inline-block">Nuestros Agentes</router-link></li>
                        <!-- <li><a href="#" class="hover:text-primary hover:translate-x-1 transition-all inline-block">Blog Sostenible</a></li> -->
                    </ul>
                </div>

                <!-- Empresa -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6 border-l-4 border-primary pl-3">Empresa</h4>
                    <ul class="space-y-3">
                        <li><router-link to="/nosotros" class="hover:text-primary hover:translate-x-1 transition-all inline-block">Sobre Nosotros</router-link></li>
                        <li><router-link to="/contacto" class="hover:text-primary hover:translate-x-1 transition-all inline-block">Contacto</router-link></li>
                        <li><a href="#" class="hover:text-primary hover:translate-x-1 transition-all inline-block">Términos y Condiciones</a></li>
                        <li><a href="#" class="hover:text-primary hover:translate-x-1 transition-all inline-block">Política de Privacidad</a></li>
                    </ul>
                </div>

                <!-- Newsletter -->
                <div>
                    <h4 class="text-white font-bold text-lg mb-6 border-l-4 border-primary pl-3">Newsletter</h4>
                    <p class="text-sm text-white/60 mb-4">Suscríbete para recibir las últimas novedades en vivienda sostenible.</p>
                    <form @submit.prevent class="relative group">
                        <input 
                            class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 pr-12 text-sm focus:ring-2 focus:ring-primary/50 focus:border-primary focus:bg-white/10 w-full outline-none text-white placeholder-white/30 transition-all font-sans" 
                            placeholder="tu@email.com" 
                            type="email"
                        />
                        <button class="absolute right-2 top-1/2 -translate-y-1/2 w-8 h-8 flex items-center justify-center bg-primary text-forest rounded-lg hover:scale-105 transition-all shadow-[0_0_10px_rgba(19,236,91,0.3)]">
                            <span class="material-symbols-outlined text-lg">arrow_forward</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Bottom -->
            <div class="pt-8 border-t border-white/10 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-white/40">
                <p>© 2024 SerraInnova Real Estate S.L.</p>
                <div class="flex gap-6">
                    <span>Hecho con <span class="text-red-500 animate-pulse">❤</span> por el equipo SerraInnova</span>
                </div>
            </div>
        </div>
    </footer>
</template>

<script setup>
</script>
