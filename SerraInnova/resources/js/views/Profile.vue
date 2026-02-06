<template>
    <div class="organic-bg min-h-screen pt-24 pb-16">
        <div class="container mx-auto px-6 max-w-4xl">
            <h1 class="text-3xl md:text-5xl font-black text-forest dark:text-white mb-8 text-center">Mi Perfil</h1>

            <div class="bg-white/80 dark:bg-background-dark/80 backdrop-blur-md rounded-3xl p-8 shadow-2xl border border-leaf/10">
                <div v-if="loading" class="flex justify-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary"></div>
                </div>

                <div v-else class="flex flex-col md:flex-row gap-12">
                    <!-- Sidebar: Foto y Resumen -->
                    <div class="flex flex-col items-center gap-6 md:w-1/3">
                        <div class="relative group">
                            <div class="size-40 rounded-full overflow-hidden border-4 border-primary shadow-xl bg-gray-200">
                                <img :src="previewImage || user?.foto_perfil || `https://ui-avatars.com/api/?name=${user?.agente?.nombre || user?.cliente?.nombre || 'User'}&background=13ec5b&color=0d1b12`" 
                                     alt="Perfil" 
                                     class="w-full h-full object-cover">
                            </div>
                            <button @click="triggerFileInput" class="absolute bottom-2 right-2 bg-forest text-white p-3 rounded-full shadow-lg hover:scale-110 transition-transform cursor-pointer group-hover:bg-primary group-hover:text-forest">
                                <span class="material-symbols-outlined text-sm">edit</span>
                            </button>
                            <input type="file" ref="fileInput" @change="handleFileChange" class="hidden" accept="image/*">
                        </div>
                        
                        <div class="text-center">
                            <h2 class="text-xl font-bold text-forest dark:text-white">
                                {{ user?.agente?.nombre || user?.cliente?.nombre }}
                            </h2>
                            <span class="inline-block mt-1 px-3 py-1 bg-leaf/20 text-leaf text-xs font-bold rounded-full uppercase tracking-widest">
                                {{ user?.tipo_usuario }}
                            </span>
                        </div>
                    </div>

                    <!-- Main: Formulario -->
                    <div class="flex-1">
                        <form @submit.prevent="updateProfile" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-xs font-bold text-leaf uppercase tracking-wider mb-2">Nombre</label>
                                    <input v-model="form.nombre" type="text" class="w-full px-4 py-3 bg-white dark:bg-background-dark/50 border border-leaf/20 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none transition-all" required>
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-leaf uppercase tracking-wider mb-2">Apellidos</label>
                                    <input v-model="form.apellidos" type="text" class="w-full px-4 py-3 bg-white dark:bg-background-dark/50 border border-leaf/20 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none transition-all" required>
                                </div>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-leaf uppercase tracking-wider mb-2">Email</label>
                                <input v-model="form.email" type="email" class="w-full px-4 py-3 bg-white dark:bg-background-dark/50 border border-leaf/20 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none transition-all" required>
                            </div>

                            <div>
                                <label class="block text-xs font-bold text-leaf uppercase tracking-wider mb-2">Teléfono</label>
                                <input v-model="form.telefono" type="tel" class="w-full px-4 py-3 bg-white dark:bg-background-dark/50 border border-leaf/20 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none transition-all" required>
                            </div>

                            <!-- Campos Específicos -->
                            <div v-if="user?.tipo_usuario === 'agente'">
                                <label class="block text-xs font-bold text-leaf uppercase tracking-wider mb-2">DNI / NIF</label>
                                <input v-model="form.dni" type="text" class="w-full px-4 py-3 bg-white dark:bg-background-dark/50 border border-leaf/20 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none transition-all" required>
                            </div>

                            <div v-if="user?.tipo_usuario === 'cliente'">
                                <label class="block text-xs font-bold text-leaf uppercase tracking-wider mb-2">Dirección</label>
                                <input v-model="form.direccion" type="text" class="w-full px-4 py-3 bg-white dark:bg-background-dark/50 border border-leaf/20 rounded-xl focus:ring-2 focus:ring-primary focus:outline-none transition-all" placeholder="Tu dirección completa">
                            </div>

                            <!-- Mensajes -->
                            <div v-if="error" class="bg-red-50 text-red-600 p-4 rounded-xl text-sm font-medium border border-red-100 flex items-center gap-2">
                                <span class="material-symbols-outlined">error</span>
                                {{ error }}
                            </div>
                            
                            <div v-if="success" class="bg-green-50 text-green-600 p-4 rounded-xl text-sm font-medium border border-green-100 flex items-center gap-2">
                                <span class="material-symbols-outlined">check_circle</span>
                                {{ success }}
                            </div>

                            <!-- Botón Guardar -->
                            <button type="submit" :disabled="saving" class="w-full bg-forest text-white font-bold py-4 rounded-xl hover:bg-forest/90 transition-all shadow-lg flex items-center justify-center gap-2 disabled:opacity-50">
                                <span v-if="!saving">Guardar Cambios</span>
                                <span v-else>Guardando...</span>
                                <span v-if="!saving" class="material-symbols-outlined">save</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue';
import axios from 'axios';

const user = ref(null);
const loading = ref(true);
const saving = ref(false);
const error = ref('');
const success = ref('');
const fileInput = ref(null);
const previewImage = ref(null);
const selectedFile = ref(null);

const form = reactive({
    nombre: '',
    apellidos: '',
    email: '',
    telefono: '',
    dni: '',
    direccion: ''
});

onMounted(() => {
    loadUserProfile();
});

const loadUserProfile = async () => {
    try {
        // Cargar desde localStorage primero para rapidez
        const storedUser = localStorage.getItem('user');
        if (storedUser) {
            user.value = JSON.parse(storedUser);
            fillForm(user.value);
        }

        // Refrescar desde API
        const response = await axios.get('/me');
        user.value = response.data;
        localStorage.setItem('user', JSON.stringify(user.value));
        fillForm(user.value);
    } catch (err) {
        console.error('Error cargando perfil:', err);
        error.value = 'No se pudo cargar la información del perfil.';
    } finally {
        loading.value = false;
    }
};

const fillForm = (userData) => {
    form.email = userData.email;
    if (userData.tipo_usuario === 'agente' && userData.agente) {
        form.nombre = userData.agente.nombre;
        form.apellidos = userData.agente.apellidos;
        form.telefono = userData.agente.telefono;
        form.dni = userData.agente.dni;
    } else if (userData.tipo_usuario === 'cliente' && userData.cliente) {
        form.nombre = userData.cliente.nombre;
        form.apellidos = userData.cliente.apellidos;
        form.telefono = userData.cliente.telefono;
        form.direccion = userData.cliente.direccion;
    }
};

const triggerFileInput = () => {
    fileInput.value.click();
};

const handleFileChange = (event) => {
    const file = event.target.files[0];
    if (file) {
        selectedFile.value = file;
        previewImage.value = URL.createObjectURL(file);
    }
};

const updateProfile = async () => {
    try {
        saving.value = true;
        error.value = '';
        success.value = '';

        const formData = new FormData();
        formData.append('nombre', form.nombre);
        formData.append('apellidos', form.apellidos);
        formData.append('email', form.email);
        formData.append('telefono', form.telefono);

        if (user.value.tipo_usuario === 'agente') {
            formData.append('dni', form.dni);
        } else {
            formData.append('direccion', form.direccion || '');
        }

        if (selectedFile.value) {
            formData.append('foto', selectedFile.value);
        }

        const response = await axios.post('/profile', formData, {
            headers: {
                'Content-Type': 'multipart/form-data'
            }
        });

        success.value = response.data.message;
        user.value = response.data.user;
        localStorage.setItem('user', JSON.stringify(user.value));
        
        // Emitir evento simple para notificar cambios a otros componentes si fuera necesario
        // window.dispatchEvent(new CustomEvent('user-updated'));

    } catch (err) {
        if (err.response?.data?.errors) {
            error.value = Object.values(err.response.data.errors).flat().join(', ');
        } else {
            error.value = err.response?.data?.message || 'Error al actualizar el perfil.';
        }
    } finally {
        saving.value = false;
    }
};
</script>
