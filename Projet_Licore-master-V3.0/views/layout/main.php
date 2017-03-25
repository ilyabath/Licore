<!DOCTYPE html>

<html>

  <head>
    <meta charset="utf-8"/>
    <title>Projet Licore -
      <?= $titre ?></title>
    <link href="./dist/bootstrap.min.css" rel="stylesheet"/>
    <link href="./dist/style.css" rel="stylesheet"/>
  </head>

  <body>

    <?php include('navbar-top.php'); ?>

    <div class="container">
      <div class="row">
        <?= $contenu ?>
      </div>
    </div>

    <?php include('scripts.php'); ?>
    <?php include('footer.php'); ?>



  </body>
</html>
