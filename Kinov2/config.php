
<?php
  require_once("./Class/connection.php");

  $host = $_SERVER['HTTP_HOST'];
  $image_path = $host."/Kino/images/";


  $user = Connection::loginUser("zoubairbair@gmail.com","test");

  $true = true;
  if(!$true){
    //echo $user->getNachname();
    echo "True";
  }
  else {
    echo "False";
  }

 ?>
