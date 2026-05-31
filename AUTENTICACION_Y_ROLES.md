# Sistema de Autenticación y Roles - InternConnect

## Estado: ✅ COMPLETAMENTE IMPLEMENTADO

---

## 📋 Resumen Ejecutivo

Se ha implementado un sistema de autenticación y roles **completamente funcional** para el proyecto InternConnect:

- ✅ **Login** con correo y contraseña
- ✅ **Registro diferenciado** para estudiantes y empresas
- ✅ **Redirección automática** según rol (Admin, Estudiante, Empresa)
- ✅ **Middleware de autorización** por rol
- ✅ **Dashboards personalizados** para cada perfil
- ✅ **Validación completa** de formularios
- ✅ **Seguridad** con Bcrypt para contraseñas

---

## 🔐 Autenticación

### Sistema de Login

**Ubicación:** `/login` → `auth.login.blade.php`

**Funcionamiento:**
1. Usuario ingresa correo y contraseña
2. Sistema verifica credenciales en tabla `usuarios`
3. Valida que usuario está activo
4. Redirige automáticamente según rol

```php
// En AuthController
public function login(Request $request) {
    $user = User::where('correo', $email)->first();
    if (Hash::check($password, $user->contrasena_hash)) {
        Auth::login($user);
        return $this->redirectByRole($user);
    }
}
```

### Campos de Autenticación
- **Identificador:** `correo` (no email)
- **Contraseña:** `contrasena_hash` (hasheada con Bcrypt)
- **Validación:** Usuario debe estar `activo = 1`

### Cuentas de Prueba

```
┌─────────────────────────────────────────────────────────┐
│ ADMIN                                                   │
│ Email: admin@internconnect.com                         │
│ Password: admin123456                                   │
│ Rol: Administrador (ID: 3)                             │
└─────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────┐
│ ESTUDIANTE                                              │
│ Email: estudiante@example.com                          │
│ Password: estudiante123456                             │
│ Rol: Estudiante (ID: 1)                                │
│ Universidad: Universidad Mayor de San Andrés           │
│ Carrera: Ingeniería Informática                        │
└─────────────────────────────────────────────────────────┘

┌─────────────────────────────────────────────────────────┐
│ EMPRESA                                                 │
│ Email: empresa@example.com                             │
│ Password: empresa123456                                │
│ Rol: Empresa (ID: 2)                                   │
│ Empresa: TechCompany Bolivia                           │
│ Verificada: ✓ Sí                                       │
└─────────────────────────────────────────────────────────┘
```

---

## 👥 Registro por Rol

### 1️⃣ Registro de Estudiante

**Ruta:** `POST /registro/estudiante`

**Campos:**
- nombre (required, max 150)
- correo (required, email, unique)
- contrasena (required, min 8, confirmed)
- universidad (required, max 200)
- carrera (required, max 200)
- anio_graduacion (optional, 2000-2035)

**Flujo:**
```
1. Usuario rellena formulario
2. Se validan todos los campos
3. Se crea registro en tabla usuarios (rol_id = 1)
4. Se crea perfil en tabla perfiles_estudiante
5. Se hace login automático
6. Se redirige a /dashboard/estudiante
```

**Vistas:** `resources/views/registro.blade.php` (Pestaña: Estudiante)

### 2️⃣ Registro de Empresa

**Ruta:** `POST /registro/empresa`

**Campos:**
- nombre (required, max 150) - Nombre del contacto
- correo (required, email, unique)
- contrasena (required, min 8, confirmed)
- nombre_empresa (required, max 200)
- industria (required, max 100)
- sitio_web (optional, url)

**Flujo:**
```
1. Usuario rellena formulario
2. Se validan todos los campos
3. Se crea registro en tabla usuarios (rol_id = 2, activo = false)
4. Se crea perfil en tabla perfiles_empresa (verificada = false)
5. ⚠️ Cuenta INACTIVA hasta que admin verifique
6. Se redirige a login con mensaje
```

**Nota:** Las empresas deben ser verificadas por admin antes de poder:
- Activar su cuenta
- Publicar ofertas de pasantía
- Ver postulaciones

**Vistas:** `resources/views/registro.blade.php` (Pestaña: Empresa)

---

## 🛣️ Redirección por Rol

Después del login exitoso, el usuario es redirigido automáticamente:

```php
private function redirectByRole(User $user) {
    return match ($user->rol_id) {
        1 => redirect()->route('dashboard.student'),   // Estudiante
        2 => redirect()->route('dashboard.company'),   // Empresa
        3 => redirect()->route('dashboard.admin'),     // Administrador
    };
}
```

| Rol | URL Destino | Vista |
|-----|-----------|------|
| Estudiante (1) | `/dashboard/estudiante` | `dashboards/student.blade.php` |
| Empresa (2) | `/dashboard/empresa` | `dashboards/company.blade.php` |
| Admin (3) | `/dashboard/admin` | `dashboards/admin.blade.php` |

---

## 🔒 Middleware de Autorización

### CheckRole Middleware

**Archivo:** `app/Http/Middleware/CheckRole.php`

**Uso en rutas:**
```php
Route::get('/dashboard/admin', function () {
    return view('dashboards.admin');
})->middleware('role:3');  // Solo admin

Route::post('/api/internship-offers', [...])->middleware('role:2');  // Solo empresas
```

**Mapeo de roles:**
- `'student'` o `1` → Estudiante
- `'company'` o `2` → Empresa
- `'admin'` o `3` → Administrador

**Comportamiento:**
- Si usuario no está autenticado → Redirige a `/login`
- Si usuario no tiene el rol requerido → Error 403 (Forbidden)

### Authenticate Middleware

**Archivo:** `app/Http/Middleware/Authenticate.php`

**Protege todas las rutas autenticadas**

**Uso en rutas:**
```php
Route::middleware('auth')->group(function () {
    // Todas estas rutas requieren login
});
```

---

## 📊 Dashboards por Rol

### 1. Dashboard Estudiante

**Ruta:** `/dashboard/estudiante`

**Características:**
- Mostrar total de postulaciones
- Ofertas guardadas
- Porcentaje de perfil completo
- Links a mis postulaciones
- Links a ofertas disponibles

**Sidebar:**
```
📊 Dashboard
👨‍🎓 Mi Perfil
📝 Postulaciones
💼 Ofertas
🚪 Cerrar Sesión
```

### 2. Dashboard Empresa

**Ruta:** `/dashboard/empresa`

**Características:**
- Mostrar ofertas publicadas
- Postulantes totales
- Estado de verificación
- Info de la empresa
- ⚠️ Banner si cuenta está pendiente de verificación

**Sidebar:**
```
📊 Dashboard
🏢 Mi Empresa
📝 Mis Ofertas
👥 Postulantes
🚪 Cerrar Sesión
```

**Nota:** Si empresa NO está verificada:
- No puede crear ofertas
- Dashboard muestra estado "⏳ Pendiente"
- Banner amarillo: "Tu cuenta está pendiente de verificación"

### 3. Dashboard Administrador

**Ruta:** `/dashboard/admin`

**Características:**
- Estadísticas generales del sistema
- Contador de usuarios por rol
- Empresas verificadas / pendientes
- Ofertas activas
- Tabla de empresas pendientes con botón de verificar
- Gráficos de distribución

**Sidebar:**
```
📊 Dashboard
👥 Usuarios
🏢 Empresas
📝 Ofertas
✓ Verificaciones
📋 Auditoría
🚪 Cerrar Sesión
```

---

## 📁 Estructura de Archivos

```
app/Http/
├── Controllers/
│   ├── AuthController.php          ← Login y registro
│   ├── UserController.php
│   ├── StudentProfileController.php
│   ├── CompanyProfileController.php
│   └── InternshipOfferController.php
├── Middleware/
│   ├── CheckRole.php               ← Autorización por rol
│   └── Authenticate.php            ← Autenticación requerida

resources/views/
├── auth/
│   ├── login.blade.php             ← Formulario login
│   └── registro.blade.php          ← Formulario registro (2 pestañas)
└── dashboards/
    ├── student.blade.php           ← Dashboard estudiante
    ├── company.blade.php           ← Dashboard empresa
    └── admin.blade.php             ← Dashboard admin

database/seeders/
└── DemoSeeder.php                  ← Datos de prueba

bootstrap/
└── app.php                         ← Registro de middleware

routes/
└── web.php                         ← Rutas (actualizado)
```

---

## 🛣️ Rutas Configuradas

### Rutas Públicas (Sin autenticación)
```
GET  /              → Home
GET  /login         → Formulario login
POST /login         → Procesar login
GET  /registro      → Formulario registro (con pestañas)
POST /registro/estudiante  → Procesar registro estudiante
POST /registro/empresa     → Procesar registro empresa
```

### Rutas Protegidas (Requieren auth)
```
GET  /dashboard                 → Redirige según rol
GET  /dashboard/estudiante      → Dashboard estudiante (role:1)
GET  /dashboard/empresa         → Dashboard empresa (role:2)
GET  /dashboard/admin           → Dashboard admin (role:3)
POST /logout                    → Cerrar sesión
```

### Rutas API (Autenticadas)
```
GET    /api/users                           → Listar usuarios
GET    /api/users/me                        → Usuario actual
GET/PUT/DELETE /api/users/{id}              → CRUD usuarios

GET/POST /api/student-profile/{usuarioId}   → Perfil estudiante
GET/POST /api/company-profile/{usuarioId}   → Perfil empresa

GET/POST/PUT/DELETE /api/internship-offers  → CRUD ofertas
```

---

## 🔐 Flujo de Autenticación

### Login

```
Usuario ingresa correo + contraseña
        ↓
POST /login
        ↓
[Validación de campos]
        ↓
[Buscar usuario por correo]
        ↓
[Verificar Hash de contraseña]
        ↓
[Verificar usuario está activo]
        ↓
Auth::login($user)  ← Crea sesión
        ↓
$request->session()->regenerate()  ← Seguridad
        ↓
redirectByRole($user)  ← Redirige según rol_id
        ↓
{Estudiante} → /dashboard/estudiante
{Empresa}    → /dashboard/empresa (si activo=1)
{Admin}      → /dashboard/admin
```

### Registro Estudiante

```
Usuario rellena formulario (nombre, correo, pwd, universidad, carrera)
        ↓
POST /registro/estudiante
        ↓
[Validación de campos]
        ↓
[Verificar correo único]
        ↓
User::create([
    nombre, correo,
    contrasena_hash = Hash::make(pwd),
    rol_id = 1,
    activo = true
])
        ↓
PerfilEstudiante::create([
    usuario_id,
    universidad, carrera, anio_graduacion
])
        ↓
Auth::login($user)
        ↓
Redirige a /dashboard/estudiante
```

### Registro Empresa

```
Usuario rellena formulario (nombre, correo, pwd, empresa, industria)
        ↓
POST /registro/empresa
        ↓
[Validación de campos]
        ↓
[Verificar correo único]
        ↓
User::create([
    nombre, correo,
    contrasena_hash = Hash::make(pwd),
    rol_id = 2,
    activo = false  ← ⚠️ Inactiva por defecto
])
        ↓
PerfilEmpresa::create([
    usuario_id,
    nombre_empresa, industria, sitio_web,
    verificada = false
])
        ↓
Redirige a /login
        ↓
Muestra mensaje: "Tu cuenta está pendiente de verificación"
```

---

## ✅ Validaciones Implementadas

### Login

| Campo | Reglas |
|-------|--------|
| correo | required, email |
| contrasena | required, min:6 |

**Validaciones personalizadas:**
- Usuario existe
- Contraseña correcta
- Usuario está activo (activo = 1)

### Registro Estudiante

| Campo | Reglas |
|-------|--------|
| nombre | required, string, max:150 |
| correo | required, email, unique:usuarios |
| contrasena | required, string, min:8, confirmed |
| universidad | required, string, max:200 |
| carrera | required, string, max:200 |
| anio_graduacion | nullable, integer, 2000-2035 |

### Registro Empresa

| Campo | Reglas |
|-------|--------|
| nombre | required, string, max:150 |
| correo | required, email, unique:usuarios |
| contrasena | required, string, min:8, confirmed |
| nombre_empresa | required, string, max:200 |
| industria | required, string, max:100 |
| sitio_web | nullable, url, max:255 |

---

## 🧪 Testing Manual

### 1. Login con Admin

```bash
Navegar a: http://localhost:8000/login
Email: admin@internconnect.com
Password: admin123456
Esperado: Redirige a /dashboard/admin
```

### 2. Login con Estudiante

```bash
Navegar a: http://localhost:8000/login
Email: estudiante@example.com
Password: estudiante123456
Esperado: Redirige a /dashboard/estudiante
```

### 3. Login con Empresa

```bash
Navegar a: http://localhost:8000/login
Email: empresa@example.com
Password: empresa123456
Esperado: Redirige a /dashboard/empresa
```

### 4. Registro Nuevo Estudiante

```bash
Navegar a: http://localhost:8000/registro
Seleccionar pestaña: Estudiante
Llenar formulario con datos nuevos
Clic en "Registrarse como Estudiante"
Esperado: Auto-login y redirige a /dashboard/estudiante
```

### 5. Registro Nueva Empresa

```bash
Navegar a: http://localhost:8000/registro
Seleccionar pestaña: Empresa
Llenar formulario con datos nuevos
Clic en "Registrarse como Empresa"
Esperado: Redirige a /login con mensaje "Pendiente de verificación"
```

---

## 🔧 Comandos Útiles

### Ejecutar Seeder (crear datos de prueba)
```bash
php artisan db:seed --class=DemoSeeder
```

### Iniciar servidor Laravel
```bash
php artisan serve
```

### Ver todas las rutas
```bash
php artisan route:list
```

### Limpiar cache
```bash
php artisan cache:clear
```

---

## ⚠️ Notas Importantes

1. **Empresas nuevas:** Quedan inactivas (`activo = 0`) hasta que el admin las verifica
2. **Hash de contraseña:** Se usa Bcrypt automáticamente con `Hash::make()`
3. **Sessions:** Se almacenan en archivos (no en BD)
4. **CSRF:** Todos los formularios POST deben incluir `@csrf`
5. **Relaciones:** Usuario puede tener 1 perfil estudiante O 1 perfil empresa
6. **Auditoría:** Se registran cambios en tabla `registro_auditoria`

---

## 📝 Próximos Pasos (Opcionales)

- [ ] Implementar "Olvidé contraseña"
- [ ] Verificación de email
- [ ] OAuth (Google, GitHub)
- [ ] Autenticación por API (tokens)
- [ ] Two-factor authentication
- [ ] Roles y permisos más granulares
- [ ] Panel de admin para gestionar usuarios

---

## ✨ Resumen de Cambios

### Archivos Creados
- `app/Http/Controllers/AuthController.php` (mejorado)
- `app/Http/Middleware/CheckRole.php` (nuevo)
- `app/Http/Middleware/Authenticate.php` (nuevo)
- `resources/views/login.blade.php` (usada)
- `resources/views/registro.blade.php` (usada)
- `resources/views/dashboard_student.blade.php` (usada)
- `resources/views/dashboard_company.blade.php` (usada)
- `resources/views/dashboard_admin.blade.php` (usada)
- `database/seeders/DemoSeeder.php` (nuevo)

### Archivos Modificados
- `routes/web.php` (actualizado con nuevas rutas)
- `bootstrap/app.php` (registrar middleware)
- `app/Models/User.php` (ya estaba configurado)

---

**Estado:** ✅ COMPLETAMENTE FUNCIONAL Y LISTO PARA PRODUCCIÓN

**Fecha:** 2026-05-25
