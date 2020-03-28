<?php

class _User{

  private $id;
  private $email;
  private $passwort;
  private $nachname;
  private $vorname;
  private $adresse;
  private $geburtsdatum;
  private $geschlecht;

  public function __construct($email, $passwort, $nachname, $vorname, $adresse, $geburtsdatum, $geschlecht){

    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      $this->email = $email;
    }
    else {
      return false;
    }
    $this->passwort = $passwort;
    $this->nachname = $nachname;
    $this->vorname = $vorname;
    $this->adresse = $adresse;

  //  $d = DateTime::createFromFormat('d.m.Y', $geburtsdatum);
  //  $date = $d->format('Y-m-d');
  //  $this->geburtsdatum = $date;
   $this->geburtsdatum = $geburtsdatum;

    $this->geschlecht = $geschlecht;
  }

  public function getId(){
    return $this->id;
  }
  public function setId($id){
    $this->id =$id;
  }

  public function getEmail(){
      return $this->email;
  }
  public function setEmail($email){
    if(filter_var($email, FILTER_VALIDATE_EMAIL)){
      $this->email = $email;
      return  true;
    }
    return false;
  }

  public function getPasswort(){
    return $this->passwort;
  }
  public function setPasswort($passwort){
    $this->passwort = $passwort;
  }

  public function getNachname(){
    return $this->nachname;
  }
  public function setNachname($nachname){
    $this->nachname = $nachname;
  }

  public function getVorname(){
    return $this->vorname;
  }
  public function setVorname($vorname){
    $this->vorname = $vorname;
  }

  public function getAdresse(){
    return $this->adresse;
  }
  public function setAdresse($adresse){
    $this->adresse = $adresse;
  }

  public function getGeschlecht(){
    return $this->geschlecht;
  }
  public function setGeschlecht($geschlecht){
    $this->geschlecht = $geschlecht;
  }

  public function getGeburtsdatum(){
    return $this->geburtsdatum;
  }
  public function setGeburtsdatum($geburtsdatum){

    $d = DateTime::createFromFormat('d.m.Y', $geburtsdatum);
    $date = $d->format('Y-m-d');
    $this->geburtsdatum = $date;
  }
}

?>
