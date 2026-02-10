<template>
    <div class="min-h-screen organic-bg px-4 py-12">
        <div class="container mx-auto max-w-4xl">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-3xl font-black text-forest dark:text-white flex items-center gap-3 mb-2">
                    <span class="material-symbols-outlined text-4xl">{{ modoEdicion ? 'edit_note' : 'add_circle' }}</span>
                    {{ modoEdicion ? 'Editar Artículo' : 'Nuevo Artículo' }}
                </h1>
                <p class="text-leaf">Completa los campos para {{ modoEdicion ? 'actualizar' : 'crear' }} el artículo</p>
            </div>

            <!-- Error Messages -->
            <div v-if="error" class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700 rounded-lg flex items-center gap-2">
                <span class="material-symbols-outlined">error</span>
                {{ error }}
            </div>

            <!-- Form -->
            <form @submit.prevent="guardarArticulo" class="glass-effect dark:glass-effect-dark rounded-3xl p-8 shadow-xl space-y-6">
                <!-- Título -->
                <div>
                    <label class="block text-forest dark:text-white font-bold mb-2">
                        Título *
                    </label>
                    <input v-model="form.titulo" 
                           type="text" 
                           required
                           placeholder="Ej: Guía completa de subvenciones 2026"
                           class="w-full px-4 py-3 rounded-lg border-2 border-leaf/20 focus:border-primary focus:outline-none transition-colors dark:bg-background-dark dark:text-white">
                    <p class="text-xs text-leaf mt-1">El slug se generará automáticamente a partir del título</p>
                </div>

                <!-- Extracto -->
                <div>
                    <label class="block text-forest dark:text-white font-bold mb-2">
                        Extracto
                    </label>
                    <textarea v-model="form.extracto" 
                              rows="2"
                              placeholder="Resumen corto del artículo (aparecerá en las tarjetas)"
                              class="w-full px-4 py-3 rounded-lg border-2 border-leaf/20 focus:border-primary focus:outline-none transition-colors dark:bg-background-dark dark:text-white"></textarea>
                </div>

                <!-- Contenido -->
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-forest dark:text-white font-bold">
                            Contenido * (HTML)
                        </label>
                        <button type="button" 
                                @click="mostrarVistaPrevia = !mostrarVistaPrevia"
                                class="text-sm font-semibold text-primary hover:text-leaf transition-colors flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">{{ mostrarVistaPrevia ? 'code' : 'visibility' }}</span>
                            {{ mostrarVistaPrevia ? 'Ver Código' : 'Vista Previa' }}
                        </button>
                    </div>
                    
                    <div class="grid" :class="mostrarVistaPrevia ? 'md:grid-cols-2 gap-4' : 'grid-cols-1'">
                        <!-- Editor de código -->
                        <div>
                            <textarea v-model="form.contenido" 
                                      rows="12"
                                      required
                                      placeholder="<p>Contenido del artículo en HTML...</p>"
                                      class="w-full px-4 py-3 rounded-lg border-2 border-leaf/20 focus:border-primary focus:outline-none transition-colors dark:bg-background-dark dark:text-white font-mono text-sm"></textarea>
                            <p class="text-xs text-leaf mt-1">Usa HTML para dar formato al contenido del artículo</p>
                        </div>
                        
                        <!-- Vista previa -->
                        <div v-if="mostrarVistaPrevia" class="border-2 border-leaf/20 rounded-lg p-4 bg-white dark:bg-background-dark/50 overflow-auto max-h-[400px]">
                            <div class="prose prose-sm dark:prose-invert max-w-none
                                        prose-headings:font-black prose-headings:text-forest dark:prose-headings:text-white
                                        prose-h2:text-2xl prose-h2:mt-6 prose-h2:mb-4
                                        prose-h3:text-xl prose-h3:mt-4 prose-h3:mb-2
                                        prose-p:text-leaf dark:prose-p:text-white/80 prose-p:leading-relaxed
                                        prose-li:text-leaf dark:prose-li:text-white/80
                                        prose-a:text-primary prose-a:font-semibold hover:prose-a:underline
                                        prose-strong:text-forest dark:prose-strong:text-white"
                                 v-html="form.contenido || '<p class=\'text-leaf/50 italic\'>La vista previa aparecerá aquí...</p>'">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Imagen Destacada -->
                <div>
                    <label class="block text-forest dark:text-white font-bold mb-2">
                        URL de Imagen Destacada
                    </label>
                    <input v-model="form.imagen_destacada" 
                           type="url" 
                           placeholder="https://example.com/imagen.jpg"
                           class="w-full px-4 py-3 rounded-lg border-2 border-leaf/20 focus:border-primary focus:outline-none transition-colors dark:bg-background-dark dark:text-white">
                    <p class="text-xs text-leaf mt-1">URL de Pexels u otra fuente de imágenes</p>
                </div>

                <!-- Categoría -->
                <div>
                    <label class="block text-forest dark:text-white font-bold mb-2">
                        Categoría *
                    </label>
                    <select v-model="form.categoria" 
                            required
                            class="w-full px-4 py-3 rounded-lg border-2 border-leaf/20 focus:border-primary focus:outline-none transition-colors dark:bg-background-dark dark:text-white">
                        <option value="ahorro_energetico">💡 Ahorro Energético</option>
                        <option value="subvenciones">💰 Subvenciones</option>
                        <option value="agenda_2030">🌍 Agenda 2030</option>
                        <option value="domotica_verde">🏠 Domótica Verde</option>
                        <option value="general">📄 General</option>
                    </select>
                </div>

                <!-- Publicado -->
                <div class="flex items-center gap-3">
                    <input v-model="form.publicado" 
                           type="checkbox" 
                           id="publicado"
                           class="w-5 h-5 rounded border-2 border-leaf/20 text-primary focus:ring-primary">
                    <label for="publicado" class="text-forest dark:text-white font-bold cursor-pointer">
                        Publicar artículo
                    </label>
                </div>
                <p class="text-xs text-leaf -mt-4 ml-8">Si está marcado, el artículo será visible en el blog público</p>

                <!-- Form Actions -->
                <div class="flex gap-4 pt-6 border-t border-leaf/10">
                    <button type="submit" 
                            :disabled="guardando"
                            class="flex-1 bg-primary hover:bg-primary-dark text-forest font-bold py-3 px-6 rounded-xl transition-all shadow-lg hover:shadow-primary/50 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined" v-if="!guardando">save</span>
                        <span v-if="guardando">Guardando...</span>
                        <span v-else>{{ modoEdicion ? 'Actualizar' : 'Crear' }} Artículo</span>
                    </button>
                    <button type="button" 
                            @click="$router.push('/admin/blog')"
                            class="px-6 py-3 border-2 border-leaf/20 text-forest dark:text-white font-bold rounded-xl hover:border-primary/40 transition-all">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import axios from 'axios';

const route = useRoute();
const router = useRouter();

const modoEdicion = computed(() => !!route.params.id);
const guardando = ref(false);
const error = ref('');
const mostrarVistaPrevia = ref(false);

const form = ref({
    titulo: '',
    contenido: '',
    extracto: '',
    imagen_destacada: '',
    categoria: 'general',
    publicado: false
});

const cargarArticulo = async () => {
    if (!modoEdicion.value) return;
    
    try {
        const { data } = await axios.get(`/admin/articulos`);
        const articulo = data.data.find(a => a.id == route.params.id);
        
        if (articulo) {
            form.value = {
                titulo: articulo.titulo,
                contenido: articulo.contenido,
                extracto: articulo.extracto || '',
                imagen_destacada: articulo.imagen_destacada || '',
                categoria: articulo.categoria,
                publicado: articulo.publicado
            };
        }
    } catch (err) {
        console.error('Error al cargar artículo:', err);
        error.value = 'Error al cargar el artículo';
    }
};

const guardarArticulo = async () => {
    guardando.value = true;
    error.value = '';
    
    try {
        if (modoEdicion.value) {
            await axios.put(`/articulos/${route.params.id}`, form.value);
        } else {
            await axios.post('/articulos', form.value);
        }
        
        router.push('/admin/blog');
    } catch (err) {
        console.error('Error al guardar artículo:', err);
        error.value = err.response?.data?.message || 'Error al guardar el artículo';
    } finally {
        guardando.value = false;
    }
};

onMounted(() => {
    cargarArticulo();
});
</script>
