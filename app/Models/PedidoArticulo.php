<?php
namespace App\Models;

use App\Models\ModeloBase;

class PedidoArticulo extends ModeloBase
{

    public function __construct()
    {
        parent::__construct();
    }

    public function indexpedido($status, $search, $startOfPaging, $amountOfThePaging)
    {
        $db = new ModeloBase();
        
    }
    public function storeArticulos($datos)
    {
        $db = new ModeloBase();
        $insert = $db->storeMultiple('pedidos_articulos', $datos);
        
        return $insert;
    }

    public function getarticulos($id)
    {
        $db = new ModeloBase();

    }
}
