<?php
require_once 'ModeloBase.php';
require_once 'app/utilidades/Utilidades.php';

class Pedido extends ModeloBase
{

    public function __construct()
    {
        parent::__construct();
    }

    public function indexpedido($status, $search, $startOfPaging, $amountOfThePaging)
    {
        $db = new ModeloBase();
        if (empty($search)) {
            $sql = "SELECT * FROM pedidos where status  = $status  ORDER BY fecha DESC LIMIT $startOfPaging ,$amountOfThePaging ";
        } else {
            $sql = "SELECT * FROM pedidos WHERE status = $status AND fecha = $search ORDER BY fecha LIMIT $startOfPaging,$amountOfThePaging";
        }
        return  $db->index($sql);
    }
    public function storepedido($datos)
    {
        $db = new ModeloBase();
        $insert = $db->store('pedidos', $datos);
        
        return $insert;
    }
    public function editarpedido($id)
    {
        $db = new ModeloBase();
        return $db->edit('pedidos', $id);
    }

    public function ticket($id)
    {
        $db = new ModeloBase();

        $sql = "SELECT
          pedidos.id,pedidos.fecha,pedidos.total,
          usuarios.nombre,usuarios.apellidos,usuarios.email,usuarios.telefono,usuarios.id as id_cliente
        --   JSON_ARRAYAGG(JSON_OBJECT('id', articulos.id, 'product_name', articulos.nombre, 'product_price', articulos.precio)) AS products
        
        FROM
          pedidos
        left JOIN 
          usuarios ON pedidos.id_cliente = usuarios.id
        
        -- LEFT JOIN
        --   pedidos_articulos ON pedidos.id = pedidos_articulos.id_pedido
        -- LEFT JOIN
        --   articulos ON pedidos_articulos.id_articulo = articulos.id

        Where
          pedidos.id = $id";

        return $db->show($sql);
    }

    public function getarticulos($id)
    {
        $db = new ModeloBase();

        $sql = "SELECT articulos.id,articulos.nombre,articulos.precio
        FROM articulos Where articulos.id = $id ";

        return $db->show($sql);
    }
    
    public function getItems($idPedido)
    {
        $db = new ModeloBase();
        $sql = "SELECT
          pedidos_articulos.cantidad, pedidos_articulos.precio,
          articulos.id, articulos.nombre, articulos.precio as precio_original
        FROM
          pedidos_articulos
        left JOIN
          articulos ON pedidos_articulos.id_articulo = articulos.id
        Where
         pedidos_articulos.id_pedido = $idPedido";

        return $db->index($sql);
    }

    public function destroypedido($id)
    {
        $db = new ModeloBase();
        $utilities = new Utilidades();
        $deleted = $db->destroy('pedidos', $id);

        $utilities->handleMessage($deleted, 'Pedido eliminado exitosamente!');
        return  $deleted;
    }
    public function updatepedido($datos)
    {
        $db = new ModeloBase();
        $utilities = new Utilidades();
        $sql = "UPDATE pedidos SET status=:status  WHERE id=:id;";
        $updated = $db->update($sql, $datos);

        $utilities->handleMessage($updated, 'Producto actualizado exitosamente!');
        return $updated;
    }
    public function paginationpedido($search)
    {

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM pedidos WHERE status = 1";

        if (!empty($search)) {
            $sql = "SELECT COUNT(fecha) FROM pedidos  WHERE fecha = $search and status = 1 ";
        }
        $number_of_rows = $db->pagination($sql);
        $section = ceil($number_of_rows / 8);

        return $section;
    }
    public function paginationventa($search)
    {

        $db = new ModeloBase();
        $sql = "SELECT COUNT(id) FROM pedidos WHERE status = 2;";

        if (!empty($search)) {
            $sql = "SELECT COUNT(fecha) FROM pedidos  WHERE fecha = $search AND status = 2 ";
        }
        $number_of_rows = $db->pagination($sql);
        $section = ceil($number_of_rows / 8);

        return $section;
    }
    public function obtener()
    {
        $db = new ModeloBase();

        $sql = "SELECT * FROM pedidos";

        return  $db->index($sql);
    }
    public function obtenerid()
    {
        $db = new ModeloBase();
        $sql = "SELECT MAX(id) FROM pedidos";
        return $db->show($sql);
    }
    public function getcompras($id)
    {
        $db = new ModeloBase();

        $sql = "SELECT * FROM pedidos where id_cliente = $id";

        return  $db->index($sql);
    }
    
    public function checkByStripeSession($session_id)
    {
        $db = new ModeloBase();
        $res = $db->recordExists('pedidos', ['session_id', '=', $session_id]);
        return  $res;
    }
}
