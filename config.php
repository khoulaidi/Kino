
<?php
  require_once("./Class/connection.php");

  $host = $_SERVER['HTTP_HOST'];
  $file = dirname("/Kino/config.php");
  $image_path = $host.$file."/images/";

  /*static function Test(){
    $sql= "SELECT * FROM FILM WHERE id = 1";
    $result = self::$con->query($sql);

    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      echo '<img src ="'.$row["image"].'" width="25%" />';
    }
  }*/

  $joker = new _Film("Night", "Regisseur Simon Verhoeven schickt Elyas MBarek und Palina Rojinski auf das verrueckteste Date aller Zeiten.",
   "115", "13.02.2020", "Simon Verhoeven", "http://".$image_path."Night.jpg");

   if(Connection::insertFilm($joker)){
     echo 'Richtig';
   }
   else {
     echo 'Falsch';
   }

   echo $joker->convertDatum();

 ?>
