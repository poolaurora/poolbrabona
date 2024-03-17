<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountConfirmationController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\MachineController;
use App\Http\Controllers\SalasController;

//ADMIN
use App\Http\Controllers\ADMIN\UserController;
use App\Http\Controllers\ADMIN\MaquinasController;
use App\Http\Controllers\ADMIN\SaquesController;
use App\Http\Controllers\ADMIN\ChatController;

//CHECKOUT
use App\Http\Controllers\CheckoutController;

//MISC
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

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

Route::get('/set-cookie', function (Request $request) {
    $cookie = cookie('userDiscount', 'sharkDiscount', 60*24*30); // 60 minutos
    return response('Cookie is set')->cookie($cookie);
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/responsability', function () {
    return view('responsability');
});

Route::get('/email', function () {
    return view('emails.purchase');
});

Route::get('/cm/{token}', [AccountConfirmationController::class, 'index'])->name('auth.cm');
Route::post('/ca/register', [AccountController::class, 'create'])->name('auth.ca');
Route::post('/cm/validate/{token}', [AccountConfirmationController::class, 'validateTokenAndCod'])->name('auth.cm.validate');
Route::post('/cm/validateDash', [AccountConfirmationController::class, 'ConfirmationOnDash'])->name('auth.cm.validateDash');




Route::group(['prefix' => 'checkout'], function () {
    Route::get('/{id}', [CheckoutController::class, 'index'])->name('checkout');
    Route::get('/payment/{id}', [CheckoutController::class, 'indexPayment'])->name('checkout.payment');
    Route::get('/payment/sucess/{id}', [CheckoutController::class, 'indexSucess'])->name('checkout.sucess');
    Route::post('/create/order', [CheckoutController::class, 'createOrder'])->name('checkout.createOrder');
    Route::post('/process/order', [CheckoutController::class, 'processPayment'])->name('checkout.processPayment');
});


Route::middleware([
    'auth:web',
    'verified',
])->group(function () {

    // Grupo de rotas para o Dashboard
    Route::group(['prefix' => 'dashboard'], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Grupo de rotas para Saques
        Route::group(['prefix' => 'saques'], function () {
            Route::get('/efetuar', [DashboardController::class, 'SaquesIndex'])->name('saques.efetuar');
            Route::post('/store', [WithdrawalController::class, 'store'])->name('saques.store');
            Route::get('/historico', [DashboardController::class, 'HistoryIndex'])->name('saques.historico');
        });

        Route::group(['prefix' => 'tutoriais'], function () {
            Route::get('/menu', [DashboardController::class, 'TutoriaisIndex'])->name('tutoriais.menu');
        });

        Route::group(['prefix' => 'maquinas'], function () {
            Route::get('/menu', [DashboardController::class, 'indexMachines'])->name('maquinas.menu');
            Route::get('/upgrade/{id}', [MachineController::class, 'upgradeMachine'])->name('maquinas.upgrade');
            Route::get('/adicionar', function () {
                return view('maquinas.adicionar');
                })->name('maquinas.adicionar');
            Route::post('/adcionar/order', [MachineController::class, 'createOrderAdicionar'])->name('maquinas.buy');
            Route::post('/upgrade/buy', [MachineController::class, 'createOrderUpgrade'])->name('maquinas.upgradeBuy');
        });

        Route::group(['prefix' => 'salas'], function () {
            Route::get('/lobby', [DashboardController::class, 'IndexSalas'])->name('salas.menu');
            Route::get('/lobby/create', [DashboardController::class, 'IndexCreateSalas'])->name('salas.create');
            Route::get('/lobby/ativas', [DashboardController::class, 'IndexActiveSalas'])->name('salas.active');
            Route::post('/lobby/store', [SalasController::class, 'store'])->name('salas.store');
            Route::post('/lobby/join/{id}', [SalasController::class, 'JoinRoom'])->name('salas.join');
            Route::post('/lobby/create/order', [SalasController::class, 'createOrder'])->name('salas.order');

        });

        Route::group(['prefix' => 'me'], function () {
            Route::get('/extrato', [DashboardController::class, 'Extrato'])->name('me.extrato');
            Route::get('/profile', [DashboardController::class, 'Profile'])->name('me.profile');
            Route::post('/upgrade/plan', [AccountController::class, 'createOrder'])->name('me.upgrade');

        });

        Route::group(['prefix' => 'admin', 'middleware' => ['role:admin']], function () {

            Route::get('/users', [UserController::class, 'index'])->name('admin.users');
            Route::get('/users/moreinfo/{id}', [UserController::class, 'MoreInfo'])->name('admin.moreInfo');
            Route::post('/users/moreinfo/{id}', [UserController::class, 'BanUser'])->name('admin.banuser');
            Route::post('/users/impersonate/{id}', [UserController::class, 'impersonate'])->name('admin.impersonate');
            Route::post('/users/updateRole/', [UserController::class, 'updateRole'])->name('admin.update.role');

            Route::get('/maquinas', [MaquinasController::class, 'index'])->name('admin.maquinas');
            Route::post('/maquinas/create', [MaquinasController::class, 'create'])->name('admin.Mcreate');
            Route::post('/maquinas/charge', [MaquinasController::class, 'charge'])->name('admin.Mcharge');
            Route::post('/maquinas/delete', [MaquinasController::class, 'delete'])->name('admin.Mdelete');

            Route::get('/salas', [SalasController::class, 'index'])->name('admin.salas');
            Route::post('/salas/create', [SalasController::class, 'create'])->name('admin.Screate');

            Route::get('/saques', [SaquesController::class, 'index'])->name('admin.saques');
            Route::post('/saques/update/{id}', [SaquesController::class, 'update'])->name('admin.Supdate');

            Route::get('/chat', [ChatController::class, 'index'])->name('admin.chat');
        });

    });
});
