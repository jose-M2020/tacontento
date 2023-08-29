<?php
use App\Routes\Router;

$router = new Router();

/*
 *  MAIN PAGES
 */

$router->get('/home', 'IndexController@home');
$router->get('/test1', 'IndexController@home')->middleware('auth');
$router->get('/test2', 'IndexController@home');
// $router->get('/menu', 'IndexController@menu');
// $router->get('/services', 'IndexController@services');
$router->get('/about', 'IndexController@about');

$router->middleware('auth', true)->group(function($router) {
  $router->get('/menu', 'IndexController@menu');
  $router->get('/services', 'IndexController@services');
});

/*
 *  AUTHENTICATION
 */

$router->get('/auth', 'AuthController@auth');
$router->post('/login', 'AuthController@login');
$router->post('/register', 'AuthController@register');
$router->get('/logout', 'AuthController@logout');

/*
 *  CLIENT PAGES
 */

$router->get('/carrito', 'CarritoController@index');
$router->post('/carrito/:id', 'CarritoController@store');
$router->delete('/deletecarrito', 'CarritoController@destroy');

$router->get('/compras', 'PedidoController@compras');

$router->get('/pay', 'PedidoController@pay');
$router->get('/payment-init', 'PedidoController@payment_init');
$router->get('/payment-success', 'PedidoController@payment_success');
$router->get('/payment-cancel', 'PedidoController@payment_cancel');

$router->get('/createpedido', 'PedidoController@create');
$router->get('/storepedido', 'PedidoController@store');

/*
 *  ADMIN
 */

$router->get('/usuarios', 'UsuariosController@index');
$router->get('/usuarios/create', 'UsuariosController@create');
$router->post('/usuarios', 'UsuariosController@store');
$router->get('/usuarios/:usuario/edit', 'UsuariosController@edit');
$router->put('/usuarios/:usuario', 'UsuariosController@update');
$router->delete('/usuarios/:usuario', 'UsuariosController@destroy');

$router->get('/platillos', 'ArticuloController@index');
$router->get('/platillos/create', 'ArticuloController@create');
$router->post('/platillos', 'ArticuloController@store');
$router->put('/platillos/:platillo', 'ArticuloController@update');
$router->get('/platillos/:platillo/edit', 'ArticuloController@edit');
$router->delete('/platillos/:platillo', 'ArticuloController@destroy');

$router->get('/ofertas', 'OfertaController@index');
$router->get('/ofertas/create', 'OfertaController@create');
$router->post('/ofertas', 'OfertaController@store');
$router->get('/ofertas/:oferta/edit', 'OfertaController@edit');
$router->put('/ofertas/:oferta', 'OfertaController@update');
$router->delete('/ofertas/:oferta', 'OfertaController@destroy');

$router->get('/pedidos', 'PedidoController@index'); //admin
$router->get('/ventas', 'PedidoController@venta');
$router->get('/ventas/:pedido', 'PedidoController@show');


$router->put('/pedidos/:pedido', 'PedidoController@update'); //admin




// ?

$router->get('/reservas', 'ReservaController@index'); //admin
$router->get('/createreserva', 'ReservaController@create');
$router->get('/storereserva', 'ReservaController@store');
$router->get('/editreserva', 'ReservaController@edit');
$router->get('/updatereserva', 'ReservaController@update');
$router->get('/destroyreserva', 'ReservaController@destroy');

$router->get('/reservas/:reserva', 'ReservaController@show'); //admin
$router->get('/imprimirreserva', 'ReservaController@imprimir');



$router->get('/editpedido', 'PedidoController@edit');
$router->get('/imprimirpedido', 'PedidoController@imprimir');
$router->get('/pedidos/:pedido', 'PedidoController@show'); //admin








// ------------------------------------------------------


$router->get('/users', 'UserController@index');
$router->get('/user/:userId', 'UserController@show');
$router->get('/user/create', 'UserController@create');
$router->post('/user', 'UserController@store');
$router->get('/user/:userId/edit', 'UserController@edit');
$router->put('/user/:userId', 'UserController@update');
$router->delete('/user/:userId', 'UserController@destroy');

// ------------------------------------------------------



// Run the router
$router->run();
