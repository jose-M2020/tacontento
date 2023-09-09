
<?php 
  require_once 'app/config/config.php';

  use Core\Http\Request;

  $request = new Request();

  $title = $this->getSection('title') ? ($this->getSection('title') . ' - ') : '';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="<?= $request->getFullRoute('/images/taco.png') ?>">
  <title><?= $title ?>Admin Ta'Contento</title>
  <!-- Google Font -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Concert+One&family=Dosis:wght@400;600;800&display=swap" rel="stylesheet">
  <!-- Libraries Stylesheet -->
  <link href="<?= $request->getFullRoute('/public/plugin-frameworks/animate/animate.min.css') ?>" rel="stylesheet">
  
  <link href="<?= $request->getFullRoute('/public/plugin-frameworks/bootstrap/bootstrap.min.css') ?>" rel="stylesheet">
  <link href="<?= $request->getFullRoute('/public/plugin-frameworks/swiper.css') ?>" rel="stylesheet">
  <link href="<?= $request->getFullRoute('/public/fonts/ionicons.css') ?>" rel="stylesheet">
  <link href="<?= $request->getFullRoute('/public/common/css/admin.css') ?>" rel="stylesheet">
  <!-- <link href="<?= $request->getFullRoute('/public/fonts/all.min.css') ?>" rel="stylesheet"> -->
  <script src="<?= $request->getFullRoute('/public/common/all.min.js') ?>"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <?php require_once('components/sidebar.php') ?>

    <!-- <span style="color: #fff">
      <i class="fas fa-bars"></i>
    </span> -->
  <main class="contenedor">
    <?php require_once('components/navbar.php') ?>
    <?php require_once('./app/views/components/message.php') ?>
    <div class="plr-sm-0 p-30">
      <?= $this->getSection('content'); ?>
    </div>
  </main>

  <?php require_once('components/footer.php') ?>
  <?= $this->getSection('scripts'); ?>
</body>
</html>