# QR Generator

Aplicación Laravel 12 con Livewire (Volt/Flux) para crear, listar, editar y descargar códigos QR. Las rutas de QR están protegidas por autenticación (Fortify) y el proyecto incluye vistas de ajustes (perfil, contraseña, apariencia, 2FA).

## Características
- CRUD completo de códigos QR con descarga de PNG.
- Generación de QR como data URI usando `endroid/qr-code` (PNG 900px, margen 10, corrección de errores baja).
- Listado paginado, detalle con vista previa y edición que regenera el código.
- Autenticación y recuperación con Fortify; secciones de perfil, contraseña, apariencia y 2FA.
- UI con Tailwind CSS 4 y componentes Flux; build y HMR con Vite.

## Stack
- Backend: PHP 8.2, Laravel 12, Fortify, Livewire Volt/Flux.
- Frontend: Vite, Tailwind CSS 4, Axios.
- QR: `endroid/qr-code` + `bacon/bacon-qr-code`.
- DB: SQLite por defecto (configurable a MySQL/PostgreSQL).

## Requisitos
- PHP 8.2+
- Composer
- Node.js 18+ y npm
- Motor de base de datos (SQLite incluido, opcional MySQL/PostgreSQL)

## Configuración rápida
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate --force
npm install
npm run build    # o npm run dev para desarrollo
php artisan serve
```
Accede a `http://localhost:8000`. Todas las rutas bajo `/qrcode` requieren usuario autenticado.

## Configuración detallada
- Entorno: revisa `.env` y ajusta `APP_URL`, `APP_ENV`, `APP_DEBUG` y la sección DB.  
- Base de datos: para SQLite se crea `database/database.sqlite`; con otros motores, crea la base y credenciales antes de migrar.  
- Cacheo opcional para producción:
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

## Ejecución
- Desarrollo simple: `php artisan serve` y en otra consola `npm run dev`.
- Desarrollo integrado (cola, logs, Vite, servidor): `composer dev`.
- Producción: `npm run build` y servir con PHP-FPM/Apache/Nginx apuntando a `public/`.

## Rutas de QR
- `GET /qrcode` listado paginado.  
- `GET /qrcode/create` formulario.  
- `POST /qrcode` creación + generación del PNG embebido.  
- `GET /qrcode/{qrcode}` detalle y visualización.  
- `GET /qrcode/{qrcode}/download` descarga PNG.  
- `GET /qrcode/{qrcode}/edit` + `PATCH /qrcode/{qrcode}` edición y regeneración.  

## Flujo de generación de QR
1) Validación (`StoreQrcodeRequest`/`UpdateQrcodeRequest`): nombre requerido, URL válida, descripción opcional.  
2) Servicio (`app/Services/QrCodeService.php`): crea PNG (900px, margen 10, EC baja) y devuelve data URI.  
3) Persistencia (`qrcodes.qr_code`): se almacena el data URI.  
4) Descarga (`/qrcode/{qrcode}/download`): decodifica el base64 y envía un PNG con `Content-Disposition` de adjunto.  

## Estructura clave
- `app/Services/QrCodeService.php`: generación del PNG/data URI.  
- `app/Http/Controllers/QrcodeController.php`: CRUD y descarga.  
- `database/migrations/*qrcodes_table.php`: esquema `qrcodes` (`name`, `url`, `qr_code`, `description`).  
- `resources/views/qrcode/*.blade.php`: vistas de listado, creación, edición, detalle.  
- `resources/views/components/layouts/app/sidebar.blade.php`: enlace de navegación a QR.  

## Scripts útiles
- `composer setup`: instala dependencias, copia `.env`, genera key, migra, instala npm y build.
- `composer dev`: desactiva timeout y ejecuta servidor, cola, logs y Vite en paralelo.
- `composer test`: limpia config y ejecuta pruebas (`php artisan test`).
- `npm run dev`: Vite con HMR.
- `npm run build`: build de producción.

## Pruebas
```bash
php artisan test
```
El proyecto usa Pest + plugin Laravel. Añade factories/seeds según los casos de prueba que sumes.

## Troubleshooting rápido
- Revisa versión de PHP/Node si fallan dependencias.  
- En SQLite, confirma que `database/database.sqlite` existe y tiene permisos de escritura.  
- Si Vite no compila, limpia `node_modules` y reinstala: `rm -rf node_modules && npm install`.  
- Si cambias credenciales DB, ejecuta `php artisan config:clear`.  
- Para problemas de puerto en Vite, ajusta `vite.config.js` o `APP_URL`.  

## Seguridad
- Todas las rutas de QR requieren autenticación.  
- 2FA gestionada por Fortify; habilita en ajustes de usuario.  
- Mantén `APP_KEY` seguro y configura HTTPS en producción.  

Hecho con amor por Halltec.
