<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TasksController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'getMain']) -> name('home');

// Rotas de Users
Route::get('/all-users',[UserController::class, 'getAllUsers']) -> name('users.all');

Route::get('/new-user', [UserController::class, 'addNewUser']) -> name('users.new-user');
Route::post('/store-user', [UserController::class, 'storeUser']) -> name('users.store'); // Neste caso, é um POST, ou seja, estamos a lidar com um formulário e precisamos de guardar os dados de input. Os POST não precisam de views, uma vez que não mostram dados, apenas os transportam.

Route::get('/view-user/{id}', [UserController::class, 'viewUser']) -> name('users.view-user'); // Rota com parâmetros
Route::get('/delete-user/{id}', [UserController::class, 'deleteUser']) -> name('users.delete-user'); // Rota com parâmetros

// Rotas de Tarefas
Route::get('/all-tasks', [TasksController::class, 'getAllTasks']) -> name('tasks.all-tasks');
Route::get('/view-task/{id}', [TasksController::class, 'viewTask']) -> name('tasks.view-task'); // Rota com parâmetros
Route::get('/delete-task/{id}', [TasksController::class, 'deleteTask']) -> name('tasks.delete-task'); // Rota com parâmetros
// Rotas para criar e guardar tarefas
Route::get('/create-task', [TasksController::class, 'addNewTask']) -> name('task.add-task');
Route::post('/store-task', [TasksController::class, 'storeTask']) -> name('tasks.store'); // Neste caso, é um POST, ou seja, estamos a lidar com um formulário e precisamos de guardar os dados de input. Os POST não precisam de views, uma vez que não mostram dados, apenas os transportam.


// Rotas para Gifts
Route::get('/all-gifts', [GiftController::class, 'getAllGifts']) -> name('gifts.all-gifts');
Route::get('/add-gift', [GiftController::class, 'addNewGift']) -> name('gifts.add-gift');
Route::get('/view-gift/{id}', [GiftController::class, 'viewGift']) -> name('gifts.view-gift'); // Estas duas são para ver/editar
Route::post('/store-task', [GiftController::class, 'storeGift']) -> name('gifts.store');


// Rota fallback (em vez do erro 404)
Route:: fallback(function () { // Não colocamos o get neste fallback porque queremos que o utilizador seja redirecionado para esta página sempre que escolha uma inválida, e não apenas uma página que não contemplamos no nosso código
    return view('errors.fallback');
}) -> name('errors.fallback');
