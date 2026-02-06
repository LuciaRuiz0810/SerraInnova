<template>
    <div class="organic-bg min-h-screen flex flex-col items-center justify-center p-6 relative overflow-hidden">
        
        <!-- Abstract Shapes -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden -z-10">
            <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-primary/20 rounded-full blur-[100px] animate-pulse"></div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-leaf/20 rounded-full blur-[80px] animate-pulse delay-700"></div>
        </div>

        <div class="w-full max-w-lg text-center z-10 glass-effect dark:glass-effect-dark p-10 rounded-[3rem] shadow-2xl border-2 border-white/20 glow-primary">
            
            <div class="mb-8 inline-block p-4 rounded-full bg-white/20 backdrop-blur-sm border border-white/30 shadow-inner">
                <span class="material-symbols-outlined text-6xl text-forest dark:text-primary">eco</span>
            </div>

            <h1 class="text-5xl font-black text-forest dark:text-white mb-4 tracking-tight leading-tight">
                SerraInnova
            </h1>
            <p class="text-xl text-leaf/80 mb-10 font-medium">
                Tu futuro hogar, en armonía con la naturaleza.
            </p>

            <div class="space-y-4">
                <router-link 
                    to="/login"
                    class="block w-full py-4 px-6 bg-forest text-white font-bold rounded-xl shadow-lg hover:shadow-2xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3 border border-transparent hover:border-primary/50"
                >
                    <span>Iniciar Sesión</span>
                    <span class="material-symbols-outlined">login</span>
                </router-link>

                <router-link 
                    to="/register"
                    class="block w-full py-4 px-6 bg-white dark:bg-white/10 text-forest dark:text-white font-bold rounded-xl border-2 border-leaf/20 hover:border-primary hover:bg-primary/10 hover:shadow-xl hover:scale-105 transition-all duration-300 flex items-center justify-center gap-3"
                >
                    <span>Crear Cuenta</span>
                    <span class="material-symbols-outlined">person_add</span>
                </router-link>
            </div>

            <div class="mt-10 pt-6 border-t border-leaf/10 dark:border-white/10">
                <p class="text-xs text-leaf/60 uppercase tracking-widest font-bold">Inmobiliaria Sostenible</p>
            </div>
        </div>
    </div>
</template>

<style scoped>
/* Animación sutil de fondo */
@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(5deg); }
}
</style>
