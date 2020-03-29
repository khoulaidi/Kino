
<?php
  require_once("./Class/connection.php");

  $host = $_SERVER['HTTP_HOST'];
  $file = dirname("/Kino/config.php");
  $image_path = $host.$file."/images/";

  Connection::Connect();
 ?>
