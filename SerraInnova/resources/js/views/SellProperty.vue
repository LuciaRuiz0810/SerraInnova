<template>
    <div class="min-h-screen px-4 py-12 organic-bg">
        <div class="max-w-4xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-4xl font-black text-forest dark:text-white mb-2">Publicar Propiedad</h1>
                <p class="text-leaf">Completa el formulario para añadir una nueva propiedad</p>
            </div>

            <!-- Formulario -->
            <form @submit.prevent="handleSubmit" class="glass-effect dark:glass-effect-dark rounded-3xl p-8 shadow-2xl border-2 border-primary/20 glow-primary space-y-8">
                
                <!-- Información Básica -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-black text-forest dark:text-white border-b-2 border-primary/20 pb-2">Información Básica</h2>
                    
                    <div>
                        <label class="block text-sm font-bold text-forest dark:text-white mb-2">Título *</label>
                        <input
                            v-model="form.titulo"
                            type="text"
                            required
                            class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                            placeholder="Ej: Apartamento céntrico con vistas"
                        />
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-forest dark:text-white mb-2">Descripción</label>
                        <textarea
                            v-model="form.descripcion"
                            rows="4"
                            class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                            placeholder="Describe la propiedad en detalle..."
                        ></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Tipo de Propiedad *</label>
                            <select
                                v-model="form.tipo_propiedad"
                                required
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                            >
                                <option value="">Selecciona...</option>
                                <option value="casa">Casa</option>
                                <option value="apartamento">Apartamento</option>
                                <option value="local">Local Comercial</option>
                                <option value="terreno">Terreno</option>
                                <option value="oficina">Oficina</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Tipo de Operación *</label>
                            <select
                                v-model="form.tipo_operacion"
                                required
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                            >
                                <option value="">Selecciona...</option>
                                <option value="venta">Venta</option>
                                <option value="alquiler">Alquiler</option>
                                <option value="ambos">Ambos</option>
                            </select>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div v-if="form.tipo_operacion === 'venta' || form.tipo_operacion === 'ambos'">
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Precio de Venta (€)</label>
                            <input
                                v-model.number="form.precio_venta"
                                type="number"
                                min="0"
                                step="1000"
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="250000"
                            />
                        </div>

                        <div v-if="form.tipo_operacion === 'alquiler' || form.tipo_operacion === 'ambos'">
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Precio de Alquiler (€/mes)</label>
                            <input
                                v-model.number="form.precio_alquiler"
                                type="number"
                                min="0"
                                step="50"
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="850"
                            />
                        </div>
                    </div>
                </div>

                <!-- Ubicación -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-black text-forest dark:text-white border-b-2 border-primary/20 pb-2">Ubicación</h2>
                    
                    <div>
                        <label class="block text-sm font-bold text-forest dark:text-white mb-2">Dirección *</label>
                        <input
                            v-model="form.direccion"
                            type="text"
                            required
                            class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                            placeholder="Calle Mayor 10"
                        />
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Ciudad *</label>
                            <input
                                v-model="form.ciudad"
                                type="text"
                                required
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="Valencia"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Provincia</label>
                            <input
                                v-model="form.provincia"
                                type="text"
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="Valencia"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Código Postal</label>
                            <input
                                v-model="form.codigo_postal"
                                type="text"
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="46001"
                            />
                        </div>
                    </div>
                </div>

                <!-- Características -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-black text-forest dark:text-white border-b-2 border-primary/20 pb-2">Características</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Metros Cuadrados</label>
                            <input
                                v-model.number="form.metros_cuadrados"
                                type="number"
                                min="0"
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="120"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Habitaciones</label>
                            <input
                                v-model.number="form.habitaciones"
                                type="number"
                                min="0"
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="3"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">Baños</label>
                            <input
                                v-model.number="form.banos"
                                type="number"
                                min="0"
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="2"
                            />
                        </div>
                    </div>

                    <!-- Extras -->
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <label class="flex items-center gap-3 cursor-pointer p-4 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                            <input v-model="form.garaje" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                            <span class="text-sm font-semibold text-forest dark:text-white">Garaje</span>
                        </label>

                        <label class="flex items-center gap-3 cursor-pointer p-4 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                            <input v-model="form.jardin" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                            <span class="text-sm font-semibold text-forest dark:text-white">Jardín</span>
                        </label>

                        <label class="flex items-center gap-3 cursor-pointer p-4 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                            <input v-model="form.piscina" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                            <span class="text-sm font-semibold text-forest dark:text-white">Piscina</span>
                        </label>

                        <label class="flex items-center gap-3 cursor-pointer p-4 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                            <input v-model="form.ascensor" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                            <span class="text-sm font-semibold text-forest dark:text-white">Ascensor</span>
                        </label>

                        <label class="flex items-center gap-3 cursor-pointer p-4 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                            <input v-model="form.amueblado" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                            <span class="text-sm font-semibold text-forest dark:text-white">Amueblado</span>
                        </label>
                    </div>
                </div>

                <!-- Sostenibilidad y Eficiencia Energética -->
                <div class="space-y-6">
                    <h2 class="text-2xl font-black text-forest dark:text-white border-b-2 border-primary/20 pb-2 flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">eco</span>
                        Sostenibilidad y Eficiencia Energética
                    </h2>
                    
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
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="1500.50"
                            />
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-forest dark:text-white mb-2">
                                Ahorro Estimado de CO₂ (kg/año vs estándar)
                            </label>
                            <input
                                v-model.number="form.ahorro_co2_estimado"
                                type="number"
                                min="0"
                                step="0.01"
                                class="w-full px-4 py-3 bg-white/50 dark:bg-background-dark/50 border-2 border-leaf/20 rounded-xl focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all"
                                placeholder="800.00"
                            />
                        </div>
                    </div>

                    <!-- Checklist de Sostenibilidad -->
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-forest dark:text-white">Checklist de Sostenibilidad</h3>
                        
                        <!-- Aislamiento Térmico -->
                        <div>
                            <p class="text-sm font-semibold text-leaf mb-2">Aislamiento Térmico</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.aislamiento_termico.ventanas_climalit" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">Ventanas Climalit</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.aislamiento_termico.sate" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">SATE (Aislamiento Exterior)</span>
                                </label>
                            </div>
                        </div>

                        <!-- Fuentes de Energía -->
                        <div>
                            <p class="text-sm font-semibold text-leaf mb-2">Fuentes de Energía</p>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.fuentes_energia.aerotermia" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">Aerotermia</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.fuentes_energia.placas_solares" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">Placas Solares</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.fuentes_energia.biomasa" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">Biomasa</span>
                                </label>
                            </div>
                        </div>

                        <!-- Consumo de Agua -->
                        <div>
                            <p class="text-sm font-semibold text-leaf mb-2">Consumo de Agua</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.consumo_agua.recuperacion_pluviales" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">Sistema de Recuperación de Pluviales</span>
                                </label>
                            </div>
                        </div>

                        <!-- Materiales Sostenibles -->
                        <div>
                            <p class="text-sm font-semibold text-leaf mb-2">Materiales Sostenibles</p>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.materiales_sostenibles.maderas_certificadas" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">Maderas Certificadas</span>
                                </label>
                                <label class="flex items-center gap-3 cursor-pointer p-3 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                                    <input v-model="form.materiales_sostenibles.pinturas_ecologicas" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                    <span class="text-sm font-semibold text-forest dark:text-white">Pinturas Ecológicas</span>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Certificaciones Externas -->
                    <div>
                        <h3 class="text-lg font-bold text-forest dark:text-white mb-3">Certificaciones Externas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <label class="flex items-center gap-3 cursor-pointer p-4 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                                <input v-model="form.certificacion_breeam" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                <div>
                                    <span class="text-sm font-black text-forest dark:text-white block">BREEAM</span>
                                    <span class="text-xs text-leaf">Building Research Establishment</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer p-4 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                                <input v-model="form.certificacion_leed" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                <div>
                                    <span class="text-sm font-black text-forest dark:text-white block">LEED</span>
                                    <span class="text-xs text-leaf">Leadership in Energy</span>
                                </div>
                            </label>
                            <label class="flex items-center gap-3 cursor-pointer p-4 bg-white/30 dark:bg-background-dark/30 rounded-xl border-2 border-leaf/20 hover:border-primary/50 transition-all">
                                <input v-model="form.certificacion_passivhaus" type="checkbox" class="w-5 h-5 text-primary rounded focus:ring-primary" />
                                <div>
                                    <span class="text-sm font-black text-forest dark:text-white block">Passivhaus</span>
                                    <span class="text-xs text-leaf">Estándar Alemán</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- Error Message -->
                <div v-if="error" class="bg-red-500/10 border-2 border-red-500/30 rounded-xl p-4">
                    <p class="text-red-600 dark:text-red-400 text-sm font-semibold">{{ error }}</p>
                </div>

                <!-- Success Message -->
                <div v-if="success" class="bg-green-500/10 border-2 border-green-500/30 rounded-xl p-4">
                    <p class="text-green-600 dark:text-green-400 text-sm font-semibold">{{ success }}</p>
                </div>

                <!-- Botones -->
                <div class="flex gap-4">
                    <button
                        type="submit"
                        :disabled="loading"
                        class="flex-1 bg-gradient-to-r from-forest to-leaf text-primary font-black py-4 px-6 rounded-xl hover:shadow-2xl hover:scale-105 transition-all duration-300 glow-primary-hover disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2"
                    >
                        <span v-if="!loading">Publicar Propiedad</span>
                        <span v-else>Publicando...</span>
                        <span v-if="!loading" class="material-symbols-outlined">upload</span>
                    </button>

                    <router-link
                        to="/"
                        class="px-6 py-4 border-2 border-leaf/30 text-leaf font-bold rounded-xl hover:border-leaf hover:bg-leaf/10 transition-all flex items-center justify-center"
                    >
                        Cancelar
                    </router-link>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { reactive, ref } from 'vue';
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();

const form = reactive({
    titulo: '',
    descripcion: '',
    tipo_propiedad: '',
    tipo_operacion: '',
    precio_venta: null,
    precio_alquiler: null,
    direccion: '',
    ciudad: '',
    provincia: '',
    codigo_postal: '',
    metros_cuadrados: null,
    habitaciones: null,
    banos: null,
    garaje: false,
    jardin: false,
    piscina: false,
    ascensor: false,
    amueblado: false,
    // Campos de sostenibilidad
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
});

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

const loading = ref(false);
const error = ref('');
const success = ref('');

const handleSubmit = async () => {
    try {
        loading.value = true;
        error.value = '';
        success.value = '';

        const response = await axios.post('/propiedades', form);

        success.value = 'Propiedad publicada exitosamente';
        
        // Redirigir después de 2 segundos
        setTimeout(() => {
            router.push('/');
        }, 2000);
    } catch (err) {
        if (err.response?.data?.errors) {
            const errors = Object.values(err.response.data.errors).flat();
            error.value = errors.join(', ');
        } else {
            error.value = err.response?.data?.message || 'Error al publicar la propiedad';
        }
    } finally {
        loading.value = false;
    }
};
</script>
