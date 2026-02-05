<template>
    <footer class="bg-forest py-16 px-10 text-white/60">
        <div class="mx-auto max-w-[1200px] flex flex-wrap gap-12">
            <div class="w-full md:w-1/4 space-y-6">
                <div class="flex items-center gap-2 text-white">
                    <span class="material-symbols-outlined text-3xl text-primary">eco</span>
                    <h2 class="text-xl font-bold tracking-tight">SerraInnova</h2>
                </div>
                <p class="text-sm leading-relaxed">
                    Líderes en el sector inmobiliario sostenible. Redefiniendo la forma en que vivimos y respetamos nuestro entorno.
                </p>
            </div>
            <div class="w-full md:w-1/5">
                <h4 class="text-white font-bold mb-6">Explorar</h4>
                <ul class="space-y-4 text-sm">
                    <li><router-link to="/propiedades" class="hover:text-primary transition-colors">Obra Nueva</router-link></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Casas Pasivas</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Reformas Eco</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Blog Sostenible</a></li>
                </ul>
            </div>
            <div class="w-full md:w-1/5">
                <h4 class="text-white font-bold mb-6">Empresa</h4>
                <ul class="space-y-4 text-sm">
                    <li><router-link to="/nosotros" class="hover:text-primary transition-colors">Sobre Nosotros</router-link></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Nuestros Valores</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Contacto</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Privacidad</a></li>
                </ul>
            </div>
            <div class="w-full md:w-1/4">
                <h4 class="text-white font-bold mb-6">Newsletter</h4>
                <p class="text-xs mb-4">Recibe las últimas novedades en construcción sostenible.</p>
                <div class="flex gap-2">
                    <input class="bg-white/5 border border-white/10 rounded-lg px-3 py-2 text-sm focus:ring-1 focus:ring-primary w-full outline-none text-white placeholder-white/30" placeholder="Email" type="text"/>
                    <button class="bg-primary text-forest p-2 rounded-lg hover:bg-white transition-colors">
                        <span class="material-symbols-outlined text-sm">send</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="mx-auto max-w-[1200px] mt-16 pt-8 border-t border-white/5 text-center text-xs">
            ©️ 2024 SerraInnova Real Estate S.L. Todos los derechos reservados.
        </div>
    </footer>
</template>

<script setup>
</script>
