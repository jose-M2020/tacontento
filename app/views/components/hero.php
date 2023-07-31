<?php function createHero($title, $bgImagen) { ?>
  <div class="py-5 bg-dark hero-header mb-5" style="background: linear-gradient(rgba(10, 26, 41, .9), rgba(47, 84, 118, .9)), url(images/hero-header/<?php echo $bgImagen ?>)">
      <div class="container text-center pt-5 pb-4">
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