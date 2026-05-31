# 🚀 Guía Rápida de Inicio - InternConnect

## ⚡ 5 Pasos para Empezar

### 1. Iniciar Servidor Laravel
```bash
cd /Users/elianatabera/internships
php artisan serve
```
El servidor estará disponible en: **http://localhost:8000**

### 2. Opción A: Login con Cuenta de Prueba

**Ir a:** `http://localhost:8000/login`

Selecciona una de estas cuentas:

```
┌─────────────────────────────────────────────┐
│ ADMIN                                       │
│ Email: admin@internconnect.com              │
│ Password: admin123456                       │
│ Dashboard: /dashboard/admin                 │
└─────────────────────────────────────────────┘

┌─────────────────────────────────────────────┐
│ ESTUDIANTE                                  │
│ Email: estudiante@example.com               │
│ Password: estudiante123456                  │
│ Dashboard: /dashboard/estudiante            │
└─────────────────────────────────────────────┘

┌─────────────────────────────────────────────┐
│ EMPRESA                                     │
│ Email: empresa@example.com                  │
│ Password: empresa123456                     │
│ Dashboard: /dashboard/empresa               │
└─────────────────────────────────────────────┘
```

### 3. Opción B: Crear Cuenta Nueva

**Ir a:** `http://localhost:8000/registro`

#### Para Estudiante:
1. Selecciona pestaña "👨‍🎓 Estudiante"
2. Llena: nombre, correo, contraseña (min 8 caracteres)
3. Agrega: universidad, carrera, año graduación (opcional)
4. Haz clic en "Registrarse como Estudiante"
5. ✅ Serás redirigido automáticamente a tu dashboard

#### Para Empresa:
1. Selecciona pestaña "🏢 Empresa"
2. Llena: nombre, correo, contraseña (min 8 caracteres)
3. Agrega: nombre empresa, industria, sitio web (opcional)
4. Haz clic en "Registrarse como Empresa"
5. ⚠️ Tu cuenta quedará pendiente de verificación
6. Admin debe verificar tu cuenta desde su dashboard

### 4. Explorar Dashboards

**Dashboard Admin** (`/dashboard/admin`)
- Estadísticas del sistema
- Empresas pendientes de verificación
- Botón para verificar empresas
- Acceso a todas las secciones

**Dashboard Estudiante** (`/dashboard/estudiante`)
- Mis postulaciones
- Ofertas guardadas
- Porcentaje de perfil completo
- Links a perfil y ofertas

**Dashboard Empresa** (`/dashboard/empresa`)
- Mis ofertas publicadas
- Postulantes recibidos
- Estado de verificación
- Información de la empresa

### 5. Cerrar Sesión

En cualquier dashboard, haz clic en "🚪 Cerrar Sesión"

---

## 📍 URLs Principales

| URL | Descripción |
|-----|-----------|
| `http://localhost:8000/` | Home/Inicio |
| `http://localhost:8000/login` | Formulario Login |
| `http://localhost:8000/registro` | Formulario Registro |
| `http://localhost:8000/dashboard` | Dashboard (redirige según rol) |
| `http://localhost:8000/dashboard/estudiante` | Dashboard Estudiante |
| `http://localhost:8000/dashboard/empresa` | Dashboard Empresa |
| `http://localhost:8000/dashboard/admin` | Dashboard Admin |

---

## 🧪 Pruebas Recomendadas

### Test 1: Probar Login Admin
```
1. Ir a /login
2. Email: admin@internconnect.com
3. Password: admin123456
4. Clic en "Iniciar Sesión"
5. ✓ Debería redirigir a /dashboard/admin
```

### Test 2: Probar Login Estudiante
```
1. Ir a /login
2. Email: estudiante@example.com
3. Password: estudiante123456
4. Clic en "Iniciar Sesión"
5. ✓ Debería redirigir a /dashboard/estudiante
```

### Test 3: Probar Login Empresa
```
1. Ir a /login
2. Email: empresa@example.com
3. Password: empresa123456
4. Clic en "Iniciar Sesión"
5. ✓ Debería redirigir a /dashboard/empresa
```

### Test 4: Registrar Nuevo Estudiante
```
1. Ir a /registro
2. Pestaña "Estudiante"
3. Llenar formulario con datos nuevos
4. Clic en "Registrarse como Estudiante"
5. ✓ Debería hacer login automático
6. ✓ Debería redirigir a /dashboard/estudiante
```

### Test 5: Registrar Nueva Empresa
```
1. Ir a /registro
2. Pestaña "Empresa"
3. Llenar formulario con datos nuevos
4. Clic en "Registrarse como Empresa"
5. ✓ Debería redirigir a /login
6. ✓ Debería mostrar mensaje "Pendiente de verificación"
```

### Test 6: Probar Logout
```
1. Estar logueado en cualquier dashboard
2. Clic en "🚪 Cerrar Sesión" en el sidebar
3. ✓ Debería cerrar sesión
4. ✓ Debería redirigir a inicio
```

---

## 🔍 Verificar Que Todo Funciona

Ejecutar tests:
```bash
php test_auth_system.php
```

Debería mostrar:
```
✓ Test 1-7: Todos pasando
✓ 23 usuarios en BD
✓ 3 roles configurados
✓ 5 vistas Blade
✓ 2 middleware registrados
✓ 10+ rutas de autenticación
```

---

## 💡 Tips Útiles

### Cambiar Contraseña de Prueba
En `database/seeders/DemoSeeder.php`, cambiar los valores:
```php
'contrasena_hash' => Hash::make('tu_nueva_password')
```
Luego ejecutar: `php artisan db:seed --class=DemoSeeder`

### Ver Todas las Rutas
```bash
php artisan route:list
```

### Limpiar Cache
```bash
php artisan cache:clear
```

### Recrear Base de Datos (si es necesario)
```bash
php artisan migrate:fresh
php artisan db:seed --class=DemoSeeder
```

---

## ⚠️ Notas Importantes

1. **Contraseña mínima:** 8 caracteres
2. **Correo único:** No puedes usar el mismo correo dos veces
3. **Empresas:** Quedan inactivas hasta que admin las verifica
4. **Admin:** Puede hacer login inmediatamente
5. **Estudiantes:** Pueden hacer login inmediatamente
6. **Sesión:** Se mantiene durante 120 minutos (configurable en `.env`)

---

## 🐛 Troubleshooting

### "No puedo conectar a localhost:8000"
```bash
# Intenta con un puerto diferente:
php artisan serve --port=8001
```

### "La base de datos no existe"
```bash
# Crear base de datos (asegúrate que MySQL esté corriendo):
mysql -u root
mysql> CREATE DATABASE sistema_pasantias;
mysql> exit;
```

### "Contraseña incorrecta"
Asegúrate de usar Bcrypt. Ejemplo:
```php
use Illuminate\Support\Facades\Hash;
Hash::check('password', '$2y$12$...'); // Debe retornar true
```

### "Sesión no se guarda"
Verificar que la carpeta `storage/framework/sessions/` existe y tiene permisos:
```bash
chmod -R 775 storage/
```

---

## 📖 Documentación Completa

Para más detalles, consulta estos archivos:

- **[CONFIGURACION_BD.md](CONFIGURACION_BD.md)** - Setup de BD y modelos
- **[AUTENTICACION_Y_ROLES.md](AUTENTICACION_Y_ROLES.md)** - Sistema completo
- **[RESUMEN_IMPLEMENTACION.md](RESUMEN_IMPLEMENTACION.md)** - Guía detallada

---

## ✅ Checklist de Verificación

- [ ] Servidor Laravel corriendo (`php artisan serve`)
- [ ] Puedo acceder a `http://localhost:8000`
- [ ] Puedo hacer login con admin
- [ ] Puedo hacer login con estudiante
- [ ] Puedo hacer login con empresa
- [ ] Puedo registrar nuevo estudiante
- [ ] Puedo registrar nueva empresa
- [ ] Puedo hacer logout
- [ ] Los dashboards muestran información correcta
- [ ] Redirección funciona según rol

---

## 🎉 ¡Listo!

El sistema está completamente funcional. Ahora puedes:

1. ✅ Hacer login
2. ✅ Registrarse
3. ✅ Ver dashboards personalizados
4. ✅ Gestionar roles

**Próximas funcionalidades:** CRUD ofertas, gestión de postulaciones, upload de documentos, etc.

---

**Fecha:** 2026-05-25  
**Status:** ✅ Completado y Verificado
