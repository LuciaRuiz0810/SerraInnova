<template>
    <div class="min-h-screen flex items-center justify-center px-4 py-12 organic-bg">
        <div class="w-full max-w-md">
            <!-- Card de Login -->
            <div class="glass-effect dark:glass-effect-dark rounded-3xl p-8 shadow-2xl border-2 border-primary/20 glow-primary">
                <!-- Logo/Título -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-black text-forest dark:text-white mb-2">Bienvenido</h1>
                    <p class="text-leaf">Inicia sesión en SerraInnova</p>
                </div>

                <!-- Formulario -->
                <form @submit.prevent="handleLogin" class="space-y-6">
                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-bold text-forest dark:text-white mb-2">
                            Email
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-leaf text-xl">
                                mail
                            </span>
                            <input
                                v-model="form.email"
                                type="email"
                                required
                                class="w-full pl-12 pr-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="tu@email.com"
                            />
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label class="block text-sm font-bold text-forest dark:text-white mb-2">
                            Contraseña
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-leaf text-xl">
                                lock
                            </span>
                            <input
                                v-model="form.password"
                                type="password"
                                required
                                class="w-full pl-12 pr-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="••••••••"
                            />
                        </div>
                    </div>

                    <!-- Error Message -->
                    <div v-if="error" class="bg-red-500/10 border-2 border-red-500/30 rounded-xl p-4">
                        <p class="text-red-600 dark:text-red-400 text-sm font-semibold">{{ error }}</p>
                    </div>

                    <!-- Botón Login -->
                    <button
                        type="submit"
                        :disabled="loading"
                        class="w-full bg-gradient-to-r from-forest to-leaf text-primary font-black py-4 px-6 rounded-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 glow-primary-hover disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                    >
                        <span v-if="!loading">Iniciar Sesión</span>
                        <span v-else>Cargando...</span>
                        <span v-if="!loading" class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </form>

                <!-- Link a Registro -->
                <div class="mt-6 text-center">
                    <p class="text-leaf text-sm">
                        ¿No tienes cuenta?
                        <router-link to="/register" class="text-forest dark:text-primary font-bold hover:underline">
                            Regístrate aquí
                        </router-link>
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();

const form = reactive({
    email: '',
    password: ''
});

const loading = ref(false);
const error = ref('');

const handleLogin = async () => {
    try {
        loading.value = true;
        error.value = '';

        const response = await axios.post('/login', form);

        // Guardar token y usuario en localStorage
        localStorage.setItem('token', response.data.token);
        localStorage.setItem('user', JSON.stringify(response.data.user));

        // Configurar axios para usar el token
        axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;

        // Redirigir a home (usar window.location para forzar recarga completa)
        window.location.href = '/';
    } catch (err) {
        if (err.response?.data?.errors) {
            error.value = Object.values(err.response.data.errors).flat().join(', ');
        } else {
            error.value = err.response?.data?.message || 'Error al iniciar sesión';
        }
    } finally {
        loading.value = false;
    }
};
</script>
