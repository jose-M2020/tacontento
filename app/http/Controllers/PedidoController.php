<?php
namespace App\Http\Controllers;

require_once 'app/config/config.php';

use DateTime;
use Exception;

use App\Models\Pedido;
use App\Models\PedidoArticulo;
use App\Models\Articulo;
use App\Models\Carrito;
use App\Utilities\Request;
use App\Utilities\Utilidades;

class PedidoController
{
    function __construct()
    {
        if(!isset($_SESSION)){ 
            session_start(); 
        }  
    }

    public function index()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: '. BASE_URL .'/home');
        }
        #inicializando los valores
        $pedido = new Pedido;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 5;
        $search = "";
        $status = 1;
        #asignando el inicio de de los articulos a paginar
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        #asignando la busqueda si existe
        if (isset($_GET['search'])) $search =  $_GET['search'];

        $section = $pedido->paginationpedido($search);
        $pedido = $pedido->indexpedido($status, $search, $startOfPaging, $amountOfThePaging);


        require_once('./app/views/pedidos/index.php');
    }
    public function venta()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: '. BASE_URL .'/home');
        }
        #inicializando los valores
        $pedido = new Pedido;
        $utilities = new Utilidades();
        $startOfPaging = 0;
        $amountOfThePaging = 8;
        $search = "";
        $status = 2;
        #asignando el inicio de de los articulos a paginar
        if (isset($_GET['p'])) $startOfPaging = $utilities->pagination($_GET['p'], $amountOfThePaging);
        #asignando la busqueda si existe
        if (isset($_GET['search'])) $search = str_replace('-', '', $_GET['search']);;

        $section = $pedido->paginationventa($search);
        $pedido = $pedido->indexpedido($status, $search, $startOfPaging, $amountOfThePaging);


        require_once('./app/views/pedidos/ventas.php');
    }

    public function create()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: '. BASE_URL .'/home');
        }
        require_once('./app/views/articulos/create.php');
    }
    public function pay()
    {
        $request = new Request();

        $datos = array(
            'descripcion' => $request->input('descripcion'),
            'cantidad' => $request->input('cantidad'),
            'total' => $request->input('total'),
            'id_cliente' => $request->input('id_cliente'),
        );

        require_once('./app/views/pedidos/pay.php');
    }

    public function store($data)
    {   
        $carritoModel = new Carrito;
        $fecha = new  DateTime('now');

        $idUsuario = $_SESSION['cliente']['id'];
        $data['fecha'] = $fecha->format('Y-m-d');
        $userCart = $carritoModel->indexCarrito($idUsuario, null, null);
        $pedidoItems = [];

        $PedidoModel = new Pedido();
        $PedidoArticuloModel = new PedidoArticulo();
        $pedidoStored = $PedidoModel->storepedido($data);
        
        // Add pedido items information

        $articulo = new Articulo();

        foreach ($userCart as $key => $item) {
          $infoItem = $articulo->editarticulo($item['id_articulo']);
          $userCart[$key]['item'] = $infoItem;
        }

        // Set and store the pedido items data
        
        foreach ($userCart as $item) {
            array_push($pedidoItems, [
                'id_pedido' => $pedidoStored['id'],
                'id_articulo' => $item['id_articulo'],
                'cantidad' => $item['cantidad'],
                'precio' => $item['item']['precio'],
            ]);
        }

        $PedidoArticuloModel->storeArticulos($pedidoItems);

        
        
        // unset($_SESSION['add_carro']);
        
        // $lastid = $create->obtenerid();
        // require_once 'app/views/pages/message.php';
    }


    public function edit()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: '. BASE_URL .'/home');
        }
        $id = $_GET['id'];
        $articulo = new Articulo();
        $articulo = $articulo->editarticulo($id);

        require_once('./app/views/articulos/edit.php');
    }

    public function update()
    {
        if (!isset($_SESSION['usuario'])) {
            header('Location: '. BASE_URL .'/home');
        }

        $request = new Request();
        $datos = [
            'id' => $request->input('id'),
            'status' => 2
        ];
        $pedido = new Pedido;
        $pedido = $pedido->updatepedido($datos);

        if ($pedido) {
            header('Location: '. BASE_URL .'/pedido');
        }
    }
    public function imprimir_cliente($id)
    {

        $pedido = new Pedido();
        $p = $pedido->ticket($id);

        $array = explode(",", $p['descripcion']);
        $dd = array_pop($array);
        $articulos = [];
        for ($i = 0; $i < count($array); $i++) {
            $art = $pedido->getarticulos($array[$i]);
            $articulos[$i] = $art;
        }

        $cantidad = explode(",", $p['cantidad']);
        $dd = array_pop($cantidad);
        $limite = count($array);

      
    }
    public function imprimir()
    {
        $id = $_GET['id'];

        $pedido = new Pedido();
        $p = $pedido->ticket($id);

        $array = explode(",", $p['descripcion']);
        $dd = array_pop($array);
        $articulos = [];
        for ($i = 0; $i < count($array); $i++) {
            $art = $pedido->getarticulos($array[$i]);
            $articulos[$i] = $art;
        }

        $cantidad = explode(",", $p['cantidad']);
        $dd = array_pop($cantidad);
        $limite = count($array);

        require_once 'app/views/pedidos/ticket.php';
    }
    public function show()
    {
        $id = $_GET['id'];

        $pedidoModel = new Pedido();
        $pedido = $pedidoModel->ticket($id);

        $res = $pedidoModel->getItems($pedido['id']);
        
        $pedido['articulos'] = $res;

        // $array = explode(",", $p['descripcion']);
        // $dd = array_pop($array);
        // $articulos = [];


        // for ($i = 0; $i < count($array); $i++) {
        //     $art = $pedido->getarticulos($array[$i]);
        //     $articulos[$i] = $art;
        // }

        // $cantidad = explode(",", $p['cantidad']);
        // $dd = array_pop($cantidad);
        // $limite = count($array);

        require_once 'app/views/pedidos/show.php';
    }


    public function addcarrito()
    {
        if (!isset($_SESSION['cliente'])) {
            header('Location: '. BASE_URL .'/auth');
        } else {
            $id = $_GET['id'];
            $cantidad = $_POST['cant'];
            $id_cliente = $_SESSION['cliente']['id'];
            $articulo = new Articulo();
            $articulo = $articulo->editarticulo($id);
            $total = $cantidad * $articulo['precio'];

            if (isset($_POST['agregar'])) {
                if (isset($_SESSION['add_carro'])) {
                    $item_array_id_cart = array_column($_SESSION['add_carro'], 'id');
                    if (!in_array($_GET['id'], $item_array_id_cart)) {

                        $count = count($_SESSION['add_carro']);
                        $item_array = array(
                            'id'        => $_GET['id'],
                            'descripcion'    => $articulo['nombre'],
                            'precio'    => $articulo['precio'],
                            'cantidad'  =>  $cantidad,
                            'total'  =>  $total,
                            'id_cliente'  =>  $id_cliente,
                        );

                        $_SESSION['add_carro'][$count] = $item_array;
                        header('Location: '. BASE_URL .'/carrito');
                    } else {
                        echo '<script>alert("El Producto ya existe!");</script>';
                        require_once 'app/views/pages/home.php';
                    }
                } else {
                    $item_array = array(
                        'id'        => $_GET['id'],
                        'descripcion'    => $articulo['nombre'],
                        'precio'    => $articulo['precio'],
                        'cantidad'  =>  $cantidad,
                        'total'  =>  $total,
                        'id_cliente'  =>  $id_cliente,
                    );

                    $_SESSION['add_carro'][0] = $item_array;
                    header('Location: '. BASE_URL .'/carrito');
                }
            }
        }
    }
    public function deletecarrito()
    {

        if (isset($_POST['delete'])) {
            if ($_POST['delete'] == 'delete') {
                foreach ($_SESSION['add_carro'] as $key => $value) {
                    if ($value['id'] == $_GET['id']) {
                        unset($_SESSION['add_carro'][$key]);
                        header('Location: '. BASE_URL .'/carrito');
                    }
                }
            }
        } else {
            header('Location: '. BASE_URL .'/carrito');
        }
    }
    public function compras(){
        if (!isset($_SESSION['cliente'])) {
            header('Location: '. BASE_URL .'/home');
        }else{
            $id_cliente = $_SESSION['cliente']['id'];
            $compras = new Pedido();
            $compras = $compras->getcompras($id_cliente);
            require_once 'app/views/pages/compras.php';
        }
    }

    public function payment_init() {
        // Include the Stripe PHP library 
        require_once 'lib/stripe-php/init.php'; 
        
        // Set API key 
        $stripe = new \Stripe\StripeClient(STRIPE_API_KEY); 
        
        $response = array( 
            'status' => 0, 
            'error' => array( 
                'message' => 'Invalid Request!'    
            ) 
        ); 
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
            $input = file_get_contents('php://input'); 
            $request = json_decode($input);     
        } 
        
        if (json_last_error() !== JSON_ERROR_NONE) { 
            http_response_code(400); 
            echo json_encode($response); 
            exit;  
        } 
        
        if(!empty($request->createCheckoutSession)){
            $userId = $_SESSION['cliente']['id'];
            $carritoModel = new Carrito;
            $articuloModel = new Articulo;
            $userCart = $carritoModel->indexCarrito($userId, null, null);

            $stripe_items = [];

            foreach ($userCart as $key => $item) {
              $infoItem = $articuloModel->editarticulo($item['id_articulo']);

              $stripeAmount = round($infoItem['precio']*100, 2); 

              array_push($stripe_items, [
                'price_data' => [ 
                    'product_data' => [ 
                        'name' => $infoItem['nombre'], 
                        'metadata' => [ 
                            'pro_id' => $infoItem['id'] ,
                            'pro' => 'dsd' 
                        ]
                    ],
                    'unit_amount' => $stripeAmount, 
                    'currency' => $currency, 
                ], 
                'quantity' => $item['cantidad']
              ]);
            }

            // Create new Checkout Session for the order 
            try {
                $checkout_session = $stripe->checkout->sessions->create([ 
                    // 'shipping_options' => [[
                    //   'shipping_rate_data' => [
                    //     'display_name' => 'DHL',
                    //     'type' => 'fixed_amount',
                    //     'delivery_estimate' => [
                    //         'maximum' => 5,
                    //         'minimum' => 2,
                    //     ],
                    //     'fixed_amount' => [
                    //         'amount' => 250,
                    //         'currency' => $currency,
                    //     ],
                    //   ],
                    // ]],
                    'line_items' => $stripe_items, 
                    'mode' => 'payment', 
                    'success_url' => STRIPE_SUCCESS_URL.'&session_id={CHECKOUT_SESSION_ID}', 
                    'cancel_url' => STRIPE_CANCEL_URL, 
                ]); 
            } catch(Exception $e) {  
                $api_error = $e->getMessage();  
            } 
            
            if(empty($api_error) && $checkout_session){ 
                $response = array( 
                    'status' => 1, 
                    'message' => 'Checkout Session created successfully!', 
                    'sessionId' => $checkout_session->id 
                ); 
            }else{ 
                $response = array( 
                    'status' => 0, 
                    'error' => array( 
                        'message' => 'Checkout Session creation failed! '.$api_error    
                    ) 
                ); 
            } 
        } 

        echo json_encode($response); 
    }

    public function payment_success() {
        if(empty($_GET['session_id'])){
          return header('Location: '. BASE_URL .'/home');
        }
        
        $pedido = new Pedido;
        $carritoModel = new Carrito;
        $idUsuario = $_SESSION['cliente']['id'];
        $session_id = $_GET['session_id']; 

        $pedidoExist = $pedido->checkByStripeSession($session_id);

        if($pedidoExist) {
            // echo "El pedido ya ha sido registrado.";
        } else {
            require_once 'lib/stripe-php/init.php';
            require_once 'app/config/config.php';

            $stripe = new \Stripe\StripeClient(STRIPE_API_KEY); 

            // Fetch the Checkout Session to display the JSON result on the success page 
            try { 
                $checkout_session = $stripe->checkout->sessions->retrieve($session_id, ['expand' => ['line_items']]); 
            } catch(Exception $e) {  
                $api_error = $e->getMessage();  
            }

            if(empty($api_error) && $checkout_session){ 
                // Get customer details 
                $customer_details = $checkout_session->customer_details; 
                
                // TODO: Get the product metadata
                // $line_items = $checkout_session->line_items;
                // foreach ($line_items->data as $item) {
                //     echo '<pre>';
                //     print_r($item);
                //     echo '</pre>';
                // }
     
                // Retrieve the details of a PaymentIntent 
                try { 
                    $paymentIntent = $stripe->paymentIntents->retrieve($checkout_session->payment_intent); 
                } catch (\Stripe\Exception\ApiErrorException $e) { 
                    $api_error = $e->getMessage(); 
                }
                 
                if(empty($api_error) && $paymentIntent){ 
                    // Check whether the payment was successful 
                    if(!empty($paymentIntent) && $paymentIntent->status == 'succeeded'){ 
                        // Transaction details  
                        $transactionID = $paymentIntent->id; 
                        $paidAmount = $paymentIntent->amount; 
                        $paidAmount = ($paidAmount/100); 
                        $paidCurrency = $paymentIntent->currency; 
                        $payment_status = $paymentIntent->status; 
                         
                        // Customer info 
                        $customer_name = $customer_email = ''; 
                        if(!empty($customer_details)){ 
                            $customer_name = !empty($customer_details->name)?$customer_details->name:''; 
                            $customer_email = !empty($customer_details->email)?$customer_details->email:''; 
                        } 


                        // Check if any transaction data is exists already with the same TXN ID 
                        // $sqlQ = "SELECT id FROM transactions WHERE txn_id = ?"; 
                        // $stmt = $db->prepare($sqlQ);  
                        // $stmt->bind_param("s", $transactionID); 
                        // $stmt->execute(); 
                        // $result = $stmt->get_result(); 
                        // $prevRow = $result->fetch_assoc(); 
                         
                        // if(!empty($prevRow)){ 
                        //     $payment_id = $prevRow['id']; 
                        // }else{ 
                        //     // Insert transaction data into the database 
                        //     $sqlQ = "INSERT INTO transactions (customer_name,customer_email,item_name,item_number,item_price,item_price_currency,paid_amount,paid_amount_currency,txn_id,payment_status,stripe_checkout_session_id,created,modified) VALUES (?,?,?,?,?,?,?,?,?,?,?,NOW(),NOW())"; 
                        //     $stmt = $db->prepare($sqlQ); 
                        //     $stmt->bind_param("ssssdsdssss", $customer_name, $customer_email, $productName, $productID, $productPrice, $currency, $paidAmount, $paidCurrency, $transactionID, $payment_status, $session_id); 
                        //     $insert = $stmt->execute(); 
                             
                        //     if($insert){ 
                        //         $payment_id = $stmt->insert_id; 
                        //     } 
                        // } 

                        $data = array(
                            'total' => $paidAmount,
                            'id_cliente' => $idUsuario,
                            'status' => 1,
                            'session_id' => $session_id,
                        );

                        $this->store($data);

                        // Update Cart
                        $carritoModel->destroyByUser($idUsuario);
                        $_SESSION['cliente']['cartNum'] = 0;
                         
                        $status = 'success'; 
                        $statusMsg = 'Su pago ha sido exitoso!'; 
                    }else{ 
                        $statusMsg = "La transacción ha fallado!"; 
                    } 
                }else{ 
                    $statusMsg = "No se pueden obtener los detalles de la transacción! $api_error";  
                } 
            }else{ 
                $statusMsg = "Transacción inválida! $api_error";  
            } 
        }

        require_once 'app/views/pedidos/payments/success.php';
    }
    
    public function payment_cancel() {
      require_once 'app/views/pedidos/payments/cancel.php';
    }
}
