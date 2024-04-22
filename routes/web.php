<?php

use App\Http\Controllers\AmbienteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BloqueController;
use App\Http\Controllers\DepartamentoController;
use App\Http\Controllers\EntradaSalidaController;
use App\Http\Controllers\FichaCaracterizacionController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InstructorController;
use App\http\Controllers\LoginController;
use App\http\Controllers\LogoutController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\PersonaController;
use App\Http\Controllers\PisoController;
use App\Http\Controllers\SedeController;
use App\Models\Ambiente;
use App\Models\Bloque;
use App\Models\EntradaSalida;
use App\Models\FichaCaracterizacion;
use App\Http\Controllers\ParametroController;
use App\Http\Controllers\TemaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/home', function () {
//     return view('home');
// });
Route::resource('home', HomeController::class);
// Route::get('/', function () {
//     return view('welcome');
// });
// Rutas para persona
Route::resource('persona', PersonaController::class);
Route::put('/persona/{persona}/cambiarEstado', [PersonaController::class, 'cambiarEstadoUser'])->name('persona.cambiarEstadoUser');

//Rutas para instructores
Route::resource('instructor', InstructorController::class);
// Rutas para entrada y salida
Route::resource('entradaSalida', EntradaSalidaController::class);
Route::get('cargarDatos', [EntradaSalidaController::class, 'cargarDatos'])->name('entradaSalida.cargarDatos');
Route::get('crearEntradaSalida/{ficha_caracterizacion_id}/{aprendiz}', [EntradaSalidaController::class, 'storeEntradaSalida'])->name('entradaSalida.crearEntradaSalida');
Route::get('editarEntradaSalida/{aprendiz}', [EntradaSalidaController::class, 'updateEntradaSalida'])->name('entradaSalida.editarEntradaSalida');
Route::get('/registros/{fichaCaracterizacion}', [EntradaSalidaController::class, 'registros'])->name('entradaSalida.registros');
Route::post('updateSalida', [EntradaSalidaController::class, 'updateSalida'])->name('entradaSalida.updateSalida');
Route::get('generarCSV/{ficha}', [EntradaSalidaController::class, 'generarCSV'])->name('entradaSalida.generarCSV');


// Rutas oara fucha de caracterizacion
Route::resource('fichaCaracterizacion', FichaCaracterizacionController::class);

// Ruta para sedes
Route::resource('sede', SedeController::class);
Route::get('/cargarSedes/{municipio_id}', [SedeController::class, 'cargarSedes'])->name('sede.cargarSedes');

// Ruta para bloques
Route::resource('bloque', BloqueController::class);
Route::get('/cargarBloques/{sede_id}', [BloqueController::class, 'cargarBloques'])->name('bloque.cargarBloques');

// Ruta para los pisos
Route::resource('piso', PisoController::class);
Route::get('/cargarPisos/{bloque_id}', [PisoController::class, 'cargarPisos'])->name('piso.cargarPisos');

// Ruta para ambientes
Route::resource('ambiente', AmbienteController::class);
Route::get('/cargarAmbientes/{piso_id}', [AmbienteController::class, 'cargarAmbientes'])->name('ambiente.cargarAmbientes');



// rutas del controlador register
Route::controller(RegisterController::class)->group(function(){
    Route::get('/registro', 'mostrarFormulario')->name('registro');
    Route::post('/registrarme', 'create')->name('registrarme');
});
// rutas del controlador login
Route::resource('login', LoginController::class);
Route::controller(LoginController::class)->group(function(){
    Route::get('/','verificarLogin')->name('verificarLogin');
    // Route::get('/login','mostrarLogin')->name('login');
    Route::post('/iniciarSesion','iniciarSesion')->name('iniciarSesion');
});
// rutas para parametros
Route::resource('parametro', ParametroController::class);
Route::put('/parametro/{parametro}/cambiar-estado', [ParametroController::class, 'cambiarEstado'])->name('parametro.cambiarEstado');


// rutas para temas
Route::resource('tema', TemaController::class);
Route::put('/tema/{tema}/cambiar-estado', [TemaController::class, 'cambiarEstado'])->name('tema.cambiarEstado');
Route::put('/tema/{parametro}/cambiar-estado-parametro', [TemaController::class, 'cambiarEstadoParametro'])->name('tema.cambiarEstadoParametro');

Route::get('/logout', [LogoutController::class, 'cerrarSesion'])->name('logout');

// rutas para departamentos

Route::get('/cargardepartamentos', [DepartamentoController::class, 'cargardepartamentos'])->name('departamento.cargardepartamentos');
Route::get('/cargarMunicipios/{departamento_id}', [MunicipioController::class, 'cargarMunicipios'])->name('municipio.cargarMunicipios');
