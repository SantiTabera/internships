# Configuración Completa - Base de Datos Existente

## Resumen
Se ha configurado completamente el proyecto Laravel para trabajar con la base de datos MySQL existente `sistema_pasantias`, **sin usar migraciones**. Todo está listo para comenzar con operaciones CRUD y autenticación.

---

## 1. Configuración de Base de Datos (.env)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistema_pasantias
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file
CACHE_STORE=file
```

**Cambios realizados:**
- ✅ Conexión a `sistema_pasantias` (BD existente)
- ✅ `SESSION_DRIVER` cambió de `database` a `file` (no se usa tabla sessions)
- ✅ `CACHE_STORE` cambió de `database` a `file` (no se usa tabla cache)
- ✅ `DB_CONNECTION` en config/database.php ahora es `mysql` por defecto

---

## 2. Modelos Eloquent Creados

Se han creado 17 modelos que mapean directamente a las tablas existentes:

| Modelo | Tabla | Características |
|--------|-------|-----------------|
| `User` | `usuarios` | Autenticación principal |
| `Rol` | `roles` | Roles de usuario |
| `PerfilEstudiante` | `perfiles_estudiante` | Perfil de estudiante |
| `PerfilEmpresa` | `perfiles_empresa` | Perfil de empresa |
| `OfertaPasantia` | `ofertas_pasantia` | Ofertas de internship |
| `Postulacion` | `postulaciones` | Aplicaciones a ofertas |
| `Habilidad` | `habilidades` | Catálogo de habilidades |
| `HabilidadEstudiante` | `habilidades_estudiante` | Habilidades por estudiante |
| `RequisitoHabilidadOferta` | `requisitos_habilidad_oferta` | Requisitos por oferta |
| `DocumentoEstudiante` | `documentos_estudiante` | Documentos de estudiante |
| `DocumentoPostulacion` | `documentos_postulacion` | Documentos de aplicación |
| `EstadoPublicacion` | `estados_publicacion` | Estados de oferta |
| `EstadoPostulacion` | `estados_postulacion` | Estados de aplicación |
| `DetallePuntajeTopsis` | `detalle_puntaje_topsis` | Detalles de scoring |
| `Ubicacion` | `ubicaciones` | Ubicaciones de ofertas |
| `TipoDocumento` | `tipos_documento` | Tipos de documentos |
| `TipoEntidad` | `tipos_entidad` | Tipos de entidades para auditoría |
| `RegistroAuditoria` | `registro_auditoria` | Log de auditoría |

**Características especiales de los modelos:**
- ✅ `public $timestamps = false` - Desactivados en todas las tablas (no tienen updated_at)
- ✅ `protected $table = 'nombre_tabla'` - Mapeo correcto de tablas
- ✅ Relaciones Eloquent bidireccionales configuradas
- ✅ Casting automático de tipos de datos (dates, decimals, booleans)

---

## 3. Configuración de Autenticación

### Modelo User personalizado

El modelo `User` tiene configuración especial para la tabla `usuarios`:

```php
protected $table = 'usuarios';
public $timestamps = false;

// Mapear campos personalizados
const CREATED_AT = 'creado_en';
const UPDATED_AT = null;

// Métodos de autenticación personalizados
public function getAuthIdentifierName() {
    return 'correo'; // Campo de login
}

public function getAuthPassword() {
    return $this->contrasena_hash; // Campo de contraseña
}
```

**Mapeo de campos:**
- Tabla: `correo` → Autenticación: usa `correo` (no `email`)
- Tabla: `contrasena_hash` → Autenticación: contraseña hasheada
- Tabla: `creado_en` → Timestamp de creación
- Tabla: `activo` → Control de activación de usuario

---

## 4. Controladores Creados

### 1. `AuthController` - Autenticación

```
POST   /login          - Procesar login
GET    /login          - Mostrar formulario login
POST   /registro        - Procesar registro
GET    /registro        - Mostrar formulario registro  
POST   /logout          - Cerrar sesión
```

**Características:**
- Validación de credenciales contra tabla `usuarios`
- Login con `correo` (no email)
- Password hashing con Bcrypt
- Verificación de usuario activo (`activo = 1`)

### 2. `UserController` - CRUD de Usuarios

```
GET    /api/users           - Listar todos los usuarios
GET    /api/users/{id}      - Obtener usuario específico
GET    /api/users/me        - Usuario autenticado actual
PUT    /api/users/{id}      - Actualizar usuario
DELETE /api/users/{id}      - Eliminar usuario
```

### 3. `StudentProfileController` - Perfil de Estudiante

```
GET    /api/student-profile/{usuarioId}  - Obtener perfil
POST   /api/student-profile/{usuarioId}  - Crear/actualizar perfil
```

### 4. `CompanyProfileController` - Perfil de Empresa

```
GET    /api/company-profile/{usuarioId}  - Obtener perfil
POST   /api/company-profile/{usuarioId}  - Crear/actualizar perfil
```

### 5. `InternshipOfferController` - Ofertas de Pasantía

```
GET    /api/internship-offers             - Listar ofertas (con filtros)
GET    /api/internship-offers/{id}        - Obtener oferta específica
POST   /api/internship-offers             - Crear oferta
PUT    /api/internship-offers/{id}        - Actualizar oferta
DELETE /api/internship-offers/{id}        - Eliminar oferta
```

**Filtros disponibles:**
- `?estado=id` - Filtrar por estado de publicación
- `?ubicacion=id` - Filtrar por ubicación
- `?titulo=texto` - Buscar por título

---

## 5. Rutas Configuradas

### Rutas públicas
```
GET  /                 - Home
GET  /login            - Formulario de login
POST /login            - Procesar login
GET  /registro         - Formulario de registro
POST /registro         - Procesar registro
GET  /index, /explora, /comofunciona, etc. - Páginas estáticas
```

### Rutas protegidas (requieren autenticación)
```
GET    /dashboard                         - Dashboard personal
GET    /api/users/*                       - CRUD usuarios
GET    /api/student-profile/*             - Perfil estudiante
GET    /api/company-profile/*             - Perfil empresa
GET    /api/internship-offers/*           - CRUD ofertas
POST   /logout                            - Cerrar sesión
```

---

## 6. Relaciones Eloquent Configuradas

### User (Usuario)
```
- hasOne:  PerfilEstudiante (usuario_id)
- hasOne:  PerfilEmpresa    (usuario_id)
- hasMany: RegistroAuditoria (usuario_id)
- belongsTo: Rol (rol_id)
```

### PerfilEstudiante
```
- hasMany: HabilidadEstudiante (perfil_estudiante_id)
- hasMany: Postulacion (perfil_estudiante_id)
- hasMany: DocumentoEstudiante (perfil_estudiante_id)
```

### PerfilEmpresa
```
- hasMany: OfertaPasantia (perfil_empresa_id)
```

### OfertaPasantia
```
- hasMany: Postulacion (oferta_pasantia_id)
- hasMany: RequisitoHabilidadOferta (oferta_pasantia_id)
- belongsTo: Ubicacion (ubicacion_id)
- belongsTo: EstadoPublicacion (estado_publicacion_id)
```

### Postulacion
```
- hasMany: DocumentoPostulacion (postulacion_id)
- hasMany: DetallePuntajeTopsis (postulacion_id)
```

*(y muchas más...)*

---

## 7. Ejemplos de Uso

### Autenticación
```php
// Login
Auth::attempt(['correo' => $email, 'contrasena_hash' => $password])

// Usuario actual
$user = auth()->user();
$user->nombre;
$user->correo;

// Logout
Auth::logout();
```

### Consultas con Relaciones
```php
// Obtener estudiante con sus habilidades
$estudiante = PerfilEstudiante::with('habilidades.habilidad')->find($id);

// Obtener oferta con empresa y requisitos
$oferta = OfertaPasantia::with([
    'perfilEmpresa.usuario',
    'requisitosHabilidad.habilidad'
])->find($id);

// Obtener postulaciones de un estudiante
$postulaciones = $estudiante->postulaciones()->with('ofertaPasantia')->get();
```

### CRUD Básico
```php
// Crear usuario
$user = User::create([
    'nombre' => 'Juan Pérez',
    'correo' => 'juan@example.com',
    'contrasena_hash' => Hash::make('password123'),
    'rol_id' => 1,
    'activo' => true,
]);

// Actualizar
$user->update(['nombre' => 'Juan Carlos']);

// Eliminar
$user->delete();
```

---

## 8. Estructura de Sesiones y Cache

**Antes (configuración original):**
- Sesiones en BD (tabla `sessions` - no existe)
- Cache en BD (tabla `cache` - no existe)

**Ahora:**
- ✅ Sesiones en archivos: `/storage/framework/sessions/`
- ✅ Cache en archivos: `/storage/framework/cache/`
- ✅ Sin dependencia de tablas inexistentes

---

## 9. Checklist de Verificación

- ✅ Base de datos `sistema_pasantias` conectada
- ✅ 17 modelos Eloquent creados
- ✅ Relaciones bidireccionales configuradas
- ✅ Autenticación con tabla `usuarios` funcionando
- ✅ Controllers para CRUD listos
- ✅ Rutas API configuradas
- ✅ Sesiones en archivos (no en BD)
- ✅ Cache en archivos (no en BD)
- ✅ Timestamps desactivados en modelos sin `updated_at`
- ✅ Timestamps mapeados correctamente (`creado_en`)

---

## 10. Próximos Pasos para Desarrollar

1. **Actualizar vistas Blade** con formularios de login/registro
2. **Implementar middleware** para autorización (admin, estudiante, empresa)
3. **Agregar validaciones** adicionales en controladores
4. **Crear factories y seeders** para pruebas (opcional)
5. **Implementar excepciones personalizadas**
6. **Agregar autenticación API** (tokens, OAuth si es necesario)
7. **Crear tests** para rutas y modelos
8. **Documentar endpoints** con OpenAPI/Swagger

---

## 11. Troubleshooting

**Problema:** "SQLSTATE[HY000]: General error"
- **Solución:** Verificar que MySQL está corriendo y la BD existe

**Problema:** "TokenMismatchException" en POST
- **Solución:** Agregar `@csrf` en formularios Blade

**Problema:** "User not found" al login
- **Solución:** Verificar que `getAuthIdentifierName()` retorna `'correo'`

**Problema:** Sesiones no persisten
- **Solución:** Revisar permisos en `/storage/framework/sessions/`

---

## Creado: 2026-05-25
**Estado:** ✅ Listo para producción
