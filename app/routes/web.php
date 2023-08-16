<?php
// Include the necessary controllers and the router
require_once 'Router.php';

// Create the router instance
$router = new Router();


/*
 *  MAIN PAGES
 */

$router->get('/home', 'IndexController@home');
$router->get('/menu', 'IndexController@menu');
$router->get('/services', 'IndexController@services');
$router->get('/about', 'IndexController@about');

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
$router->get('/addcarrito', 'CarritoController@store');
$router->get('/deletecarrito', 'CarritoController@destroy');

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

$router->get('/usuario', 'UsuariosController@index');
$router->get('/createusuario', 'UsuariosController@create');
$router->get('/storeusuario', 'UsuariosController@store');
$router->get('/updateusuario', 'UsuariosController@update');
$router->get('/editusuario', 'UsuariosController@edit');
$router->get('/destroyusuario', 'UsuariosController@destroy');

$router->get('/articulo', 'ArticuloController@index');
$router->get('/createarticulo', 'ArticuloController@create');
$router->get('/storearticulo', 'ArticuloController@store');
$router->get('/updatearticulo', 'ArticuloController@update');
$router->get('/editarticulo', 'ArticuloController@edit');
$router->get('/destroyarticulo', 'ArticuloController@destroy');

$router->get('/dashboard', 'OfertaController@index');
$router->get('/createoferta', 'OfertaController@create');
$router->get('/storeoferta', 'OfertaController@store');
$router->get('/editoferta', 'OfertaController@edit');
$router->get('/updateoferta', 'OfertaController@update');
$router->get('/destroyoferta', 'OfertaController@destroy');

$router->get('/pedido', 'PedidoController@index');
$router->get('/venta', 'PedidoController@venta');


$router->get('/storepedido', 'PedidoController@update');




// ?

$router->get('/reservas', 'ReservaController@index');
$router->get('/createreserva', 'ReservaController@create');
$router->get('/storereserva', 'ReservaController@store');
$router->get('/editreserva', 'ReservaController@edit');
$router->get('/updatereserva', 'ReservaController@update');
$router->get('/destroyreserva', 'ReservaController@destroy');

$router->get('/showreserva', 'ReservaController@show');
$router->get('/imprimirreserva', 'ReservaController@imprimir');



$router->get('/editpedido', 'PedidoController@edit');
$router->get('/imprimirpedido', 'PedidoController@imprimir');
$router->get('/showpedido', 'PedidoController@show');








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
