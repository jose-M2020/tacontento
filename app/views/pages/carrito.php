<?php
require_once 'app/views/components/header.php';
require_once 'app/controller/PedidoController.php';

if(!isset($_SESSION)){ 
    session_start(); 
}  

if (isset($_SESSION['add_carro'])) {
    $d = $_SESSION['add_carro'];
} else { }
?>

<?php 
    include "./app/views/components/hero.php";
    echo createHero('Carrito de compras', 'menu.jpg');
?>

<section class="container" style="min-height: 60vh">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th width="10%">id producto</th>
                <th width="40%">Descripción</th>
                <th width="20%">precio</th>
                <th width="15%">cantidad</th>
                <th width="15%">total</th>
                <th width="10%">id_cliente</th>
                <th width="10%">Action</th>
              
            </tr>
            <?php
            if (!empty($_SESSION["add_carro"])) {
                $total = 0;
                $des = "";
                $cantidad = "";
                foreach ($_SESSION["add_carro"] as $keys => $values) {
                    ?>
                    <tr>
                        <td><?php echo $values["id"]; ?></td>
                        <td><?php echo $values["descripcion"]; ?></td>
                        <td>$ <?php echo $values["precio"]; ?></td>
                        <td> <?php echo $values["cantidad"]; ?></td>
                        <td>$ <?php echo $values["total"]; ?></td>
                        <td> <?php echo $values["id_cliente"]; ?></td>
                        <td>
                            <form style="display: inline;" method="POST" action="index.php?page=deletecarrito&id=<?php echo $values["id"] ?>">
                                <button type="submit" class=" btn btn-outline-danger btn-sm" value="delete" name="delete">Remover</button>
                                <button>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php
                    $total = $total + $values["total"];
                    $des.= $values["id"].",";
                    $cantidad.= $values["cantidad"].",";
                }
                ?>
                <tr>
                    <td colspan="4 align="right">Total</td>
                    <td colspan="2" align="right">$<?php echo number_format($total, 2); ?></td>
                    <td>
                   
                        <form method="POST" action="index.php?page=pay">
                            <input type="hidden" name="descripcion" readonly value="<?php echo $des?>">
                            <input type="hidden" name="total" readonly value="<?php echo number_format($total, 2);?>">
                            <input type="hidden" name="id_cliente" readonly value="<?php echo $values["id_cliente"];?>">
                            <input type="hidden" name="cantidad" readonly value="<?php echo $cantidad?>">
                         
                             <button name="registrar" value="registrar" class="btn btn-primary">Pagar</button>
                        </form>
                    </td>
                </tr>
            <?php

            } else {
                ?>
                <tr>
                    <td colspan="7" style="color: red" align="center"><strong>No hay Producto Agregado!</strong></td>
                </tr>
            <?php
            }
            ?>
        </table>


    </div>
</section>




<?php
require_once 'app/views/components/footer.php';
?>