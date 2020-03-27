<?php
  require_once("config.php");


  Connection::Connect();
  /*static function Test(){
    $sql= "SELECT * FROM FILM WHERE id = 1";
    $result = self::$con->query($sql);

    if($result->num_rows > 0){
      $row = $result->fetch_assoc();
      echo '<img src ="'.$row["image"].'" width="25%" />';
    }
  }*/


  //USER_TEST
  $user = new _User("zoubairbair@gmail.com", "passwort1", "Khoulaidi", "Zoubair", "Goebenstr. 8 Saarbruecken",
   "27.10.1994", "Male");


  /*if(Connection::insertUser($user)){
    echo 'Richtig!';
  }
  else {
    echo 'Falsch!';
  }*/

  /*$user->setVorname("Zoubai");
  if(Connection::updateUser($user)){
    echo 'Richtig!';
  }
  else {
    echo 'Falsch!';
  }*/


  /*if(Connection::deleteUser($user)){
    echo 'Richtig!';
  }
  else {
    echo 'Falsch!';
  }*/

  //FILM_TEST
  //$default = new _Film("Default", "Default","0","NULL",Default","NULL"); ES SOLL ID = 0 IN DATABSE SEIN
  $film = new _Film("Joker", "Joker schoener Film", '200', "10.12.2020","Zoubair","http://".$image_path."Joker.jpg");

  /*if(Connection::insertFilm($film)){
    echo 'Richtig!';
  }
  else {
    echo 'Falsch!';
  }*/

  /*$film->setBeschreibung("Joker schoener Fil,");
  if(Connection::updateFilm($film)){
    echo 'Richtig!';
  }
  else {
    echo 'Falsch!';
  }*/

  /*if(Connection::insertFilm($film)){
    echo 'Richtig!';
  }
  else {
    echo 'Falsch!';
  }*/


  //RAUM_TEST + SITZE_TEST

  $raum = new _Raum("2", "10", "77");

  /*if(Connection::insertRaum($raum)){
    echo 'Richtig!';
  }
  else {
    echo 'Falsch!';
  }*/

  $raum->setFilm("77");
  $raum->setKapazitat("10");
  //$raum->setKapazitat("10"); SITZE WERDEN AUTOMATISCH HINZUGEFÜGT ODER GELÖSCHT SEIN
  if(Connection::updateRaum($raum)){
    echo 'Richtig!';
  }
  else {
    echo 'Falsch!';
  }

  /*if(Connection::deleteRaum("129")){
    echo 'Richtig!';
  }
  else {
    echo 'Falsch!';
  }*/

  /*$array = Connection::listSitze("12");

  if($array){
    print_r($array);
  }
  else {
    echo 'Leer';
  }*/


  //TERMIN_TEST

  $termin = new _Termin("135", "02.08.2020 03:30:00");

  /*if(Connection::insertTermin($termin)){
    echo 'Richtig!';
  }
  else {
    echo 'Falsch!';
  }*/

  /*if(Connection::updateTermin("124", "135", "04.08.2020 16:31:00")){
    echo 'Richtig!';
  }
  else {
    echo 'Falsch!';
  }*/



  Connection::Disconnect();
?>
