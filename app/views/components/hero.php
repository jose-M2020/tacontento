<?php
  use Core\Http\Request;
  $request = new Request();
?>

<?php $createHero = function($title, $bgImagen) use($request) { ?>
  <div class="bg-dark header mb-5" style="background: linear-gradient(rgba(10, 26, 41, .9), rgba(47, 84, 118, .9)), url(<?= $request->getFullRoute('/images/hero-header/'.$bgImagen) ?>)">
      <div class="container text-center px-2">
          <h1 class="display-4 text-white mb-3 animated slideInDown"><?php echo $title ?></h1>
          <!-- <nav aria-label="breadcrumb">
              <ol class="breadcrumb justify-content-center text-uppercase">
                  <li class="breadcrumb-item faded-text"><a href="#">Home</a></li>
                  <li class="breadcrumb-item faded-text"><a href="#">Pages</a></li>
                  <li class="breadcrumb-item text-white active" aria-current="page">Menu</li>
              </ol>
          </nav> -->
      </div>
  </div>
<?php } ?>