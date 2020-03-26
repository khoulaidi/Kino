
<?php
  require_once("./Class/connection.php");

  $host = $_SERVER['HTTP_HOST'];
  $image_path = $host."/Kinov2/images/";

  //echo '<img src="http://'.$image_path.'Joker.jpg" />';

  /*Connection::Connect();
  $sql = Connection::$con->query("SELECT Film_id, Raum_id, datum FROM TERMIN WHERE id = '9'");

  while($obj = $sql->fetch_object()){
    echo $obj->Film_id;
  }*/


  $u2 = new _User("rsdsdss@gmail.com", "te1t12", "Khoulaidi", "Zoubair","adresse1", "10.12.2000","Male");

  //Connection::insertUser($u2);

  $f1 = new _Film("Atdsdscs", "sfdads", "156", "10.12.2001","Zoubair","http://".$image_path."Joker.jpg");
  Connection::insertFilm($f1);
  $r1 = new _Raum("3","4","2");

  //$s1 = new _Sitz("1","96");
  //Connection::updateSitz($s1);
  //Connection::deleteRaum($r1);
  //Connection::deleteSitz($s1);

  //Connection::deleteFilm($f1);

  //Connection::updateRaum($r1);

  //$t1 = new _Termin("65","06.04.2020 22:02:00");


  //Connection::insertTermin($t1);
  //Connection::updateTermin("53","106","02.04.2020 00:10:00");

  $joker = Connection::searchFilm("Joker");
  //$avatar = Connection::searchFilm("Avtr");
  $raum2 = Connection::searchRaum("2");
  $user1 = Connection::searchUser("zoubairbair@gmail.com");
  $termin1 = Connection::searchTermin("51");
  $reservation1 = new _Reservation("53","1","272");

  $joker->setBeschreibung("Beschreibung");

//  Connection::deleteFilm($avatar);

  //£Connection::insertReservation($reservation1);
  echo "<br/>Ticket: <br/>";
  echo $reservation1->__toString();
  //print_r(Connection::listSitze("106"));
  //Connection::deleteTermin("59");

  //echo $joker->getName();
  //echo $raum2->getFilm();
  //echo $user1->getVorname();

  //echo $termin1->__toString();

  //Connection::insertRaum($r1);


  //$array = Connection::searchTerminById("1");

  //echo $array["Raum_id"];

  //Connection::updateSitz($s1);
  /*$list = Connection::listSitze($r1);

  print_r($list);*/
  //$u2->setAdresse("adresse132");

  //Connection::deleteUser($u2);

  //Connection::deleteUser($u2);

  /*echo Connection::searchUser($u2->getEmail());

  $film = Connection::searchFilm("Joker");

  echo $film->getAutor();

  $d = '28.02.2012';

  $date = new Datetime($d);

  echo $date->format('Y-m-d');*/
 ?>
