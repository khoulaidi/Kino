<?php
require_once("connection.php");

class _Termin{

  private $id;
  private $film_id;
  private $raum_id;
  private $datum;

  public function __construct($raum_id, $datum, $film_id = 0){
    $this->film_id = $film_id;
    $this->raum_id = $raum_id;

    $d = DateTime::createFromFormat('d.m.Y H:i:s', $datum);
    if($d == false){
      return false;
    }
    $date = $d->format('Y-m-d H:i:s');
    $this->datum = $date;
  }

  public function getId(){
    return $this->id;
  }
  public function setId($id){
    $this->id =$id;
  }

  public function getFilm(){
    return $this->film_id;
  }
  public function setFilm($film_id){
    $this->film_id = $film_id;
  }

  public function getRaum(){
    return $this->raum_id;
  }
  public function setRaum($raum_id){
    $this->raum_id = $raum_id;
  }

  public function getDatum(){
    return $this->datum;
  }
  public function setDatum($datum){
    $d = DateTime::createFromFormat('d.m.Y H:i:s', $datum);
    if($d == false){
      return false;
    }
    $date = $d->format('Y-m-d');
    $this->datum = $date;
  }

  public function Date_Difference($d1, $d2){

   $date1 = strtotime($d1);
   $date2 = strtotime($d2);

   $diff = abs($date1 - $date2);

   $years = floor($diff / (365*60*60*24));
   $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
   $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
   $hours = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24) / (60*60));
   $minutes = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60);

   $summe = ($years * 365*24*60) + ($months * 30*24*60) + ($days * 24*60) + ($hours * 60) + $minutes;

   return $summe;
 }

  public function __toString(){
    Connection::Connect();

    $film = Connection::searchFilmById($this->film_id);
    $raum = Connection::searchRaumById($this->raum_id);

    $d = strtotime($this->datum);
    $date = date('d.m.Y H:i', $d);

    echo 'Film: '.$film.", Raum: ".$raum["nummer"].", Datum: ".$date;

    Connection::Disconnect();
  }
}
?>
