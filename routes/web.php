<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\VendedorController;
use App\Http\Controllers\VendaController;
use App\Http\Controllers\ClienteController;


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


Route::get('/produtos', [ProdutoController::class, 'get_all']);
Route::get('/produto', [ProdutoController::class, 'index'] );
Route::get('/produto/{nome_produto?}/{id_produto?}',[ProdutoController::class, 'index',['nome_produto','id_produto']]) ->where(['nome_produto'=>'[A-Za-z]+', 'id_produto'=>'[0-9]+']);


Route::get('/', [VendedorController::class,'login'])->name('login.vendedor');
Route::get('/login/vendedor', [VendedorController::class,'login'])->name('login.vendedor');
Route::post('/login/vendedor', [VendedorController::class, 'authenticate'])->name('login.vendedor.auth');

Route::get('/vendedor', [VendedorController::class,'index'])->name('vendedor.dashboard');

Route::group(['middleware' => 'web'], function () {
    Route::get('/cadastro/cliente', [ClienteController::class, 'create'])->name('cliente.create');
    Route::post('/cadastro/cliente', [ClienteController::class, 'store'])->name('cliente.store');

    Route::get('venda', [VendaController::class, 'show'])->name('venda.show');
    Route::post('venda/checkout', [VendaController::class, 'checkout'])->name('venda.checkout');
    Route::post('venda/pagamento', [VendaController::class, 'pagamento'])->name('venda.pagamento');
    Route::post('venda/finaliza', [VendaController::class, 'finalizar'])->name('venda.finalizar');
    Route::get('venda/pdf/{id_venda}', [VendaController::class, 'gerarPDF'])->name('venda.pdf');


});
