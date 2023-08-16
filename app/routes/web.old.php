<?php
ob_start();

$page = $_GET['page'];

if (!empty($page)) {

  $router = array(
    #Auth
    'auth' => array('model' => 'Usuario', 'view' => 'auth', 'controller' => 'AuthController'),
    'login' => array('model' => 'Usuario', 'view' => 'login', 'controller' => 'AuthController'),
    'register' => array('model' => 'Usuario', 'view' => 'register', 'controller' => 'AuthController'),
    #index de la pagina
    // 'index' => array('model' => 'Index', 'view' => 'index', 'controller' => 'IndexController'),
    'pay' => array('model' => 'Index', 'view' => 'pay', 'controller' => 'PedidoController'),
    'carrito' => array('model' => 'Carrito', 'view' => 'index', 'controller' => 'CarritoController'),
    'home' => array('model' => 'Index', 'view' => 'home', 'controller' => 'IndexController'),
    'menu' => array('model' => 'Index', 'view' => 'menu', 'controller' => 'IndexController'),
    'compras' => array('model' => 'Pedido', 'view' => 'compras', 'controller' => 'PedidoController'),
    'services' => array('model' => 'Index', 'view' => 'services', 'controller' => 'IndexController'),
    'about' => array('model' => 'Index', 'view' => 'about', 'controller' => 'IndexController'),
    'logout' => array('model' => 'Index', 'view' => 'logout', 'controller' => 'IndexController'),
    /////////////////////////////////////////////////////////////
    #index usuarios
    'usuario' => array('model' => 'Usuario', 'view' => 'index', 'controller' => 'UsuariosController'),
    # vista Crear un usuario
    'createusuario' => array('model' => 'Usuario', 'view' => 'create', 'controller' => 'UsuariosController'),
    'storeusuario' => array('model' => 'Usuario', 'view' => 'store', 'controller' => 'UsuariosController'),
    'updateusuario' => array('model' => 'Usuario', 'view' => 'update', 'controller' => 'UsuariosController'),
    #modificar usaurio
    'editusuario' => array('model' => 'Usuario', 'view' => 'edit', 'controller' => 'UsuariosController'),
    'destroyusuario' => array('model' => 'Usuario', 'view' => 'destroy', 'controller' => 'UsuariosController'),
    /////////////////////////////////////////////////////////////
    #articulo 
    'pedido' => array('model' => 'Pedido', 'view' => 'index', 'controller' => 'PedidoController'),
    'venta' => array('model' => 'Pedido', 'view' => 'venta', 'controller' => 'PedidoController'),
    # vista Crear un usuario
    'createpedido' => array('model' => 'Pedido', 'view' => 'create', 'controller' => 'PedidoController'),
    'storepedido' => array('model' => 'Pedido', 'view' => 'store', 'controller' => 'PedidoController'),
    'updatepedido' => array('model' => 'Pedido', 'view' => 'update', 'controller' => 'PedidoController'),
    'payment-init' => array('model' => 'Pedido', 'view' => 'payment_init', 'controller' => 'PedidoController'),
    'payment-success' => array('model' => 'Pedido', 'view' => 'payment_success', 'controller' => 'PedidoController'),
    'payment-cancel' => array('model' => 'Pedido', 'view' => 'payment_cancel', 'controller' => 'PedidoController'),
    #modificar usaurio
    'editpedido' => array('model' => 'Pedido', 'view' => 'edit', 'controller' => 'PedidoController'),
    'imprimirpedido' => array('model' => 'Pedido', 'view' => 'imprimir', 'controller' => 'PedidoController'),
    'showpedido' => array('model' => 'Pedido', 'view' => 'show', 'controller' => 'PedidoController'),
    /////////////////////////////////////////////////////////////
    #articulo 
    'articulo' => array('model' => 'Usuario', 'view' => 'index', 'controller' => 'ArticuloController'),
    # vista Crear un usuario
    'createarticulo' => array('model' => 'Articulo', 'view' => 'create', 'controller' => 'ArticuloController'),
    'storearticulo' => array('model' => 'Articulo', 'view' => 'store', 'controller' => 'ArticuloController'),
    'updatearticulo' => array('model' => 'Articulo', 'view' => 'update', 'controller' => 'ArticuloController'),
    #modificar usaurio
    'editarticulo' => array('model' => 'Articulo', 'view' => 'edit', 'controller' => 'ArticuloController'),
    'destroyarticulo' => array('model' => 'Articulo', 'view' => 'destroy', 'controller' => 'ArticuloController'),
    /////////////////////////carrito de compras
    'addcarrito' => array('model' => 'Carrito', 'view' => 'store', 'controller' => 'CarritoController'),
    'deletecarrito' => array('model' => 'Carrito', 'view' => 'destroy', 'controller' => 'CarritoController'),
    ////////////////////////////////////
    'dashboard' => array('model' => 'Index', 'view' => 'index', 'controller' => 'OfertaController'),
    'createoferta' => array('model' => 'Oferta', 'view' => 'create', 'controller' => 'OfertaController'),
    'storeoferta' => array('model' => 'Oferta', 'view' => 'store', 'controller' => 'OfertaController'),
    'editoferta' => array('model' => 'Oferta', 'view' => 'edit', 'controller' => 'OfertaController'),
    'updateoferta' => array('model' => 'Oferta', 'view' => 'update', 'controller' => 'OfertaController'),
    'destroyoferta' => array('model' => 'Oferta', 'view' => 'destroy', 'controller' => 'OfertaController'),
    ////////////////////////////////////
    'reservas' => array('model' => 'Reserva', 'view' => 'index', 'controller' => 'ReservaController'),
    'createreserva' => array('model' => 'Reserva', 'view' => 'create', 'controller' => 'ReservaController'),
    'storereserva' => array('model' => 'Reserva', 'view' => 'store', 'controller' => 'ReservaController'),
    'editreserva' => array('model' => 'Reserva', 'view' => 'edit', 'controller' => 'ReservaController'),
    'updatereserva' => array('model' => 'Reserva', 'view' => 'update', 'controller' => 'ReservaController'),
    'destroyreserva' => array('model' => 'Reserva', 'view' => 'destroy', 'controller' => 'ReservaController'),
    'showreserva' => array('model' => 'Reserva', 'view' => 'show', 'controller' => 'ReservaController'),
    'imprimirreserva' => array('model' => 'Reserva', 'view' => 'imprimir', 'controller' => 'ReservaController'),
  );

  foreach ($router as $key => $components) {
    if ($page == $key) {
      $model = $components['model'];
      $view = $components['view'];
      $controller = $components['controller'];
      break;
    }
  }

  if (isset($model)) {
    require_once 'app/controller/' . $controller . '.php';
    $objeto = new $controller();
    $objeto->$view();
  }
} else {
  header('Location: index.php?page=home');
}

ob_end_flush();