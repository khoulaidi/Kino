<?php

class _Film{

  private $id;
  private $name;
  private $beschreibung;
  private $dauer;
  private $date_sortie;
  private $autor;
  private $image;

  public function __construct($name, $beschreibung, $dauer, $date_sortie, $autor, $image){

    if(filter_var($image, FILTER_VALIDATE_URL)){
      $this->image = $image;
    }
    $this->name = $name;
    $this->beschreibung = $beschreibung;

    $d = DateTime::createFromFormat('d.m.Y', $date_sortie);
    $date = $d->format('Y-m-d');
    $this->date_sortie = $date;

    $this->dauer = $dauer;
    $this->autor = $autor;
  }

  public function getId(){
    return $this->id;
  }
  public function setId($id){
    $this->id =$id;
  }

  public function getName(){
    return $this->name;
  }
  public function setName($name){
    $this->name = $name;
  }

  public function getBeschreibung(){
    return $this->beschreibung;
  }
  public function setBeschreibung($beschreibung){
    $this->beschreibung = $beschreibung;
  }

  public function getDauer(){
    return $this->dauer;
  }
  public function setDauer($dauer){
    $this->dauer = $dauer;
  }

  public function getDate_Sortie(){
    return $this->date_sortie;
  }
  public function setDate_Sortie($date_sortie){

    $d = DateTime::createFromFormat('d.m.Y', $date_sortie);
    $date = $d->format('Y-m-d');
    $this->date_sortie = $date;
  }

  public function convertDatum(){
    $d = strtotime($this->date_sortie);
    $date = date('d F Y', $d);
    return $date;
  }

  public function getAutor(){
    return $this->autor;
  }
  public function setAutor($autor){
    $this->autor = $autor;
  }

  public function getImage(){
    return $this->image;
  }
  public function setImage($image){
    if(filter_var($image, FILTER_VALIDATE_URL)){
      $this->image = $image;
    }
  }
}

?>
