<template>
    <div class="min-h-screen organic-bg px-4 py-12">
        <div class="container mx-auto max-w-2xl">
            <!-- Header -->
            <div class="mb-8">
                <button @click="$router.back()" class="flex items-center gap-2 text-leaf hover:text-primary transition-colors mb-4">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Volver al listado
                </button>
                <h1 class="text-3xl font-black text-forest dark:text-white">
                    {{ isEditing ? 'Editar Usuario' : 'Nuevo Usuario' }}
                </h1>
            </div>

            <form @submit.prevent="submitForm" class="glass-effect dark:glass-effect-dark p-8 rounded-3xl border border-white/20 shadow-xl space-y-6">
                
                <!-- Error Message -->
                <div v-if="error" class="p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg">
                    {{ error }}
                </div>

                <!-- Email -->
                <div>
                    <label class="block text-sm font-bold text-forest dark:text-white mb-2">Email *</label>
                    <input v-model="form.email" type="email" required class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-sm font-bold text-forest dark:text-white mb-2">
                        Contraseña {{ isEditing ? '(Opcional)' : '*' }}
                    </label>
                    <input v-model="form.password" type="password" :required="!isEditing" class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" :placeholder="isEditing ? 'Dejar en blanco para mantener' : 'Mínimo 6 caracteres'" />
                </div>

                <!-- Rol -->
                <div>
                    <label class="block text-sm font-bold text-forest dark:text-white mb-2">Rol *</label>
                    <select v-model="form.tipo_usuario" class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all">
                        <option value="comprador">Comprador</option>
                        <option value="vendedor">Vendedor</option>
                        <option value="agente">Agente</option>
                        <option value="administrador">Administrador</option>
                    </select>
                </div>

                <!-- Activo -->
                <div class="flex items-center gap-3 p-4 bg-white/30 dark:bg-background-dark/30 rounded-xl border border-leaf/20">
                    <input v-model="form.activo" type="checkbox" class="w-6 h-6 text-primary rounded focus:ring-primary" />
                    <span class="font-bold text-forest dark:text-white">Usuario Activo</span>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-6">
                    <button type="submit" :disabled="loading" class="bg-primary hover:bg-primary-dark text-white font-black py-4 px-8 rounded-xl shadow-lg hover:shadow-primary/50 transition-all transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span v-if="loading" class="flex items-center gap-2">
                             <div class="animate-spin h-5 w-5 border-2 border-white border-t-transparent rounded-full"></div>
                             Guardando...
                        </span>
                        <span v-else>
                            {{ isEditing ? 'Actualizar Usuario' : 'Crear Usuario' }}
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';

const route = useRoute();
const router = useRouter();
const isEditing = computed(() => !!route.params.id);

const form = ref({
    email: '',
    password: '',
    tipo_usuario: 'comprador',
    activo: true
});

const loading = ref(false);
const error = ref('');

const fetchUsuario = async () => {
    if (!isEditing.value) return;
    try {
        const { data } = await axios.get(`/admin/usuarios/${route.params.id}`);
        form.value = {
            ...data,
            password: '',
            activo: !!data.activo 
        };
    } catch (err) {
        error.value = 'Error al cargar usuario';
        console.error(err);
    }
};

const submitForm = async () => {
    loading.value = true;
    error.value = '';
    
    try {
        const payload = { ...form.value };
        // Ensure boolean
        payload.activo = payload.activo ? 1 : 0;
        
        if (isEditing.value) {
            await axios.put(`/admin/usuarios/${route.params.id}`, payload);
        } else {
            await axios.post('/admin/usuarios', payload);
        }
        router.push('/admin/usuarios');
    } catch (err) {
        if (err.response?.data?.errors) {
            error.value = 'Error: ' + Object.values(err.response.data.errors).flat().join(', ');
        } else {
            error.value = err.response?.data?.message || 'Error al guardar usuario';
        }
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchUsuario();
});
</script>
