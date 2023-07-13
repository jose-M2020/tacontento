<?php
require_once 'views/header.php';
require_once 'controller/ArticuloController.php';

?>

<br>
<section>
  <div class="container">
    <div class="heading">
      <br>
      <br>
      <h2> Bienvenidos a Nuestro Menú</h2>
    </div>
    <?php
    $articulo = new ArticuloController;
    $articulos = $articulo->obtener();
    ?>
    <?php if (isset($articulos)) : ?>
      <div class="row">
        <div class="col-sm-12">
          <ul class="selecton brdr-b-primary mb-70">
            <li><a class="active" href="#" data-select="*"><b>ALL</b></a></li>
            <li><a href="#" data-select="desayuno"><b>DESAYUNOS</b></a></li>
            <li><a href="#" data-select="comidas"><b>COMIDAS</b></a></li>
            <li><a href="#" data-select="cena"><b>CENAS</b></a></li>
          </ul>
        </div>
        <!--col-sm-12-->
        <?php foreach ($articulos as $a) : ?>
          <div class="col-md-6 food-menu <?php echo $a['tipo'] ?>">
            <div class="sided-90x mb-30 ">
              <div class="s-left"><img class="br-3" src="storage/<?php echo $a['img'] ?>" alt="Menu Image"></div>
              <!--s-left-->
              <div class="s-right">
                <h5 class="mb-10"><b> <?php echo $a['nombre'] ?></b><b class="color-primary float-right">$<?php echo $a['precio'] ?></b></h5>
                <p class="pe-70"><?php echo $a['descripcion'] ?> </p>
                <br>
                
                <form style="display: inline;" method="POST" action="index.php?page=addcarrito&id=<?php echo $a['id'] ?>">

                <input type="number"  min="1" pattern="^[0-9]+" name="cant" required placeholder="Cantidad">
                <button type="submit" class=" btn btn-outline-success btn-sm" name="agregar">Agregar al carrito</button>
              </form>
              </div>
              
              <!--s-right-->
            </div><!-- sided-90x -->
          </div><!-- food-menu -->
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
  <!--row-->
  </div><!-- container -->
</section>


<?php
require_once 'views/footer.php';
?>