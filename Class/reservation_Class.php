<?php
require_once("connection.php");

class _Reservation{

  private $id;
  private $termin_id;
  private $user_id;
  private $sitz_id;

  public function __construct($termin_id, $user_id, $sitz_id){
    $this->termin_id = $termin_id;
    $this->user_id = $user_id;
    $this->sitz_id = $sitz_id;
  }

  public function getId(){
    return $this->id;
  }
  public function setId($id){
    $this->id =$id;
  }

  public function getTermin(){
    return $this->termin_id;
  }
  public function setTermin($termin_id){
    $this->termin_id = $termin_id;
  }

  public function getUser(){
    return $this->user_id;
  }
  public function setUser($user_id){
    $this->user_id = $user_id;
  }

  public function getSitz(){
    return $this->sitz_id;
  }
  public function setSitz($sitz_id){
    $this->sitz_id = $sitz_id;
  }

  public function __toString(){
    Connection::Connect();

    $termin = Connection::searchTermin($this->termin_id);
    $user = Connection::searchUserById($this->user_id);
    $film = Connection::searchFilmById($termin->getFilm());
    $raum = Connection::searchRaumById($termin->getRaum());
    $sitz = Connection::searchSitzById($this->sitz_id);

    $d = strtotime($termin->getDatum());
    $date = date('d.m.Y H:i', $d);

    echo "Name: ".$user["nachname"]." ".$user["vorname"].", Film: ".$film.", Datum: ".$date.", Raum: ".$raum["nummer"].", Sitz: ".$sitz["nummer"].".";

    Connection::Disconnect();
  }
}
?>
