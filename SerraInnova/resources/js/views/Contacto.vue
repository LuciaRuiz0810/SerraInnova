<template>
    <div class="min-h-screen bg-background-light dark:bg-background-dark py-12 px-6">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-4xl font-bold text-forest dark:text-white mb-2 text-center">Contacto</h1>
            <p class="text-center text-gray-600 dark:text-gray-400 mb-8">
                ¿Tienes alguna pregunta? Envíanos un mensaje
            </p>

            <!-- Formulario de contacto -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-8">
                <form @submit.prevent="handleSubmit" class="space-y-6">
                    <!-- Nombre -->
                    <div>
                        <label for="nombre" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Nombre
                        </label>
                        <input
                            v-model="formData.nombre"
                            type="text"
                            id="nombre"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                            placeholder="Tu nombre completo"
                        />
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Email
                        </label>
                        <input
                            v-model="formData.email"
                            type="email"
                            id="email"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                            placeholder="tu@email.com"
                        />
                    </div>

                    <!-- Asunto -->
                    <div>
                        <label for="asunto" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Asunto
                        </label>
                        <input
                            v-model="formData.asunto"
                            type="text"
                            id="asunto"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all"
                            placeholder="Asunto del mensaje"
                        />
                    </div>

                    <!-- Mensaje -->
                    <div>
                        <label for="mensaje" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">
                            Mensaje
                        </label>
                        <textarea
                            v-model="formData.mensaje"
                            id="mensaje"
                            rows="5"
                            class="w-full px-4 py-3 rounded-lg border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-primary focus:border-transparent transition-all resize-none"
                            placeholder="Escribe tu mensaje aquí..."
                        ></textarea>
                    </div>

                    <!-- Botón de envío -->
                    <button
                        type="submit"
                        class="w-full bg-primary hover:bg-primary/90 text-forest font-bold py-3 px-6 rounded-lg transition-all transform hover:scale-105 active:scale-95"
                    >
                        Enviar Mensaje
                    </button>
                </form>

                <!-- Mensaje de éxito -->
                <transition name="fade">
                    <div
                        v-if="showSuccessMessage"
                        class="mt-6 p-4 bg-green-100 dark:bg-green-900/30 border border-green-400 dark:border-green-600 rounded-lg"
                    >
                        <p class="text-green-700 dark:text-green-400 font-semibold text-center">
                            ✓ Mensaje enviado correctamente
                        </p>
                    </div>
                </transition>

                <!-- Mensaje de error -->
                <transition name="fade">
                    <div
                        v-if="showErrorMessage"
                        class="mt-6 p-4 bg-red-100 dark:bg-red-900/30 border border-red-400 dark:border-red-600 rounded-lg"
                    >
                        <p class="text-red-700 dark:text-red-400 font-semibold text-center">
                            ⚠ Se deben rellenar todos los campos
                        </p>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, reactive } from 'vue';

const formData = reactive({
    nombre: '',
    email: '',
    asunto: '',
    mensaje: ''
});

const showSuccessMessage = ref(false);
const showErrorMessage = ref(false);

const handleSubmit = () => {
    // Validar que todos los campos estén llenos
    if (!formData.nombre || !formData.email || !formData.asunto || !formData.mensaje) {
        showErrorMessage.value = true;
        showSuccessMessage.value = false;
        
        // Ocultar mensaje de error después de 3 segundos
        setTimeout(() => {
            showErrorMessage.value = false;
        }, 3000);
        
        return;
    }

    // Si todos los campos están llenos, mostrar mensaje de éxito
    showSuccessMessage.value = true;
    showErrorMessage.value = false;

    // Aquí puedes agregar la lógica para enviar el formulario al backend
    console.log('Formulario enviado:', formData);

    // Limpiar el formulario
    formData.nombre = '';
    formData.email = '';
    formData.asunto = '';
    formData.mensaje = '';

    // Ocultar mensaje de éxito después de 3 segundos
    setTimeout(() => {
        showSuccessMessage.value = false;
    }, 3000);
};
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.3s ease;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
