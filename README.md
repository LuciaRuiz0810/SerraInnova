# 🌿 SerraInnova Real Estate

![Laravel](https://img.shields.io/badge/Laravel-10.x-FF2D20?style=for-the-badge&logo=laravel)
![Vue.js](https://img.shields.io/badge/Vue.js-3.x-4FC08D?style=for-the-badge&logo=vue.js)
![Tailwind CSS](https://img.shields.io/badge/Tailwind-3.0-38B2AC?style=for-the-badge&logo=tailwind-css)
![Vite](https://img.shields.io/badge/Vite-Build-646CFF?style=for-the-badge&logo=vite)

> **Plataforma inmobiliaria moderna y sostenible.**
> Diseñada para redefinir el sector con un enfoque en eficiencia energética y construcción consciente.

---

## 🚀 Características Principales

*   **🌱 Enfoque Sostenible:** Filtros avanzados por certificación energética, materiales sostenibles y huella de carbono.
*   **📊 Calculadora Eco:** Herramienta interactiva para estimar el ahorro energético en reformas.
*   **👥 Gestión Integral:** Roles diferenciados para **Compradores**, **Agentes** y **Administradores**.
*   **🎨 UI Premium:** Diseño orgánico "Glassmorphism" con paleta de colores inspirada en la naturaleza.
*   **🔐 Seguridad:** Autenticación robusta via Laravel Sanctum.
*   **📱 Responsive:** Experiencia fluida en móvil y escritorio.

---

## 🛠️ Requisitos del Sistema

Para ejecutar este proyecto necesitarás:

*   [PHP](https://www.php.net/) >= 8.1
*   [Composer](https://getcomposer.org/)
*   [Node.js](https://nodejs.org/) & NPM
*   [MySQL](https://www.mysql.com/)

---

## 📦 Instalación y Puesta en Marcha

Sigue estos pasos para desplegar el proyecto en tu entorno local:

### 1. Clonar el repositorio
```bash
git clone <url-del-repositorio>
cd SerraInnova
```

### 2. Instalar dependencias
Backend (Laravel):
```bash
composer install
```
Frontend (Vue.js + Tailwind):
```bash
npm install
```

### 3. Configurar Entorno
Copia el archivo de ejemplo y genera la clave de aplicación:
```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configurar Base de Datos
Abre el archivo `.env` y configura tus credenciales de base de datos MySQL:

```ini
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inmobiliaria  # Asegúrate de crear esta BDD
DB_USERNAME=tu_usuario    # Por defecto: inmobiliaria (según tu .env actual)
DB_PASSWORD=tu_password   # Por defecto: inmobiliaria
```

### 5. Migraciones y Seeders (Datos de Prueba)
Ejecuta las migraciones para crear las tablas e insertar datos iniciales (usuarios, propiedades de ejemplo):
```bash
php artisan migrate:fresh --seed
```

### 6. Ejecutar Servidores
Necesitarás dos terminales abiertas:

**Terminal 1 (Backend Laravel):**
```bash
php artisan serve
```

**Terminal 2 (Frontend Vite):**
```bash
npm run dev
```

🚀 ¡Listo! Abre tu navegador en `http://localhost:8000`

---

## 🔑 Credenciales de Acceso

El sistema carga usuarios predefinidos para que puedas probar todos los roles.

### 👑 Administrador (Acceso Total + Panel Admin)
*   **Email:** `admin@serrainnova.com`
*   **Contraseña:** `admin123`

### 👔 Agente (Gestión de Propiedades)
*   **Email:** `agente1@inmobiliaria.com`
*   **Contraseña:** `password123`

### 👤 Cliente (Búsqueda y Favoritos)
*   **Email:** `cliente1@email.com`
*   **Contraseña:** `password123`

---

## 📂 Estructura del Proyecto

*   `app/Models`: Modelos Eloquent (`Propiedad`, `Usuario`, `Agente`, `Contrato`).
*   `app/Http/Controllers/Api`: Controladores API RESTful.
*   `resources/js/views`: Vistas Vue.js (SPA).
*   `resources/js/components`: Componentes reutilizables (Navbar, Footer, Forms).
*   `database/seeders`: Datos de prueba iniciales.

---

<p align="center">
  <sub>Desarrollado con ❤️ por el equipo SerraInnova</sub>
</p>
