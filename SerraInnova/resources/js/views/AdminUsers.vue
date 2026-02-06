<template>
    <div class="min-h-screen organic-bg px-4 py-12">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-black text-forest dark:text-white flex items-center gap-3">
                        <span class="material-symbols-outlined text-4xl">group</span>
                        Gestión de Usuarios
                    </h1>
                    <p class="text-leaf">Administra las cuentas de la plataforma</p>
                </div>
                <router-link to="/admin/usuarios/nuevo" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-6 rounded-xl flex items-center gap-2 transition-all shadow-lg hover:shadow-primary/50">
                    <span class="material-symbols-outlined">person_add</span>
                    Nuevo Usuario
                </router-link>
            </div>

            <!-- Error/Success Messages -->
            <div v-if="error" class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg flex items-center gap-2">
                <span class="material-symbols-outlined">error</span>
                {{ error }}
            </div>

            <!-- Loading State -->
            <div v-if="loading" class="flex justify-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-primary"></div>
            </div>

            <!-- Users Table -->
            <div v-else class="glass-effect dark:glass-effect-dark rounded-3xl overflow-hidden shadow-xl border border-white/20">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-forest/5 dark:bg-white/5 border-b border-leaf/10 text-left">
                            <tr>
                                <th class="p-4 text-forest dark:text-white font-bold">Usuario</th>
                                <th class="p-4 text-forest dark:text-white font-bold">Rol</th>
                                <th class="p-4 text-forest dark:text-white font-bold text-center">Estado</th>
                                <th class="p-4 text-forest dark:text-white font-bold text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user in usuarios" :key="user.id_usuario" class="border-b border-leaf/5 hover:bg-white/50 dark:hover:bg-white/5 transition-colors">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold">
                                            {{ user.email.charAt(0).toUpperCase() }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-forest dark:text-white">{{ user.email }}</p>
                                            <p class="text-xs text-leaf">ID: {{ user.id_usuario }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase" 
                                        :class="{
                                            'bg-purple-100 text-purple-800': user.tipo_usuario === 'administrador',
                                            'bg-blue-100 text-blue-800': user.tipo_usuario === 'agente',
                                            'bg-green-100 text-green-800': user.tipo_usuario === 'vendedor',
                                            'bg-gray-100 text-gray-800': user.tipo_usuario === 'comprador'
                                        }">
                                        {{ user.tipo_usuario }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <span class="px-2 py-1 rounded text-xs font-bold" :class="user.activo ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'">
                                        {{ user.activo ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <router-link :to="`/admin/usuarios/${user.id_usuario}`" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Editar">
                                            <span class="material-symbols-outlined">edit</span>
                                        </router-link>
                                        <button @click="confirmDelete(user)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Eliminar">
                                            <span class="material-symbols-outlined">delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const usuarios = ref([]);
const loading = ref(true);
const error = ref('');

const fetchUsuarios = async () => {
    try {
        const { data } = await axios.get('/admin/usuarios');
        usuarios.value = data;
    } catch (err) {
        console.error(err);
        if (err.response) {
            error.value = `Error (${err.response.status}): ` + JSON.stringify(err.response.data);
        } else {
            error.value = err.message || 'Error al cargar usuarios';
        }
    } finally {
        loading.value = false;
    }
};

const confirmDelete = async (user) => {
    if(!confirm(`¿Estás seguro de eliminar a ${user.email}?`)) return;
    
    try {
        await axios.delete(`/admin/usuarios/${user.id_usuario}`);
        usuarios.value = usuarios.value.filter(u => u.id_usuario !== user.id_usuario);
    } catch (err) {
        alert('Error al eliminar usuario');
    }
};

onMounted(() => {
    fetchUsuarios();
});
</script>
