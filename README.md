# 🚀 SerraInnova

<div align="center">

### Plataforma Web Innovadora | Proyecto Académico

[![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Vue.js](https://img.shields.io/badge/Vue.js-4FC08D?style=for-the-badge&logo=vue.js&logoColor=white)](https://vuejs.org)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Figma](https://img.shields.io/badge/Figma-F24E1E?style=for-the-badge&logo=figma&logoColor=white)](https://figma.com)

[🌐 Demo en Vivo](#) • [📖 Documentación](#) • [🐛 Reportar Bug](#) • [✨ Solicitar Feature](#)

</div>

---

## 📋 Tabla de Contenidos

- [Sobre el Proyecto](#-sobre-el-proyecto)
- [Tecnologías Utilizadas](#-tecnologías-utilizadas)
- [Características Principales](#-características-principales)
- [Prerequisitos](#-prerequisitos)
- [Instalación](#-instalación)
- [Configuración](#️-configuración)
- [Uso](#-uso)
- [Estructura del Proyecto](#-estructura-del-proyecto)
- [Equipo](#-equipo)
- [Licencia](#-licencia)

---

## 🎯 Sobre el Proyecto

**SerraInnova** es una aplicación web moderna desarrollada como proyecto académico, combinando las mejores prácticas de desarrollo frontend y backend. La plataforma está diseñada para [*describe brevemente el propósito de tu proyecto*].

### ✨ ¿Por qué SerraInnova?

- 🎨 **Diseño Moderno**: Interfaz intuitiva diseñada en Figma
- ⚡ **Alto Rendimiento**: Arquitectura optimizada con Laravel y Vue.js
- 📱 **Responsive**: Adaptable a cualquier dispositivo
- 🔒 **Seguro**: Implementación de mejores prácticas de seguridad

---

## 🛠 Tecnologías Utilizadas

### Backend
- **[Laravel](https://laravel.com)** - Framework PHP para desarrollo web
  - Eloquent ORM
  - Sistema de autenticación
  - API RESTful

### Frontend
- **[Vue.js 3](https://vuejs.org)** - Framework JavaScript progresivo
  - Composition API
  - Vue Router
  - Pinia (State Management)

### Estilos
- **[Tailwind CSS](https://tailwindcss.com)** - Framework CSS utility-first
  - Diseño responsive
  - Customización completa
  - Dark mode support

### Diseño
- **[Figma](https://figma.com)** - Herramienta de diseño colaborativo
  - Prototipos interactivos
  - Sistema de diseño
  - Componentes reutilizables

---

## ⭐ Características Principales

- ✅ **Autenticación de usuarios** - Sistema completo de registro y login
- ✅ **Dashboard interactivo** - Panel de control con datos en tiempo real
- ✅ **Gestión de contenido** - CRUD completo para recursos
- ✅ **Búsqueda avanzada** - Filtros y búsqueda optimizada
- ✅ **Notificaciones** - Sistema de alertas y mensajes
- ✅ **Responsive Design** - Compatible con móviles, tablets y desktop
- ✅ **Multi-idioma** - Soporte para español e inglés
- ✅ **Dark Mode** - Tema claro y oscuro

---

## 📦 Prerequisitos

Antes de comenzar, asegúrate de tener instalado:

```bash
- PHP >= 8.1
- Composer
- Node.js >= 16.x
- NPM o Yarn
- MySQL >= 8.0 o PostgreSQL
- Git
```

---

## 🚀 Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/tu-usuario/serrainnova.git
cd serrainnova
```

### 2. Instalar dependencias de PHP

```bash
composer install
```

### 3. Instalar dependencias de Node.js

```bash
npm install
# o si usas yarn
yarn install
```

### 4. Configurar variables de entorno

```bash
cp .env.example .env
```

Edita el archivo `.env` con tus configuraciones:

```env
APP_NAME=SerraInnova
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=serrainnova
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Generar clave de aplicación

```bash
php artisan key:generate
```

### 6. Ejecutar migraciones

```bash
php artisan migrate --seed
```

### 7. Compilar assets

```bash
npm run dev
# Para producción
npm run build
```

### 8. Iniciar servidor

```bash
php artisan serve
```

¡Visita [http://localhost:8000](http://localhost:8000) y disfruta de SerraInnova! 🎉

---

## ⚙️ Configuración

### Configuración de la Base de Datos

1. Crea una base de datos llamada `inmobiliaria`
2. Actualiza las credenciales en el archivo `.env`
3. Ejecuta las migraciones con `php artisan migrate`

---

## 💻 Uso

### Ejecutar en modo desarrollo

```bash
# Terminal 1 - Backend
composer run dev

# Terminal 2 - Frontend
npm run dev
```


### Compilar para producción

```bash
npm run build
php artisan optimize
```

---

## 📁 Estructura del Proyecto

```
serrainnova/
├── 📂 app/                  # Lógica de la aplicación Laravel
│   ├── Http/
│   ├── Models/
│   └── Services/
├── 📂 database/             # Migraciones y seeders
│   ├── migrations/
│   └── seeders/
├── 📂 public/               # Archivos públicos
├── 📂 resources/            # Recursos frontend
│   ├── css/
│   ├── js/
│   │   ├── components/     # Componentes Vue
│   │   ├── views/          # Vistas Vue
│   │   └── router/         # Configuración de rutas
│   └── views/              # Plantillas Blade
├── 📂 routes/               # Definición de rutas
│   ├── api.php
│   └── web.php
├── 📂 tests/                # Tests automatizados
├── .env.example             # Variables de entorno ejemplo
├── composer.json            # Dependencias PHP
├── package.json             # Dependencias Node
├── tailwind.config.js       # Configuración Tailwind
└── vite.config.js          # Configuración Vite
```

---


## 📝 Licencia

Este proyecto es un trabajo académico desarrollado para Desarrollo de Aplicaciones Web.

---


<div align="center">

### ⭐ Si te gusta este proyecto, dale una estrella en GitHub!

**Desarrollado con ❤️ por el equipo SerraInnova**

![Made with Love](https://img.shields.io/badge/Made%20with-❤️-red?style=for-the-badge)
![Laravel](https://img.shields.io/badge/Powered%20by-Laravel-red?style=for-the-badge&logo=laravel)
![Vue.js](https://img.shields.io/badge/Built%20with-Vue.js-green?style=for-the-badge&logo=vue.js)

</div>
