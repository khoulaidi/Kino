<?php

class _Raum{

  private $nummer;
  private $film_id;
  private $kapazitat;
  private $sitze;

  public function __construct($nummer, $kapazitat, $film_id = 0){

    $this->nummer = $nummer;
    $this->kapazitat = $kapazitat;
    $this->film_id = $film_id;
  }

  public function getNummer(){
    return $this->nummer;
  }
  public function setNummer($nummer){
    $this->nummer = $nummer;
  }

  public function getFilm(){
    return $this->film_id;
  }
  public function setFilm($film_id){
    $this->film_id = $film_id;
  }

  public function getKapazitat(){
    return $this->kapazitat;
  }
  public function setKapazitat($kapazitat){
    $this->kapazitat = $kapazitat;
  }

  public function getSitze(){
    return $this->sitze;
  }
  public function setSitze($sitze){
    $this->sitze = $sitze;
  }
}
?>
