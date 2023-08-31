<?php
use Core\Facades\Route;

/*
 *  MAIN PAGES
 */

Route::get('/home', 'IndexController@home');
Route::get('/test1', 'IndexController@home')->middleware('auth');
Route::get('/test2', 'IndexController@home');
// Route::get('/menu', 'IndexController@menu');
// Route::get('/services', 'IndexController@services');
Route::get('/about', 'IndexController@about');

Route::middleware('auth', true)->group(function($router) {
  Route::get('/menu', 'IndexController@menu');
  Route::get('/services', 'IndexController@services');
});

/*
 *  AUTHENTICATION
 */

Route::get('/auth', 'AuthController@auth');
Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::get('/logout', 'AuthController@logout');

/*
 *  CLIENT PAGES
 */

Route::get('/carrito', 'CarritoController@index');
Route::post('/carrito/:id', 'CarritoController@store');
Route::delete('/deletecarrito', 'CarritoController@destroy');

Route::get('/compras', 'PedidoController@compras');

Route::get('/pay', 'PedidoController@pay');
Route::get('/payment-init', 'PedidoController@payment_init');
Route::get('/payment-success', 'PedidoController@payment_success');
Route::get('/payment-cancel', 'PedidoController@payment_cancel');

Route::get('/createpedido', 'PedidoController@create');
Route::get('/storepedido', 'PedidoController@store');

/*
 *  ADMIN
 */

Route::get('/usuarios', 'UsuariosController@index');
Route::get('/usuarios/create', 'UsuariosController@create');
Route::post('/usuarios', 'UsuariosController@store');
Route::get('/usuarios/:usuario/edit', 'UsuariosController@edit');
Route::put('/usuarios/:usuario', 'UsuariosController@update');
Route::delete('/usuarios/:usuario', 'UsuariosController@destroy');

Route::get('/platillos', 'ArticuloController@index');
Route::get('/platillos/create', 'ArticuloController@create');
Route::post('/platillos', 'ArticuloController@store');
Route::put('/platillos/:platillo', 'ArticuloController@update');
Route::get('/platillos/:platillo/edit', 'ArticuloController@edit');
Route::delete('/platillos/:platillo', 'ArticuloController@destroy');

Route::get('/ofertas', 'OfertaController@index');
Route::get('/ofertas/create', 'OfertaController@create');
Route::post('/ofertas', 'OfertaController@store');
Route::get('/ofertas/:oferta/edit', 'OfertaController@edit');
Route::put('/ofertas/:oferta', 'OfertaController@update');
Route::delete('/ofertas/:oferta', 'OfertaController@destroy');

Route::get('/pedidos', 'PedidoController@index'); //admin
Route::get('/ventas', 'PedidoController@venta');
Route::get('/ventas/:pedido', 'PedidoController@show');


Route::put('/pedidos/:pedido', 'PedidoController@update'); //admin




// ?

Route::get('/reservas', 'ReservaController@index'); //admin
Route::get('/createreserva', 'ReservaController@create');
Route::get('/storereserva', 'ReservaController@store');
Route::get('/editreserva', 'ReservaController@edit');
Route::get('/updatereserva', 'ReservaController@update');
Route::get('/destroyreserva', 'ReservaController@destroy');

Route::get('/reservas/:reserva', 'ReservaController@show'); //admin
Route::get('/imprimirreserva', 'ReservaController@imprimir');



Route::get('/editpedido', 'PedidoController@edit');
Route::get('/imprimirpedido', 'PedidoController@imprimir');
Route::get('/pedidos/:pedido', 'PedidoController@show'); //admin








// ------------------------------------------------------


Route::get('/users', 'UserController@index');
Route::get('/user/:userId', 'UserController@show');
Route::get('/user/create', 'UserController@create');
Route::post('/user', 'UserController@store');
Route::get('/user/:userId/edit', 'UserController@edit');
Route::put('/user/:userId', 'UserController@update');
Route::delete('/user/:userId', 'UserController@destroy');

// ------------------------------------------------------



// Run the router
Route::run();
