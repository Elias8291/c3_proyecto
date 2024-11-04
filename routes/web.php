<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\InscripcionController;
use App\Http\Controllers\GrupoController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\MateriasController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PeriodoController;
use App\Http\Controllers\EvaluadoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\CajaController;
use App\Http\Controllers\CarpetaController;

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
    Route::resource('blogs', BlogController::class);
    Route::resource('estudiantes', EstudianteController::class);
    Route::resource('inscripciones', InscripcionController::class);
    Route::resource('periodos', PeriodoController::class);
    Route::resource('grupos', GrupoController::class);
    Route::resource('materias', MateriasController::class);
    Route::resource('logs', LogController::class);
    Route::resource('evaluados', EvaluadoController::class);
    Route::resource('documentos', DocumentoController::class);
    Route::resource('areas', AreaController::class);

    Route::get('/evaluados/filterByYear', [EvaluadoController::class, 'filterByYear'])->name('evaluados.filterByYear');
    Route::resource('cajas', CajaController::class);
    Route::resource('carpetas', CarpetaController::class);
    Route::get('/carpetas/creaR/{evaluado_id}', [CarpetaController::class, 'crear'])->name('carpetas.crear');


});
// En routes/web.php