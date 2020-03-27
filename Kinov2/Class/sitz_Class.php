<?php

class _Sitz{

  private $id;
  private $nummer;
  private $verfugbar;
  private $raum_id;

  public function __construct($nummer, $raum_id, $verfugbar = 1){
    if($nummer >= 1 && $nummer <= 50){
      $this->nummer = $nummer;
    }
    else {
      return false;
    }
    $this->raum_id = $raum_id;
    $this->verfugbar = $verfugbar;

  }

  public function getId(){
    return $this->id;
  }
  public function setId($id){
    $this->id =$id;
  }

  public function getNummer(){
    return $this->nummer ;
  }
  public function setNummer($nummer){
    if($nummer >= 1 && $nummer <= 50){
      $this->nummer = $nummer;
    }
  }

  public function getRaum(){
    return $this->raum_id;
  }
  public function setRaum($raum_id){
    $this->raum_id = $raum_id;
  }

  public function getVerfugbar(){
    return $this->verfugbar;
  }
  public function setVerfugbar($verfugbar){
    $this->verfugbar = $verfugbar;
  }
}
?>
