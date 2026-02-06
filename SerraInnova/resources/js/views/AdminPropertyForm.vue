<template>
    <div class="min-h-screen organic-bg px-4 py-12">
        <div class="container mx-auto max-w-4xl">
            <!-- Header -->
            <div class="mb-8">
                <router-link to="/admin/propiedades" class="text-leaf hover:text-primary mb-2 inline-flex items-center gap-1 font-semibold">
                    <span class="material-symbols-outlined text-sm">arrow_back</span>
                    Volver al listado
                </router-link>
                <h1 class="text-3xl font-black text-forest dark:text-white">{{ isEditing ? 'Editar Propiedad' : 'Nueva Propiedad' }}</h1>
            </div>

            <!-- Form -->
            <form @submit.prevent="submitForm" class="glass-effect dark:glass-effect-dark rounded-3xl p-8 shadow-2xl border border-white/20">
                
                <!-- Basic Info -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="col-span-2">
                        <label class="block text-sm font-bold text-forest dark:text-white mb-2">Título del Anuncio</label>
                        <input v-model="form.titulo" required type="text" class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/50 outline-none transition-all" placeholder="Ej: Villa Sostenible con Vistas al Mar">
                    </div>

                    <div class="col-span-2">
                         <label class="block text-sm font-bold text-forest dark:text-white mb-2">Descripción</label>
                         <textarea v-model="form.descripcion" rows="4" class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/50 outline-none transition-all"></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-forest dark:text-white mb-2">Tipo de Propiedad</label>
                        <select v-model="form.tipo_propiedad" class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/50 outline-none transition-all">
                            <option value="casa">Casa</option>
                            <option value="apartamento">Apartamento</option>
                            <option value="local">Local Comercial</option>
                            <option value="terreno">Terreno</option>
                            <option value="oficina">Oficina</option>
                        </select>
                    </div>

                     <div>
                        <label class="block text-sm font-bold text-forest dark:text-white mb-2">Tipo de Operación</label>
                        <select v-model="form.tipo_operacion" class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/50 outline-none transition-all">
                            <option value="venta">Venta</option>
                            <option value="alquiler">Alquiler</option>
                            <option value="ambos">Ambos</option>
                        </select>
                    </div>

                     <div v-if="form.tipo_operacion !== 'alquiler'">
                        <label class="block text-sm font-bold text-forest dark:text-white mb-2">Precio Venta (€)</label>
                        <input v-model="form.precio_venta" type="number" class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/50 outline-none transition-all">
                    </div>

                    <div v-if="form.tipo_operacion !== 'venta'">
                        <label class="block text-sm font-bold text-forest dark:text-white mb-2">Precio Alquiler (€/mes)</label>
                        <input v-model="form.precio_alquiler" type="number" class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/50 outline-none transition-all">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                     <div>
                        <label class="block text-sm font-bold text-forest dark:text-white mb-2">Dirección</label>
                        <input v-model="form.direccion" required type="text" class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/50 outline-none transition-all">
                    </div>
                     <div>
                        <label class="block text-sm font-bold text-forest dark:text-white mb-2">Ciudad</label>
                        <input v-model="form.ciudad" required type="text" class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary focus:ring-2 focus:ring-primary/50 outline-none transition-all">
                    </div>
                </div>

                <!-- Detalles -->
                <h3 class="text-xl font-bold text-forest dark:text-white mb-4 border-b border-leaf/10 pb-2">Características</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div>
                        <label class="block text-xs font-bold text-leaf mb-1">M²</label>
                        <input v-model="form.metros_cuadrados" type="number" class="w-full px-3 py-2 rounded-lg bg-white/50 dark:bg-black/20 border border-leaf/20">
                    </div>
                    <div>
                         <label class="block text-xs font-bold text-leaf mb-1">Habitaciones</label>
                        <input v-model="form.habitaciones" type="number" class="w-full px-3 py-2 rounded-lg bg-white/50 dark:bg-black/20 border border-leaf/20">
                    </div>
                    <div>
                         <label class="block text-xs font-bold text-leaf mb-1">Baños</label>
                        <input v-model="form.banos" type="number" class="w-full px-3 py-2 rounded-lg bg-white/50 dark:bg-black/20 border border-leaf/20">
                    </div>
                </div>

                 <div class="flex flex-wrap gap-4 mb-8">
                    <label class="flex items-center gap-2 cursor-pointer bg-white/40 px-4 py-2 rounded-lg hover:bg-white/60 transition">
                        <input v-model="form.garaje" type="checkbox" class="w-4 h-4 text-primary rounded focus:ring-primary">
                        <span class="text-sm font-medium">Garaje</span>
                    </label>
                     <label class="flex items-center gap-2 cursor-pointer bg-white/40 px-4 py-2 rounded-lg hover:bg-white/60 transition">
                        <input v-model="form.jardin" type="checkbox" class="w-4 h-4 text-primary rounded focus:ring-primary">
                        <span class="text-sm font-medium">Jardín</span>
                    </label>
                     <label class="flex items-center gap-2 cursor-pointer bg-white/40 px-4 py-2 rounded-lg hover:bg-white/60 transition">
                        <input v-model="form.piscina" type="checkbox" class="w-4 h-4 text-primary rounded focus:ring-primary">
                        <span class="text-sm font-medium">Piscina</span>
                    </label>
                     <label class="flex items-center gap-2 cursor-pointer bg-white/40 px-4 py-2 rounded-lg hover:bg-white/60 transition">
                        <input v-model="form.ascensor" type="checkbox" class="w-4 h-4 text-primary rounded focus:ring-primary">
                        <span class="text-sm font-medium">Ascensor</span>
                    </label>
                </div>

                <!-- Sostenibilidad y Eficiencia Energética -->
                <h3 class="text-xl font-bold text-forest dark:text-white mb-4 border-b border-leaf/10 pb-2 mt-8 flex items-center gap-2">
                    <span class="material-symbols-outlined text-primary">eco</span>
                    Sostenibilidad y Eficiencia Energética
                </h3>
                
                <div class="space-y-6 mb-8">
                    <!-- Etiqueta Energética -->
                    <div>
                        <label class="block text-sm font-bold text-forest dark:text-white mb-3">Etiqueta de Eficiencia Energética</label>
                        <div class="grid grid-cols-7 gap-2">
                            <button
                                v-for="label in ['A', 'B', 'C', 'D', 'E', 'F', 'G']"
                                :key="label"
                                type="button"
                                @click="form.etiqueta_energetica = label"
                                :class="[
                                    'py-3 px-2 rounded-lg font-black text-white transition-all duration-300',
                                    form.etiqueta_energetica === label ? 'scale-110 shadow-xl ring-4 ring-white/50' : 'opacity-60 hover:opacity-100',
                                    getEnergyLabelColor(label)
                                ]"
                            >
                                {{ label }}
                            </button>
                        </div>
                    </div>

                    <!-- Huella de Carbono y Ahorro -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">
                                Huella de Carbono Anual (kg CO₂/año)
                            </label>
                            <input
                                v-model.number="form.huella_carbono_anual"
                                type="number"
                                min="0"
                                step="0.01"
                                class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary"
                                placeholder="1500.50"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">
                                Ahorro Estimado de CO₂ (kg/año)
                            </label>
                            <input
                                v-model.number="form.ahorro_co2_estimado"
                                type="number"
                                min="0"
                                step="0.01"
                                class="w-full px-4 py-3 rounded-xl bg-white/50 dark:bg-black/20 border border-leaf/20 focus:border-primary"
                                placeholder="800.00"
                            />
                        </div>
                    </div>

                    <!-- Checklist de Sostenibilidad -->
                    <div class="space-y-4">
                        <h4 class="text-sm font-bold text-forest dark:text-white mt-4">Checklist de Sostenibilidad</h4>
                        
                        <!-- Aislamiento Térmico -->
                        <div>
                            <p class="text-xs font-semibold text-leaf mb-2 font-bold uppercase tracking-wider">Aislamiento Térmico</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.aislamiento_termico.ventanas_climalit" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">Ventanas Climalit</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.aislamiento_termico.sate" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">SATE</span>
                                </label>
                            </div>
                        </div>

                        <!-- Fuentes de Energía -->
                        <div>
                            <p class="text-xs font-semibold text-leaf mb-2 font-bold uppercase tracking-wider">Fuentes de Energía</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.fuentes_energia.aerotermia" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">Aerotermia</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.fuentes_energia.placas_solares" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">Placas Solares</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.fuentes_energia.biomasa" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">Biomasa</span>
                                </label>
                            </div>
                        </div>

                        <!-- Consumo de Agua -->
                        <div>
                            <p class="text-xs font-semibold text-leaf mb-2 font-bold uppercase tracking-wider">Consumo de Agua</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.consumo_agua.recuperacion_pluviales" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">Sistema de Recuperación de Pluviales</span>
                                </label>
                            </div>
                        </div>

                        <!-- Materiales Sostenibles -->
                        <div>
                            <p class="text-xs font-semibold text-leaf mb-2 font-bold uppercase tracking-wider">Materiales Sostenibles</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.materiales_sostenibles.maderas_certificadas" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">Maderas Certificadas</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.materiales_sostenibles.pinturas_ecologicas" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">Pinturas Ecológicas</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Certificaciones Externas -->
                    <div>
                        <h3 class="text-sm font-bold text-forest dark:text-white mb-3">Certificaciones Externas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="flex items-center gap-3 cursor-pointer p-4 bg-white/30 dark:bg-background-dark/30 rounded-xl border border-leaf/20 hover:border-primary/50 transition-all">
                                <input v-model="form.certificacion_breeam" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                <div>
                                    <span class="text-sm font-black text-forest dark:text-white block">BREEAM</span>
                                    <span class="text-xs text-leaf">Building Research Establishment</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer p-4 bg-white/30 dark:bg-background-dark/30 rounded-xl border border-leaf/20 hover:border-primary/50 transition-all">
                                <input v-model="form.certificacion_leed" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                <div>
                                    <span class="text-sm font-black text-forest dark:text-white block">LEED</span>
                                    <span class="text-xs text-leaf">Leadership in Energy</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer p-4 bg-white/30 dark:bg-background-dark/30 rounded-xl border border-leaf/20 hover:border-primary/50 transition-all">
                                <input v-model="form.certificacion_passivhaus" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                <div>
                                    <span class="text-sm font-black text-forest dark:text-white block">Passivhaus</span>
                                    <span class="text-xs text-leaf">Estándar Alemán</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Files: Gallery & PDF -->
                <h3 class="text-xl font-bold text-forest dark:text-white mb-4 border-b border-leaf/10 pb-2">Multimedia y Documentos</h3>
                
                <div class="mb-6 grid grid-cols-1 md:grid-cols-2 gap-8">
                     <!-- Gallery Upload -->
                     <div>
                        <label class="block text-sm font-bold text-forest dark:text-white mb-2">Galería de Imágenes</label>
                        <div class="border-2 border-dashed border-leaf/30 rounded-xl p-8 text-center hover:bg-white/30 transition-colors cursor-pointer relative">
                             <input type="file" multiple @change="handleGalleryUpload" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer">
                             <span class="material-symbols-outlined text-4xl text-leaf mb-2">add_photo_alternate</span>
                             <p class="text-sm text-leaf">Arrastra fotos o haz clic para subir</p>
                        </div>
                        
                        <!-- Preview -->
                         <div v-if="previewImages.length || existingImages.length" class="mt-4 grid grid-cols-3 gap-2">
                             <div v-for="img in existingImages" :key="img.id" class="relative group aspect-square rounded-lg overflow-hidden">
                                 <img :src="img.url" class="w-full h-full object-cover">
                                 <!-- Delete would go here -->
                             </div>
                             <div v-for="(img, idx) in previewImages" :key="idx" class="relative group aspect-square rounded-lg overflow-hidden border-2 border-primary">
                                 <img :src="img.url" class="w-full h-full object-cover opacity-80">
                             </div>
                         </div>
                     </div>

                     <!-- PDF Upload -->
                      <div>
                        <label class="block text-sm font-bold text-forest dark:text-white mb-2">Certificado Energético (PDF)</label>
                        <div class="border-2 border-dashed border-leaf/30 rounded-xl p-8 text-center hover:bg-white/30 transition-colors cursor-pointer relative">
                             <input type="file" @change="handlePdfUpload" accept="application/pdf" class="absolute inset-0 opacity-0 cursor-pointer">
                             <span class="material-symbols-outlined text-4xl text-leaf mb-2">picture_as_pdf</span>
                             <p v-if="form.certificado_file" class="text-sm font-bold text-primary">{{ form.certificado_file.name }}</p>
                             <p v-else-if="existingPdf" class="text-sm font-bold text-primary">PDF Guardado: {{ existingPdf.split('/').pop() }}</p>
                             <p v-else class="text-sm text-leaf">Subir archivo PDF</p>
                        </div>
                     </div>
                </div>

                <!-- Submit -->
                <div class="flex justify-end pt-6 border-t border-leaf/10">
                    <button type="submit" :disabled="loading" class="bg-primary hover:bg-primary/90 text-forest font-bold py-3 px-8 rounded-xl transition-all shadow-lg hover:shadow-primary/30 disabled:opacity-50 disabled:cursor-not-allowed">
                        <span v-if="loading" class="flex items-center gap-2">
                            <span class="animate-spin material-symbols-outlined">sync</span> Guardando...
                        </span>
                        <span v-else>{{ isEditing ? 'Actualizar Propiedad' : 'Publicar Propiedad' }}</span>
                    </button>
                </div>

                <div v-if="error" class="mt-4 p-4 bg-red-100 text-red-700 rounded-xl">
                    {{ error }}
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
const isEditing = computed(() => !!route.params.id);

const form = ref({
    titulo: '',
    descripcion: '',
    tipo_propiedad: 'casa',
    tipo_operacion: 'venta',
    precio_venta: null,
    precio_alquiler: null,
    direccion: '',
    ciudad: '',
    metros_cuadrados: null,
    habitaciones: null,
    banos: null,
    garaje: false,
    jardin: false,
    piscina: false,
    ascensor: false,
    amueblado: false,
    // Sostenibilidad
    etiqueta_energetica: null,
    huella_carbono_anual: null,
    ahorro_co2_estimado: null,
    aislamiento_termico: {
        ventanas_climalit: false,
        sate: false
    },
    fuentes_energia: {
        aerotermia: false,
        placas_solares: false,
        biomasa: false
    },
    consumo_agua: {
        recuperacion_pluviales: false
    },
    materiales_sostenibles: {
        maderas_certificadas: false,
        pinturas_ecologicas: false
    },
    certificacion_breeam: false,
    certificacion_leed: false,
    certificacion_passivhaus: false,
    // Files
    certificado_file: null,
    galeria_files: [],
});

const existingImages = ref([]);
const existingPdf = ref(null);
const previewImages = ref([]);
const loading = ref(false);
const error = ref('');

const getEnergyLabelColor = (label) => {
    const colors = {
        'A': 'bg-[#13ec5b]',
        'B': 'bg-[#4c9a66]',
        'C': 'bg-[#f4e04d]',
        'D': 'bg-[#f9a825]',
        'E': 'bg-[#ff8c00]',
        'F': 'bg-[#ff6347]',
        'G': 'bg-[#dc143c]',
    };
    return colors[label] || 'bg-gray-400';
};

const fetchProperty = async () => {
    if (!isEditing.value) return;
    try {
        const { data } = await axios.get(`/propiedades/${route.params.id}`);
        // Populate form
        // Handle basic fields
        form.value = { ...form.value, ...data };
        
        // Helper to parse JSON safely
        const parseJson = (val) => {
             if (typeof val === 'string') {
                try { return JSON.parse(val); } catch (e) { return {}; }
             }
             return val || {};
        };

        // Populate sustainability objects specifically (merge with defaults to ensure controls exist)
        form.value.aislamiento_termico = { ...form.value.aislamiento_termico, ...parseJson(data.aislamiento_termico) };
        form.value.fuentes_energia = { ...form.value.fuentes_energia, ...parseJson(data.fuentes_energia) };
        form.value.consumo_agua = { ...form.value.consumo_agua, ...parseJson(data.consumo_agua) };
        form.value.materiales_sostenibles = { ...form.value.materiales_sostenibles, ...parseJson(data.materiales_sostenibles) };

        // Handle Booleans as Booleans (MySQL returns 1/0)
        form.value.certificacion_breeam = !!data.certificacion_breeam;
        form.value.certificacion_leed = !!data.certificacion_leed;
        form.value.certificacion_passivhaus = !!data.certificacion_passivhaus;
        form.value.garaje = !!data.garaje;
        form.value.jardin = !!data.jardin;
        form.value.piscina = !!data.piscina;
        form.value.ascensor = !!data.ascensor;
        form.value.amueblado = !!data.amueblado;
        
        // Handle images
        if (data.imagenes && data.imagenes.length) {
            existingImages.value = data.imagenes;
        } else if (data.fotos) {
             try {
                const fotos = typeof data.fotos === 'string' ? JSON.parse(data.fotos) : data.fotos;
                existingImages.value = fotos.map((url, i) => ({ id: i, url }));
            } catch (e) {}
        }

        // Handle PDF
        if (data.certificado_energetico_pdf) {
            existingPdf.value = data.certificado_energetico_pdf;
        }

    } catch (err) {
        error.value = 'Error al cargar datos.';
        console.error(err);
    }
};

const handleGalleryUpload = (e) => {
    const files = Array.from(e.target.files);
    form.value.galeria_files = [...form.value.galeria_files, ...files];
    
    // Create previews
    files.forEach(file => {
        const reader = new FileReader();
        reader.onload = (e) => previewImages.value.push({ url: e.target.result });
        reader.readAsDataURL(file);
    });
};

const handlePdfUpload = (e) => {
    form.value.certificado_file = e.target.files[0];
};

const submitForm = async () => {
    try {
        loading.value = true;
        error.value = '';

        const formData = new FormData();
        
        // Append fields
        for (const key in form.value) {
            // Skip files and objects
            if (['certificado_file', 'galeria_files', 'aislamiento_termico', 'fuentes_energia', 'consumo_agua', 'materiales_sostenibles'].includes(key)) {
                continue;
            }
            // Strict check: only append if not null and not empty string
            if (form.value[key] !== null && form.value[key] !== '') {
                // Handle booleans explicitly: 1 or 0
                if (typeof form.value[key] === 'boolean') {
                     formData.append(key, form.value[key] ? '1' : '0');
                } else {
                     formData.append(key, form.value[key]);
                }
            }
        }

        // Append JSON Objects (Stringified)
        formData.append('aislamiento_termico', JSON.stringify(form.value.aislamiento_termico));
        formData.append('fuentes_energia', JSON.stringify(form.value.fuentes_energia));
        formData.append('consumo_agua', JSON.stringify(form.value.consumo_agua));
        formData.append('materiales_sostenibles', JSON.stringify(form.value.materiales_sostenibles));

        // Append Files
        if (form.value.certificado_file) {
            formData.append('certificado_energetico', form.value.certificado_file);
        }
        
        form.value.galeria_files.forEach((file) => {
            formData.append('galeria[]', file);
        });

        if (isEditing.value) {
            formData.append('_method', 'PUT'); // Fake put for Laravel file upload support
            await axios.post(`/propiedades/${route.params.id}`, formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
        } else {
            await axios.post('/propiedades', formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
        }

        router.push('/admin/propiedades');

    } catch (err) {
        console.error(err);
        if (err.response) {
            // Mostrar error crudo del servidor para debugging
            error.value = `Error Server (${err.response.status}): ` + JSON.stringify(err.response.data);
        } else {
            error.value = err.message || 'Error desconocido';
        }
    } finally {
        loading.value = false;
    }
};

onMounted(() => {
    fetchProperty();
});
</script>
