<?php
require_once 'app/views/components/header.php';
require_once 'app/views/components/hero.php';
require_once 'app/controller/PedidoController.php';

if(!isset($_SESSION)){ 
    session_start(); 
}  

$total = 0;

echo createNavbar();
echo createHero('Carrito de compras', 'menu.jpg');

?>

<section class="container" style="min-height: 60vh">
  <?php if (!empty($carrito)) : ?>
    <div class="row g-5">
        <div class="col-md-8 cart">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tr>
                        <th width="70%">Platillo</th>
                        <th width="15%">Cantidad</th>
                        <th width="15%">Total</th>
                        <!-- <th width="10%">Action</th> -->
                    </tr>
                    <?php
                        foreach ($carrito as $item) {
                          $totalPerItem = $item['item']['precio'] * $item['cantidad'];
                    ?>
                            <tr>
                                <td class="d-flex flex-column gap-3 position-relative" colspan="1">
                                  <div class="d-flex gap-2">
                                    <img src="storage/<?php echo $item['item']['img'] ?>" alt="Platillo" style="width: 70px; height: 70px; object-fit: cover;">
                                    <span class="fw-bold font-12 d-block mb-2">
                                      <?php echo $item['item']['nombre'] ?> - 
                                      $<?php echo $item['item']['precio'] ?>
                                    </span>
                                  </div>
                                  <?php if(!empty($item['detalles'])) : ?>
                                    <div class="shadow-sm p-10 mb-2 cart__item-detail">
                                      <p class="mb-1"><i class="fa-regular fa-clipboard font-12 me-1"></i> Indicaciones</p>
                                      <span><?php echo $item['detalles'] ?></span>
                                    </div>
                                  <?php endif; ?>
                                </td>
                                <td><?php echo $item['cantidad'] ?></td>
                                <td>$<?php echo $totalPerItem ?></td>
        
                                <td>
                                    <form style="display: inline;" method="POST" action="index.php?page=deletecarrito&id=<?php echo $item["id"] ?>">
                                        <button type="submit" class="btn btn-outline-danger btn-sm" value="delete" name="delete">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                        <button>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php
                        $total+=$totalPerItem;
                    } ?>
                </table>
            </div>
        </div>
        <div class="col-md-4 sticky-md-top">
            <div class="card shadow">
                <h4 class="card-header ptb-20">Resumen Del Pedido</h4>
                <div class="card-body">
                <div class="mb-15 d-flex justify-content-between">
                    <span>No. Platillos</span>
                    <span><?php echo count($carrito) ?></span>
                </div>
                <div class="mb-15 d-flex justify-content-between font-13 fw-bold">
                    <span>Total</span>
                    <span>$<?php echo number_format($total, 2); ?></span>
                </div>
                <div>
                    <a href="index.php?page=pay" value="registrar" class="btn btn-lg btn-primary w-100">Continuar compra</a>                
                </div>
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