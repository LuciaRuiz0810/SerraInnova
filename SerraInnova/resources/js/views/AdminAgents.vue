<template>
    <div class="min-h-screen organic-bg px-4 py-12">
        <div class="container mx-auto">
            <!-- Header -->
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h1 class="text-3xl font-black text-forest dark:text-white flex items-center gap-3">
                        <span class="material-symbols-outlined text-4xl">groups</span>
                        Gestión de Agentes
                    </h1>
                    <p class="text-leaf">Administra el equipo comercial</p>
                </div>
                <router-link to="/admin/agentes/nuevo" class="bg-primary hover:bg-primary-dark text-white font-bold py-3 px-6 rounded-xl flex items-center gap-2 transition-all shadow-lg hover:shadow-primary/50">
                    <span class="material-symbols-outlined">person_add</span>
                    Nuevo Agente
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

            <!-- Agents Table -->
            <div v-else class="glass-effect dark:glass-effect-dark rounded-3xl overflow-hidden shadow-xl border border-white/20">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-forest/5 dark:bg-white/5 border-b border-leaf/10 text-left">
                            <tr>
                                <th class="p-4 text-forest dark:text-white font-bold">Agente</th>
                                <th class="p-4 text-forest dark:text-white font-bold">Contacto</th>
                                <th class="p-4 text-forest dark:text-white font-bold">Zona</th>
                                <th class="p-4 text-forest dark:text-white font-bold text-center">Ventas</th>
                                <th class="p-4 text-forest dark:text-white font-bold text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="agente in agentes" :key="agente.id_agente" class="border-b border-leaf/5 hover:bg-white/50 dark:hover:bg-white/5 transition-colors">
                                <td class="p-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-primary/20 flex items-center justify-center text-primary font-bold">
                                            {{ agente.nombre ? agente.nombre.charAt(0) : '?' }}{{ agente.apellidos ? agente.apellidos.charAt(0) : '' }}
                                        </div>
                                        <div>
                                            <p class="font-bold text-forest dark:text-white">{{ agente.nombre }} {{ agente.apellidos }}</p>
                                            <p class="text-xs text-leaf">Licencia: {{ agente.licencia || 'N/A' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="text-sm text-forest dark:text-gray-300">
                                        <div class="flex items-center gap-1">
                                            <span class="material-symbols-outlined text-xs">mail</span>
                                            {{ agente.usuario?.email }}
                                        </div>
                                        <div class="flex items-center gap-1 mt-1">
                                            <span class="material-symbols-outlined text-xs">call</span>
                                            {{ agente.telefono }}
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-forest dark:text-gray-300 text-sm">
                                    {{ agente.zona_trabajo || 'Sin asignar' }}
                                </td>
                                <td class="p-4 text-center">
                                    <span class="inline-block px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-bold">
                                        {{ agente.ventas_totales }}
                                    </span>
                                </td>
                                <td class="p-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <router-link :to="`/admin/agentes/${agente.id_agente}`" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Editar">
                                            <span class="material-symbols-outlined">edit</span>
                                        </router-link>
                                        <button @click="confirmDelete(agente)" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Eliminar">
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

const agentes = ref([]);
const loading = ref(true);
const error = ref('');

const fetchAgentes = async () => {
    try {
        const { data } = await axios.get('/admin/agentes');
        agentes.value = data;
    } catch (err) {
        console.error(err);
        if (err.response) {
            error.value = `Error (${err.response.status}): ` + JSON.stringify(err.response.data);
        } else {
            error.value = err.message || 'Error al cargar agentes';
        }
    } finally {
        loading.value = false;
    }
};

const confirmDelete = async (agente) => {
    if(!confirm(`¿Estás seguro de eliminar a ${agente.nombre} ${agente.apellidos}? Esta acción borrará también su usuario.`)) return;
    
    try {
        await axios.delete(`/admin/agentes/${agente.id_agente}`);
        agentes.value = agentes.value.filter(a => a.id_agente !== agente.id_agente);
    } catch (err) {
        alert('Error al eliminar agente: ' + (err.response?.data?.message || err.message));
    }
};

onMounted(() => {
    fetchAgentes();
});
</script>
