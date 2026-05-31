<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentProfileController;
use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\InternshipOfferController;

// Rutas públicas
Route::get('/', function () {
    return view('index');
});

Route::view('/index', 'index')->name('index');
Route::view('/explora', 'explora')->name('explora');
Route::view('/comofunciona', 'comofunciona')->name('comofunciona');
Route::view('/sobrenosotros', 'sobrenosotros')->name('sobrenosotros');
Route::view('/contacto', 'contacto')->name('contacto');
Route::view('/privacidad', 'privacidad')->name('privacidad');

// Rutas de autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    
    Route::get('/registro', [AuthController::class, 'showRegistrationForm'])->name('registro');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/registro/estudiante', [AuthController::class, 'registerStudent'])->name('register.student');
    Route::post('/registro/empresa', [AuthController::class, 'registerCompany'])->name('register.company');
});

// Logout (disponible siempre)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Alias legacy .html routes used by navbar/footer links.
Route::view('/explorar', 'explora');
Route::view('/comufunciona', 'comofunciona');

// Redirect legacy .html URLs to the new routes (preserve SEO / bookmarks)
Route::redirect('/index.html', '/index', 301);
Route::redirect('/explora.html', '/explora', 301);
Route::redirect('/explorar.html', '/explora', 301);
Route::redirect('/comofunciona.html', '/comofunciona', 301);
Route::redirect('/comufunciona.html', '/comofunciona', 301);
Route::redirect('/sobrenosotros.html', '/sobrenosotros', 301);
Route::redirect('/contacto.html', '/contacto', 301);
Route::redirect('/privacidad.html', '/privacidad', 301);
Route::redirect('/login.html', '/login', 301);
Route::redirect('/registro.html', '/registro', 301);

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    
    // Dashboards según rol
    Route::get('/dashboard', function () {
        $user = Auth::user();
        return match ($user->rol_id) {
            1 => redirect()->route('dashboard.student'), // Estudiante
            2 => redirect()->route('dashboard.company'), // Empresa
            3 => redirect()->route('dashboard.admin'), // Administrador
            default => redirect('/'),
        };
    })->name('dashboard');

    // Dashboard específico para cada rol
    Route::get('/dashboard/estudiante', function () {
        return view('dashboard_student');
    })->name('dashboard.student')->middleware('role:1');

    Route::get('/dashboard/empresa', function () {
        return view('dashboard_company');
    })->name('dashboard.company')->middleware('role:2');

    Route::middleware('role:3')->prefix('/dashboard/admin')->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard.admin');
        Route::post('/usuarios', [AdminDashboardController::class, 'storeUser'])->name('dashboard.admin.users.store');
        Route::put('/usuarios/{user}', [AdminDashboardController::class, 'updateUser'])->name('dashboard.admin.users.update');
        Route::delete('/usuarios/{user}', [AdminDashboardController::class, 'destroyUser'])->name('dashboard.admin.users.destroy');

        Route::post('/ofertas', [AdminDashboardController::class, 'storeOffer'])->name('dashboard.admin.offers.store');
        Route::put('/ofertas/{offer}', [AdminDashboardController::class, 'updateOffer'])->name('dashboard.admin.offers.update');
        Route::delete('/ofertas/{offer}', [AdminDashboardController::class, 'destroyOffer'])->name('dashboard.admin.offers.destroy');

        Route::get('/reportes/{report}', [AdminDashboardController::class, 'downloadReport'])
            ->whereIn('report', ['users', 'offers', 'applications', 'audits', 'changes'])
            ->name('dashboard.admin.reports.download');
    });

    // Rutas de Usuario (todos los roles autenticados)
    Route::prefix('/api/users')->group(function () {
        Route::get('/', [UserController::class, 'index']);
        Route::get('/me', [UserController::class, 'me'])->name('api.users.me');
        Route::get('/{id}', [UserController::class, 'show']);
        Route::put('/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });

    // Rutas de Perfil de Estudiante
    Route::prefix('/api/student-profile')->group(function () {
        Route::get('/{usuarioId}', [StudentProfileController::class, 'show']);
        Route::post('/{usuarioId}', [StudentProfileController::class, 'store']);
        Route::put('/{usuarioId}', [StudentProfileController::class, 'store']);
    });

    // Rutas de Perfil de Empresa
    Route::prefix('/api/company-profile')->group(function () {
        Route::get('/{usuarioId}', [CompanyProfileController::class, 'show']);
        Route::post('/{usuarioId}', [CompanyProfileController::class, 'store']);
        Route::put('/{usuarioId}', [CompanyProfileController::class, 'store']);
    });

    // Rutas de Ofertas de Pasantía (disponible para todos)
    Route::prefix('/api/internship-offers')->group(function () {
        Route::get('/', [InternshipOfferController::class, 'index']);
        Route::get('/{id}', [InternshipOfferController::class, 'show']);
        
        // Solo empresas verificadas pueden crear ofertas
        Route::post('/', [InternshipOfferController::class, 'store'])->middleware('role:2');
        Route::put('/{id}', [InternshipOfferController::class, 'update'])->middleware('role:2');
        Route::delete('/{id}', [InternshipOfferController::class, 'destroy'])->middleware('role:2');
    });
});