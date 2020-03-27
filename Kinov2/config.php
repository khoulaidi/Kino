
<?php
  require_once("./Class/connection.php");

  $host = $_SERVER['HTTP_HOST'];
  $image_path = $host."/Kino/images/";

  /*static function Test(){
    $sql= "SELECT * FROM FILM WHERE id = 1";
    $result = self::$con->query($sql);

    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      echo '<img src ="'.$row["image"].'" width="25%" />';
    }
  }*/

  $user = Connection::loginUser("zoubairbair@gmail.com","test");

  $true = true;
  /*if(!$true){
    //echo $user->getNachname();
    echo "True";
  }
  else {
    echo "False";
  }*/

 ?>
