<?php session_start(); ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <pre>
      <?php
        echo print_r($_SESSION["cart"]);
       ?>
    </pre>
  </body>
</html>
