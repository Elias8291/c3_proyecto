<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\EvaluadoController;

use App\Http\Controllers\AreaController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\CarpetaController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\NotificacionController;
use App\Models\Caja;
use App\Models\Notificacion;
use App\Http\Controllers\DocumentoController;

// Ruta para la página de bienvenida, accesible para todos los usuarios
Route::get('/', [WelcomeController::class, 'showWelcomePage'])->name('welcome');
Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

Route::post('/usuarios/changePassword', [App\Http\Controllers\UsuarioController::class, 'changePassword'])->name('usuarios.changePassword');
Route::post('/usuarios/updateProfile', [App\Http\Controllers\UsuarioController::class, 'updateProfile'])->name('usuarios.updateProfile');
Route::get('/usuarios/user-list', [App\Http\Controllers\UsuarioController::class, 'getUserList'])->name('usuarios.getUserList');

// Grupo de rutas protegidas por el middleware 'auth'
Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RolController::class);
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('logs', LogController::class);
    Route::resource('evaluados', EvaluadoController::class);
    Route::resource('documentos', DocumentoController::class);
    Route::resource('areas', AreaController::class);

    Route::get('/evaluados/filterByYear', [EvaluadoController::class, 'filterByYear'])->name('evaluados.filterByYear');
    Route::resource('cajas', CajaController::class);
    Route::resource('carpetas', CarpetaController::class);
    Route::get('/carpetas/creaR/{evaluado_id}', [CarpetaController::class, 'crear'])->name('carpetas.crear');
    Route::get('/cajas/{id}', [CajaController::class, 'show'])->name('cajas.show');
    Route::get('/evaluados/{id}/datos', [EvaluadoController::class, 'getDatosEvaluado']);
    Route::get('/cajas/todas', function () {
        return response()->json(Caja::all());
    });
    Route::get('/roles/{id}/edit', [RolController::class, 'edit'])->name('roles.edit');
    Route::prefix('prestamos')->group(function () {
        Route::post('solicitar', [PrestamoController::class, 'solicitar'])->name('prestamos.solicitar');
        Route::post('{prestamo}/aprobar', [PrestamoController::class, 'aprobar'])->name('prestamos.aprobar');
        Route::post('{prestamo}/rechazar', [PrestamoController::class, 'rechazar'])->name('prestamos.rechazar'); // Agrega esta línea
        Route::post('{id}/devolver', [PrestamoController::class, 'devolver'])->name('prestamos.devolver');
        Route::get('/', [PrestamoController::class, 'index'])->name('prestamos.index');
        Route::get('{id}', [PrestamoController::class, 'show'])->name('prestamos.show');
    });


    // Rutas para notificaciones
    Route::prefix('notificaciones')->group(function () {
        Route::post('crear', [NotificacionController::class, 'crear'])->name('notificaciones.crear');
        Route::get('/', [NotificacionController::class, 'listar'])->name('notificaciones.listar');
        Route::delete('{id}', [NotificacionController::class, 'eliminar'])->name('notificaciones.eliminar');
    });

    Route::get('/prestamos/create', [PrestamoController::class, 'create'])->name('prestamos.create');
    Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
    Route::get('/notificaciones/marcar-leida/{id}', [NotificacionController::class, 'marcarComoLeida'])->name('notificaciones.marcarComoLeida');
    // In routes/web.php
    Route::post('/documentos/{documentoId}/solicitar', [PrestamoController::class, 'solicitar'])->name('prestamos.solicitar');
    Route::post('/documentos/{documentoId}/cancelar', [PrestamoController::class, 'cancelar'])->name('prestamos.cancelar');
    Route::delete('/documentos/{id}', [DocumentoController::class, 'destroy'])->name('documentos.destroy');
    Route::get('/prestamos', [PrestamoController::class, 'index']);



    Route::middleware('auth')->group(function () {
        Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
        Route::post('/notificaciones/crear', [NotificacionController::class, 'crear'])->name('notificaciones.crear');
        Route::get('/notificaciones/{id}/marcar-leida', [NotificacionController::class, 'marcarLeida'])->name('notificaciones.marcarLeida');
    });

    Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
    Route::post('/documentos/{documento}/solicitar', [NotificacionController::class, 'crearNotificacionSolicitud'])
        ->name('prestamos.solicitar');

    Route::post('prestamos/aprobar/{documento}', [PrestamoController::class, 'aprobar'])->name('prestamos.aprobar');
    Route::post('prestamos/rechazar/{documento}', [PrestamoController::class, 'rechazar'])->name('prestamos.rechazar');
    Route::resource('carpetas', CarpetaController::class);
    Route::resource('documentos', DocumentoController::class)->except(['show', 'edit']);
    Route::delete('/documentos/{id}', [DocumentoController::class, 'destroy'])->name('documentos.destroy');
    Route::post('/documentos/{carpeta}', [DocumentoController::class, 'store'])->name('documentos.store');
    Route::get('/evaluados/search', [EvaluadoController::class, 'search'])->name('evaluados.search');
    Route::post('/documentos2', [DocumentoController::class, 'store'])->name('documentos.store');
    Route::resource('documentos', DocumentoController::class)->except(['show', 'edit']);
    Route::resource('documentos', DocumentoController::class);
    Route::get('/documentos2', [DocumentoController::class, 'index'])->name('documentos2.index');
    Route::get('/documentos2', [DocumentoController::class, 'index'])->name('documentos2.index');
    Route::post('/documentos/{id}/agregar-pdf', [DocumentoController::class, 'agregarPdf'])->name('documentos.agregarPdf');
    Route::post('/prestamos/solicitar', [PrestamoController::class, 'solicitarPrestamo'])->name('prestamos.solicitar');
    Route::post('/prestamos/solicitar', [PrestamoController::class, 'solicitar'])->name('prestamos.solicitar');
    Route::post('/prestamos/{id}/aprobar', [PrestamoController::class, 'aprobar'])->name('prestamos.aprobar');
    Route::post('/prestamos/{id}/devolver', [PrestamoController::class, 'devolver'])->name('prestamos.devolver');
    Route::post('/prestamos/{id}/cancelar', [PrestamoController::class, 'cancelar'])->name('prestamos.cancelar');
    Route::post('/prestamos/cancelar-por-documento/{documentoId}', [PrestamoController::class, 'cancelarPorDocumento'])->name('prestamos.cancelarPorDocumento');
    Route::get('/prestamos/filtrar', [PrestamoController::class, 'filtrar'])->name('prestamos.filtrar');
    Route::get('/prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');
    Route::put('/prestamos/{id}/aprobar', [PrestamoController::class, 'aprobar'])->name('prestamos.aprobar');
    Route::put('/prestamos/{id}/rechazar', [PrestamoController::class, 'rechazar'])->name('prestamos.rechazar');
    Route::put('/prestamos/{id}/cancelar', [PrestamoController::class, 'cancelar'])->name('prestamos.cancelar');
    Route::post('/prestamos/devolver-por-documento/{documentoId}', [PrestamoController::class, 'devolverPorDocumento'])
    ->name('prestamos.devolverPorDocumento');
    Route::get('/prestamos/{id}/detalles', [PrestamoController::class, 'detalles'])->name('prestamos.detalles');
    Route::middleware(['auth'])->group(function () {
        Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
        Route::patch('/notificaciones/{id}/leida', [NotificacionController::class, 'marcarComoLeida'])->name('notificaciones.leida');
        Route::delete('/notificaciones/{id}', [NotificacionController::class, 'eliminar'])->name('notificaciones.eliminar');
        Route::get('/notificaciones', [NotificacionController::class, 'index'])->name('notificaciones.index');
    });
    Route::post('/notificaciones/archivo', [NotificacionController::class, 'enviarNotificacionArchivo'])
    ->name('notificaciones.enviarArchivo')
    ->middleware('auth');
    
    Route::get('/carpetas/search-evaluados', [CarpetaController::class, 'searchEvaluados'])->name('carpetas.search-evaluados');
    Route::delete('/documentos/{id}', [DocumentoController::class, 'destroy'])->name('documentos.destroy');
    Route::middleware('auth')->group(function () {
        Route::get('/mis-documentos', [PrestamoController::class, 'misDocumentosPrestados'])
             ->name('prestamos.mis_documentos');
    });
    Route::post('/usuarios/check-email', [UsuarioController::class, 'checkEmail'])->name('usuarios.checkEmail');
});
// En routes/web.php