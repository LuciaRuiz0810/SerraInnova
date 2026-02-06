<template>
    <div class="min-h-screen flex items-center justify-center px-4 py-12 organic-bg">
        <div class="w-full max-w-2xl">
            <!-- Card de Registro -->
            <div class="glass-effect dark:glass-effect-dark rounded-3xl p-8 shadow-2xl border-2 border-primary/20 glow-primary">
                <!-- Logo/Título -->
                <div class="text-center mb-8">
                    <h1 class="text-3xl font-black text-forest dark:text-white mb-2">Crear Cuenta</h1>
                    <p class="text-leaf">Únete a SerraInnova</p>
                </div>

                <!-- Selector de Tipo de Usuario -->
                <div class="mb-8">
                    <label class="block text-sm font-bold text-forest dark:text-white mb-4 text-center">
                        ¿Qué tipo de cuenta deseas?
                    </label>
                    <div class="grid grid-cols-2 gap-4">
                        <button
                            type="button"
                            @click="form.tipo_usuario = 'cliente'"
                            :class="[
                                'p-6 rounded-2xl border-2 transition-all duration-300',
                                form.tipo_usuario === 'cliente'
                                    ? 'bg-gradient-to-br from-primary to-leaf border-forest shadow-xl scale-105'
                                    : 'bg-white/30 dark:bg-background-dark/30 border-leaf/20 hover:border-leaf/50'
                            ]"
                        >
                            <span class="material-symbols-outlined text-4xl mb-2" :class="form.tipo_usuario === 'cliente' ? 'text-forest' : 'text-leaf'">
                                shopping_bag
                            </span>
                            <h3 class="font-black text-lg" :class="form.tipo_usuario === 'cliente' ? 'text-forest' : 'text-forest dark:text-white'">
                                Comprador
                            </h3>
                            <p class="text-sm mt-1" :class="form.tipo_usuario === 'cliente' ? 'text-forest/80' : 'text-leaf'">
                                Busco propiedades
                            </p>
                        </button>

                        <button
                            type="button"
                            @click="form.tipo_usuario = 'agente'"
                            :class="[
                                'p-6 rounded-2xl border-2 transition-all duration-300',
                                form.tipo_usuario === 'agente'
                                    ? 'bg-gradient-to-br from-primary to-leaf border-forest shadow-xl scale-105'
                                    : 'bg-white/30 dark:bg-background-dark/30 border-leaf/20 hover:border-leaf/50'
                            ]"
                        >
                            <span class="material-symbols-outlined text-4xl mb-2" :class="form.tipo_usuario === 'agente' ? 'text-forest' : 'text-leaf'">
                                sell
                            </span>
                            <h3 class="font-black text-lg" :class="form.tipo_usuario === 'agente' ? 'text-forest' : 'text-forest dark:text-white'">
                                Vendedor
                            </h3>
                            <p class="text-sm mt-1" :class="form.tipo_usuario === 'agente' ? 'text-forest/80' : 'text-leaf'">
                                Vendo propiedades
                            </p>
                        </button>
                    </div>
                </div>

                <!-- Formulario -->
                <form @submit.prevent="handleRegister" class="space-y-6">
                    <!-- Nombre y Apellidos -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Nombre</label>
                            <input
                                v-model="form.nombre"
                                type="text"
                                required
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="Juan"
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Apellidos</label>
                            <input
                                v-model="form.apellidos"
                                type="text"
                                required
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="García López"
                            />
                        </div>
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-sm font-bold text-forest dark:text-white mb-2">Email</label>
                        <input
                            v-model="form.email"
                            type="email"
                            required
                            class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                            placeholder="tu@email.com"
                        />
                    </div>

                    <!-- Teléfono y DNI/Dirección -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Teléfono</label>
                            <input
                                v-model="form.telefono"
                                type="tel"
                                required
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="+34 600 123 456"
                            />
                        </div>
                        <div v-if="form.tipo_usuario === 'agente'">
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">DNI</label>
                            <input
                                v-model="form.dni"
                                type="text"
                                required
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="12345678A"
                            />
                        </div>
                        <div v-if="form.tipo_usuario === 'cliente'">
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Dirección (opcional)</label>
                            <input
                                v-model="form.direccion"
                                type="text"
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="Calle Mayor 10"
                            />
                        </div>
                    </div>

                    <!-- Password y Confirmación -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Contraseña</label>
                            <input
                                v-model="form.password"
                                type="password"
                                required
                                minlength="8"
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="••••••••"
                            />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Confirmar Contraseña</label>
                            <input
                                v-model="form.password_confirmation"
                                type="password"
                                required
                                minlength="8"
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="••••••••"
                            />
                        </div>
                    </div>

                    <!-- Error Message -->
                    <div v-if="error" class="bg-red-500/10 border-2 border-red-500/30 rounded-xl p-4">
                        <p class="text-red-600 dark:text-red-400 text-sm font-semibold">{{ error }}</p>
                    </div>

                    <!-- Botón Registro -->
                    <button
                        type="submit"
                        :disabled="loading"
                        class="w-full bg-gradient-to-r from-forest to-leaf text-primary font-black py-4 px-6 rounded-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 glow-primary-hover disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                    >
                        <span v-if="!loading">Crear Cuenta</span>
                        <span v-else>Creando cuenta...</span>
                        <span v-if="!loading" class="material-symbols-outlined">arrow_forward</span>
                    </button>
                </form>

                <!-- Link a Login -->
                <div class="mt-6 text-center">
                    <p class="text-leaf text-sm">
                        ¿Ya tienes cuenta?
                        <router-link to="/login" class="text-forest dark:text-primary font-bold hover:underline">
                            Inicia sesión aquí
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
    tipo_usuario: 'cliente',
    nombre: '',
    apellidos: '',
    email: '',
    telefono: '',
    dni: '',
    direccion: '',
    password: '',
    password_confirmation: ''
});

const loading = ref(false);
const error = ref('');

const handleRegister = async () => {
    try {
        loading.value = true;
        error.value = '';

        // Validar que las contraseñas coincidan
        if (form.password !== form.password_confirmation) {
            error.value = 'Las contraseñas no coinciden';
            loading.value = false;
            return;
        }

        // Preparar datos según tipo de usuario
        const dataToSend = {
            tipo_usuario: form.tipo_usuario,
            nombre: form.nombre,
            apellidos: form.apellidos,
            email: form.email,
            telefono: form.telefono,
            password: form.password,
            password_confirmation: form.password_confirmation
        };

        // Añadir campos específicos según tipo
        if (form.tipo_usuario === 'agente') {
            dataToSend.dni = form.dni;
        } else {
            dataToSend.direccion = form.direccion;
        }

        const response = await axios.post('/register', dataToSend);

        // Guardar token y usuario en localStorage
        localStorage.setItem('token', response.data.token);
        localStorage.setItem('user', JSON.stringify(response.data.user));

        // Configurar axios para usar el token
        axios.defaults.headers.common['Authorization'] = `Bearer ${response.data.token}`;

        // Redirigir a home (usar window.location para forzar recarga completa)
        window.location.href = '/';
    } catch (err) {
        if (err.response?.data?.errors) {
            // Mostrar errores de validación
            const errors = Object.values(err.response.data.errors).flat();
            error.value = errors.join(', ');
        } else {
            error.value = err.response?.data?.message || 'Error al crear la cuenta';
        }
    } finally {
        loading.value = false;
    }
};
</script>
