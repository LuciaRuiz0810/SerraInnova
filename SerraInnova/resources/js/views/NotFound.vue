<template>
    <div class="organic-bg min-h-screen flex flex-col items-center justify-center p-6 relative overflow-hidden">
        
        <!-- Abstract Shapes -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-primary/20 rounded-full blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-leaf/20 rounded-full blur-[80px] animate-pulse delay-700"></div>
        </div>

        <div class="w-full max-w-2xl text-center z-10 glass-effect dark:glass-effect-dark p-10 rounded-[3rem] shadow-2xl border-2 border-white/20 glow-primary">
            
            <!-- 404 Icon -->
            <div class="mb-8 inline-block p-6 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 shadow-inner">
                <span class="material-symbols-outlined text-8xl text-forest dark:text-primary">error</span>
            </div>

            <!-- Error Code -->
            <h1 class="text-9xl font-black text-forest dark:text-white mb-4 tracking-tight leading-tight">
                404
            </h1>
            
            <!-- Error Message -->
            <h2 class="text-3xl font-bold text-forest dark:text-white mb-4">
                Página no encontrada
            </h2>
            
            <p class="text-xl text-leaf/80 mb-10 font-medium">
                Lo sentimos, la página que buscas no existe o ha sido movida.
            </p>

            <!-- Action Buttons -->
            <div class="space-y-4">
                <router-link 
                    to="/"
                    class="block w-full py-4 px-6 bg-forest text-white font-bold rounded-xl shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3 border border-transparent hover:border-primary/50"
                >
                    <span class="material-symbols-outlined">home</span>
                    <span>Volver al Inicio</span>
                </router-link>

                <router-link 
                    to="/propiedades"
                    class="block w-full py-4 px-6 bg-white dark:bg-white/10 text-forest dark:text-white font-bold rounded-xl border-2 border-leaf/20 hover:border-primary hover:bg-primary/10 hover:shadow-xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3"
                >
                    <span class="material-symbols-outlined">search</span>
                    <span>Ver Propiedades</span>
                </router-link>
            </div>

            <!-- Helpful Links -->
            <div class="mt-10 pt-6 border-t border-leaf/10 dark:border-white/10">
                <p class="text-sm text-leaf/60 mb-4 font-semibold">Enlaces útiles:</p>
                <div class="flex flex-wrap justify-center gap-4">
                    <router-link to="/servicios" class="text-sm font-bold text-forest dark:text-white hover:text-primary transition-colors">
                        Servicios
                    </router-link>
                    <router-link to="/calculadora" class="text-sm font-bold text-forest dark:text-white hover:text-primary transition-colors">
                        Calculadora
                    </router-link>
                    <router-link to="/contacto" class="text-sm font-bold text-forest dark:text-white hover:text-primary transition-colors">
                        Contacto
                    </router-link>
                    <router-link to="/nosotros" class="text-sm font-bold text-forest dark:text-white hover:text-primary transition-colors">
                        Nosotros
                    </router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
// No se necesita lógica adicional para esta página
</script>

<style scoped>
/* Animación sutil de fondo */
@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}
</style>
