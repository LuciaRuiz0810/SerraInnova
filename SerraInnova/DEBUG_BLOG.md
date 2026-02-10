# Pasos para solucionar el problema de artículos no mostrados

## Problema
Los artículos del blog no se muestran en el frontend, aunque la API funciona correctamente.

## Verificación realizada
✅ API funcionando: `http://127.0.0.1:8000/api/articulos` devuelve 5 artículos
✅ Base de datos tiene 5 artículos publicados
✅ Código de Vue está correcto

## Soluciones

### Solución 1: Limpiar caché del navegador
1. Abre Chrome DevTools (F12)
2. Ve a la pestaña "Network"
3. Marca la casilla "Disable cache"
4. Recarga la página con Ctrl + Shift + R (hard refresh)

### Solución 2: Verificar la consola del navegador
1. Abre Chrome DevTools (F12)
2. Ve a la pestaña "Console"
3. Busca errores en rojo
4. Si ves errores de CORS, axios, o  404, copia el error

### Solución 3: Verificar en la pestaña Network
1. Abre Chrome DevTools (F12)
2. Ve a la pestaña "Network"
3. Recarga la página
4. Busca la petición a `/api/articulos`
5. Verifica que el Status sea 200
6. Haz clic en la petición y ve a "Preview" para ver los datos

### Solución 4: Probar directamente la API
Abre esta URL directamente en el navegador:
```
http://127.0.0.1:8000/api/articulos
```

Deberías ver un JSON con 5 artículos.

### Solución 5: Reiniciar el servidor Vite
Si ninguna de las anteriores funciona:
1. En la terminal donde está corriendo `npm run dev`, presiona Ctrl+C
2. Ejecuta nuevamente: `npm run dev`
3. Recarga la página del blog

## Información de depuración
- **Endpoint API**: http://127.0.0.1:8000/api/articulos
- **Página del Blog**: http://127.0.0.1:8000/blog
- **Total de artículos en DB**: 5
- **Estado de la API**: ✅ Funcionando (Status 200)
- **Tamaño de respuesta**: ~14KB

## Si aún no funciona
Comparte:
1. Captura de pantalla de la consola del navegador (DevTools > Console)
2. Captura de pantalla de la pestaña Network mostrando la petición a `/api/articulos`
3. Lo que ves en la página (¿mensaje de "No hay artículos"?, ¿loading infinito?, ¿página en blanco?)
