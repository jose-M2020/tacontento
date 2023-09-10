<?php
use Core\Facades\Route;

/*
|--------------------------------------------------------------------------
| MAIN PAGES
|--------------------------------------------------------------------------
*/

Route::get('/', 'IndexController@home');
Route::get('/menu', 'IndexController@menu');
Route::get('/services', 'IndexController@services');
Route::get('/about', 'IndexController@about');

/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
*/

Route::get('/auth', 'AuthController@auth');
Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');
Route::get('/logout', 'AuthController@logout')->middleware('auth');

/*
|--------------------------------------------------------------------------
| CLIENT ROUTES
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth', 'role:client']], function($router) {
  
  Route::get('/carrito', 'CarritoController@index');
  Route::post('/carrito/:itemId', 'CarritoController@store');
  Route::delete('/carrito/:itemId', 'CarritoController@destroy');
  
  Route::get('/mis-compras', 'PedidoController@compras');
  
  Route::get('/mis-reservas', 'ReservaController@getAllByClient');
  Route::get('/mis-reservas/create', 'ReservaController@create');
  Route::post('/mis-reservas', 'ReservaController@store');

  Route::get('/checkout', 'PedidoController@checkout');
  Route::post('/payment-init', 'PedidoController@payment_init');
  Route::get('/payment-success', 'PedidoController@payment_success');
  Route::get('/payment-cancel', 'PedidoController@payment_cancel');
  
  Route::get('/createpedido', 'PedidoController@create');
  Route::get('/storepedido', 'PedidoController@store');

});

/*
|--------------------------------------------------------------------------
| ADMIN
|--------------------------------------------------------------------------
*/

Route::group(['middleware' => ['auth', 'role:admin']], function($router) {
  
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

  Route::get('/reservas', 'ReservaController@index');
  Route::get('/reservas/:reserva', 'ReservaController@show');
  
  Route::get('/pedidos', 'PedidoController@index');
  Route::get('/pedidos/:pedido', 'PedidoController@show');
  Route::put('/pedidos/:pedido', 'PedidoController@update');

  Route::get('/ventas', 'PedidoController@venta');
  Route::get('/ventas/:pedido', 'PedidoController@show');

});


// ? ----------------------------- ?


// Route::get('/editreserva', 'ReservaController@edit');
// Route::get('/updatereserva', 'ReservaController@update');
// Route::get('/destroyreserva', 'ReservaController@destroy');

Route::get('/imprimirreserva', 'ReservaController@imprimir');

// Route::get('/editpedido', 'PedidoController@edit');
Route::get('/imprimirpedido', 'PedidoController@imprimir');


// Run the router
Route::run();
