<template>
    <div class="min-h-screen organic-bg px-4 py-12">
        <div class="container mx-auto max-w-4xl">
            <!-- Header -->
            <div class="mb-8">
                <button @click="$router.back()" class="flex items-center gap-2 text-leaf hover:text-primary transition-colors mb-4">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Volver al listado
                </button>
                <h1 class="text-3xl font-black text-forest dark:text-white">
                    {{ isEditing ? 'Editar Agente' : 'Nuevo Agente' }}
                </h1>
            </div>

            <form @submit.prevent="submitForm" class="glass-effect dark:glass-effect-dark p-8 rounded-3xl border border-white/20 shadow-xl space-y-8">
                
                <!-- Error Message -->
                <div v-if="error" class="p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg">
                    {{ error }}
                </div>

                <!-- Datos de Usuario -->
                <div>
                    <h3 class="text-xl font-bold text-forest dark:text-white mb-4 border-b border-leaf/10 pb-2">Cuenta de Usuario</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Email *</label>
                            <input v-model="form.email" type="email" required class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">
                                Contraseña {{ isEditing ? '(Opcional)' : '*' }}
                            </label>
                            <input v-model="form.password" type="password" :required="!isEditing" class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" :placeholder="isEditing ? 'Dejar en blanco para mantener' : 'Mínimo 6 caracteres'" />
                        </div>
                    </div>
                </div>

                <!-- Datos del Agente -->
                <div>
                    <h3 class="text-xl font-bold text-forest dark:text-white mb-4 border-b border-leaf/10 pb-2">Perfil Profesional</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Nombre *</label>
                            <input v-model="form.nombre" type="text" required class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Apellidos *</label>
                            <input v-model="form.apellidos" type="text" required class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Teléfono *</label>
                            <input v-model="form.telefono" type="tel" required class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">DNI/NIF *</label>
                            <input v-model="form.dni" type="text" required class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Licencia</label>
                            <input v-model="form.licencia" type="text" class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Zona de Trabajo</label>
                            <input v-model="form.zona_trabajo" type="text" class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Comisión (%)</label>
                            <input v-model.number="form.comision_porcentaje" type="number" step="0.1" min="0" max="100" class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all" />
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end pt-6">
                    <button type="submit" :disabled="loading" class="bg-primary hover:bg-primary-dark text-white font-black py-4 px-8 rounded-xl shadow-lg hover:shadow-primary/50 transition-all transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span v-if="loading" class="flex items-center gap-2">
                             <div class="animate-spin h-5 w-5 border-2 border-white border-t-transparent rounded-full"></div>
                             Guardando...
                        </span>
                        <span v-else>
                            {{ isEditing ? 'Actualizar Agente' : 'Crear Agente' }}
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
    nombre: '',
    apellidos: '',
    telefono: '',
    dni: '',
    licencia: '',
    zona_trabajo: '',
    comision_porcentaje: null
});

const loading = ref(false);
const error = ref('');

const fetchAgente = async () => {
    if (!isEditing.value) return;
    try {
        const { data } = await axios.get(`/admin/agentes/${route.params.id}`);
        // Populate form
        form.value = {
            ...data,
            email: data.usuario?.email || '',
            password: '', // Should be empty for edit security
            // Ensure numbers
            comision_porcentaje: data.comision_porcentaje ? Number(data.comision_porcentaje) : null
        };
    } catch (err) {
        error.value = 'Error al cargar agente';
        console.error(err);
    }
};

const submitForm = async () => {
    loading.value = true;
    error.value = '';
    
    try {
        if (isEditing.value) {
            await axios.put(`/admin/agentes/${route.params.id}`, form.value);
        } else {
            await axios.post('/admin/agentes', form.value);
        }
        router.push('/admin/agentes');
    } catch (err) {
        if (err.response?.data?.errors) {
            error.value = 'Error: ' + Object.values(err.response.data.errors).flat().join(', ');
        } else {
            error.value = err.response?.data?.message || 'Error al guardar agente';
        }
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchAgente();
});
</script>
