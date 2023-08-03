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
  <?php if (!empty($carrito)) : ?>
    <div class="row">
        <div class="col-md-8">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="40%">Platillo</th>
                        <th width="15%">Cantidad</th>
                        <th width="15%">Total</th>
                        <th width="10%">Action</th>
                    </tr>
                    <?php
                        $total = 0;
                        $des = "";
                        $cantidad = "";
                        foreach ($carrito as $item) {
                            ?>
                            <tr>
                                <td colspan="1">
                                  <span class="fw-bold font-12 d-block mb-2">
                                    <?php echo $item['item']['nombre'] ?> - 
                                    $<?php echo $item['item']['precio'] ?>
                                  </span>
                                  <?php echo $item['detalles'] ?>
                                </td>
                                <td><?php echo $item['cantidad'] ?></td>
                                <td>$<?php echo ($item['item']['precio'] * $item['cantidad']) ?></td>
        
                                <td>
                                    <form style="display: inline;" method="POST" action="index.php?page=deletecarrito&id=<?php echo $values["id"] ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-sm" value="delete" name="delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        <button>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                            // $total = $total + $values["total"];
                            // $des.= $values["id"].",";
                            // $cantidad.= $values["cantidad"].",";
                        }
                    ?>
                </table>
            </div>
        </div>
        <div class="col-md-4">
            <div>
                <p>Total</p>
                <p>$<?php echo number_format($total, 2); ?></p>
                <div>
                
                    <form method="POST" action="index.php?page=pay">
                        <input type="hidden" name="descripcion" readonly value="<?php echo $des?>">
                        <input type="hidden" name="total" readonly value="<?php echo number_format($total, 2);?>">
                        <input type="hidden" name="id_cliente" readonly value="<?php echo $values["id_cliente"];?>">
                        <input type="hidden" name="cantidad" readonly value="<?php echo $cantidad?>">
                        <button name="registrar" value="registrar" class="btn btn-primary">Pagar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
  <?php else: ?>
    <div class="text-center">
      <i class="fa-solid fa-cart-shopping font-40 mb-20"></i>
      <p class="mb-20 font-20"><strong>¡Tu carrito esta vació!</strong></p>
      <a class="btn btn-primary" href="index.php?page=menu">Agregar platillos</a>
    </div>
  <?php endif; ?>
</section>




<?php
require_once 'app/views/components/footer.php';
?>