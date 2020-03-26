<?php
include "user_Class.php";
include "film_Class.php";
include "raum_Class.php";
include "sitz_Class.php";
include "reservation_Class.php";
include "termin_Class.php";

class Connection{
    static private $host = "localhost";
    static private $user = "root";
    static private $password = "";
    static private $dbname = "Kino_db";
    static private $con;

    public static function Connect(){
      self::$con = mysqli_connect(self::$host, self::$user, self::$password,self::$dbname);
      // Check connection
      if (!self::$con) {
        die("Connection failed: " . mysqli_connect_error());
      }
    }

    public static function Disconnect(){
        mysqli_close(self::$con);
    }

    /*static function Test(){
      $sql= "SELECT * FROM FILM WHERE id = 1";
      $result = self::$con->query($sql);

      if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        echo '<img src ="'.$row["image"].'" width="25%" />';
      }
    }*/

    //User_Dienste
    static function searchUserByMail($mail){
      self::Connect();
      //$mail = $user->getEmail();

      $sql = self::$con->query("SELECT id FROM USER WHERE email = '$mail'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_assoc();

        return $row["id"];
      }
      else
        return -1;
    }
    static function searchUserById($user_id){
      self::Connect();

      $sql = self::$con->query("SELECT * FROM USER WHERE id = '$user_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();

        return $row;
      }
      else
        return -1;
    }
    static function loginUser($mail, $passwort){
      self::Connect();

      $sql = self::$con->query("SELECT * FROM USER WHERE email = '$mail' AND passwort ='$passwort'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();

        return $row;
      }
      else
        return -1;
    }
    static function searchUser($mail){
      self::Connect();

      $u_id = self::searchUserByMail($mail);
      if($u_id == -1){
        echo 'User ist nicht da!';
        return false;
      }

      $sql = self::$con->query("SELECT email, passwort, nachname, vorname, adresse, geschlecht, geburtsdatum
         FROM USER WHERE id = '$u_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();

        $geburtsdatum = $row["geburtsdatum"];
        $d = DateTime::createFromFormat('Y-m-d', $geburtsdatum);
        $date = $d->format('d.m.Y');


        $user = new _User($row["email"], $row["passwort"], $row["nachname"], $row["vorname"], $row["adresse"], "$date",
         $row["geschlecht"]);

        return $user;
      }
      else{
        echo 'User ist nicht da!';
        return -1;
      }
    }

    static function insertUser($user){
      self::Connect();
      $email = $user->getEmail();
      $password = $user->getPasswort();
      $nachname = $user->getNachname();
      $vorname = $user->getVorname();
      $adresse = $user->getAdresse();
      $geburtsdatum = $user->getGeburtsdatum();
      $geschlecht = $user->getGeschlecht();

      $sql = self::$con->query("INSERT INTO USER (email, passwort, nachname, vorname, adresse, geburtsdatum, geschlecht)
      VALUES ('$email', '$password', '$nachname', '$vorname', '$adresse', '$geburtsdatum', '$geschlecht')");

      if($sql == true){
        echo 'Registrierung erfolgreich!';
      }
      else {
        echo 'Registrierung nicht erfolgreich!';
      }
      self::Disconnect();

      return $sql;
    }
    static function updateUser($user){
      self::Connect();

      $u_id = self::searchUserByMail($user->getEmail());

      if($u_id != -1){
        $password = $user->getPasswort();
        $nachname = $user->getNachname();
        $vorname = $user->getVorname();
        $adresse = $user->getAdresse();
        $geburtsdatum = $user->getGeburtsdatum();
        $geschlecht = $user->getGeschlecht();

        $sql = self::$con->query("UPDATE USER set passwort = '$password', nachname = '$nachname',
          vorname = '$vorname', adresse = '$adresse', geburtsdatum = '$geburtsdatum', geschlecht = '$geschlecht' where id = $u_id");

        if($sql == true){
          echo 'Updated!';
          self::Disconnect();
          return $sql;
        }
        else {
          echo 'Update nicht erfolgreich!';
          return $sql;
        }
      }
      else {
        echo 'User nicht da!';
      }
    }
    static function deleteUser($user){
      self::Connect();

      $u_id = self::searchUserByMail($user->getEmail());
      if($u_id != -1){
        $sql = self::$con->query("DELETE FROM USER WHERE id = $u_id");
        if($sql == true){
          echo 'Deleted!';
          self::Disconnect();
          return $sql;
        }
        else {
          echo 'Delete nicht erfolgreich!';
          return $sql;
        }
      }
      else {
        echo 'User nicht Da!';
      }
    }

    //Film_Dienste
    static function searchFilmByName($name){
      self::Connect();

      $sql = self::$con->query("SELECT id FROM FILM WHERE name = '$name'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_assoc();

        return $row["id"];
      }
      else
        return -1;
    }
    static function searchFilmById($film_id){
      self::Connect();

      $sql = self::$con->query("SELECT * FROM FILM WHERE id = '$film_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_assoc();

        return $row["name"];
      }
      else
        return -1;
    }
    static function searchFilm($name){
      self::Connect();

      $f_id = self::searchFilmByName($name);
      if($f_id == -1){
        echo 'Film ist nicht da!';
        return false;
      }

      $sql = self::$con->query("SELECT name, beschreibung, dauer, date_sortie, autor, image FROM FILM WHERE id = '$f_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();

        $date_sortie = $row["date_sortie"];

        $d = DateTime::createFromFormat('Y-m-d', $date_sortie);
        $date = $d->format('d.m.Y');

        $film = new _Film($row["name"], $row["beschreibung"], $row["dauer"], "$date", $row["autor"], $row["image"]);

        return $film;
      }
      else{
        echo 'Film ist nicht da!';
        return -1;
      }
    }

    static function insertFilm($film){
      self::Connect();

      $name = $film->getName();
      $beschreibung = $film->getBeschreibung();
      $dauer = $film->getDauer();
      $date_sortie = $film->getDate_Sortie();
      $autor = $film->getAutor();
      $image = $film->getImage();

      $sql = self::$con->query("INSERT INTO FILM (name, beschreibung, dauer, date_sortie, autor, image)
      VALUES ('$name', '$beschreibung', '$dauer', '$date_sortie', '$autor', '$image')");

      if($sql == true){
        echo 'Insert erfolgreich!';
      }
      else {
        echo 'Insert nicht erfolgreich!';
      }
      self::Disconnect();

      return $sql;
    }
    static function updateFilm($film){
      self::Connect();

      $name = $film->getName();

      $f_id = self::searchFilmByName($name);
      if($f_id != -1){
        $beschreibung = $film->getBeschreibung();
        $dauer = $film->getDauer();
        $date_sortie = $film->getDate_Sortie();
        $autor = $film->getAutor();
        $image = $film->getImage();

        $sql = self::$con->query("UPDATE FILM set beschreibung = '$beschreibung',
          dauer = '$dauer', date_sortie = '$date_sortie', autor = '$autor', image = '$image' where id = $f_id");
        if($sql == true){
          echo 'Updated!';
          self::Disconnect();
          return $sql;
        }
        else {
          echo 'Update nicht erfolgreich!';
          return $sql;
        }
      }
      else {
        echo 'Film nicht Da!';
      }
    }
    static function deleteFilm($film){
      self::Connect();

      $name = $film->getName();

      $f_id = self::searchFilmByName($name);
      if($f_id != -1){
        $sql = self::$con->query("DELETE FROM FILM WHERE id = $f_id");

        if($sql == true){
          echo 'Deleted!';
          self::Disconnect();
          return $sql;
        }
        else {
          echo 'Delete nicht erfolgreich!';
          return $sql;
        }
      }
      else {
        echo 'Film nicht Da!';
      }
    }

    //Raum_Dienste
    static function searchRaumByNummer($nummer){
      self::Connect();

      $sql = self::$con->query("SELECT id FROM RAUM WHERE nummer = '$nummer'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_assoc();

        return $row["id"];
      }
      else{
        return -1;
      }
    }
    static function searchRaumById($raum_id){
      self::Connect();

      $sql = self::$con->query("SELECT * FROM RAUM WHERE id = '$raum_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();

        return $row;
      }
      else
        return -1;
    }
    static function searchRaum($nummer){
      self::Connect();

      $r_id = self::searchRaumByNummer($nummer);
      if($r_id == -1){
        echo 'Raum ist nicht da!';
        return false;
      }

      $sql = self::$con->query("SELECT nummer, Film_id, kapazitat FROM RAUM WHERE id = '$r_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();

        $raum = new _Raum($row["nummer"], $row["Film_id"], $row["kapazitat"]);

        return $raum;
      }
      else{
        echo 'Raum ist nicht da!';
        return -1;
      }
    }

    static function insertRaum($raum){
      self::Connect();

      $nummer = $raum->getNummer();

      $film_id = $raum->getFilm();
      if($film_id != 0){
          $film = self::searchFilmById($film_id);
          if($film == -1){
            $film_id = 0;
          }
      }
      $kapazitat = $raum->getKapazitat();

      $sql = self::$con->query("INSERT INTO RAUM (nummer, Film_id, kapazitat)
      VALUES ('$nummer', '$film_id', '$kapazitat')");

      if($sql == true){
        echo 'Insert erfolgreich!';
        $r_id = self::searchRaumByNummer($raum->getNummer());
        for($i = 1; $i <= $kapazitat; $i++){
          $s = new _Sitz("$i","$r_id");
          self::insertSitz($s);
        }
      }
      else {
        echo 'Insert nicht erfolgreich!';
      }
      self::Disconnect();

      return $sql;
    }
    static function updateRaum($raum){
      self::Connect();


      $r_id = self::searchRaumByNummer($raum->getNummer());

      if($r_id != -1){
        $film_id = $raum->getFilm();
        $kapazitat = $raum->getKapazitat();

        $sql = self::$con->query("UPDATE RAUM set Film_id = '$film_id', kapazitat = '$kapazitat' where id = $r_id");

        if($sql == true){
          echo 'Updated!';
          $sql_count = self::$con->query("SELECT COUNT(*) As Anzahl FROM SITZ where RAUM_id = $r_id");
          if($sql_count->num_rows > 0){
            $row = $sql_count->fetch_assoc();
            $anz = $row['Anzahl'];

            if($anz < $kapazitat){
              $anz += 1;
              for($j = $anz; $j <= $kapazitat; $j++){
                $s = new _Sitz("$j","$r_id");
                self::insertSitz($s);
              }
            }
            else{
              while($anz > $kapazitat){
                $s = new _Sitz("$anz", "$r_id");
                self::deleteSitz($s);
                $anz--;
              }
            }
          }
          self::Disconnect();
          return $sql;
        }
        else {
          echo 'Update nicht erfolgreich!';
          return $sql;
        }
      }
      else {
        echo 'Raum ist nicht Da!';
      }
    }
    static function deleteRaum($raum){
      self::Connect();

      $r_id = self::searchRaumByNummer($raum->getNummer());
      if($r_id != -1){
        $sql = self::$con->query("DELETE FROM RAUM WHERE id = $r_id");
        if($sql == true){
          echo 'Deleted!';
          self::Disconnect();
          return $sql;
        }
        else {
          echo 'Delete nicht erfolgreich!';
          return $sql;
        }
      }
      else {
        echo 'Raum ist  nicht Da!';
      }
    }

    //Sitz_Diensste
    static function searchSitzByObject($sitz){
      self::Connect();

      $nummer = $sitz->getNummer();
      $raum_id = $sitz->getRaum();

      $sql = self::$con->query("SELECT id FROM SITZ WHERE nummer = '$nummer' AND Raum_id = '$raum_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_assoc();

        return $row["id"];
      }
      else{
        return -1;
      }
    }
    static function searchSitzById($sitz_id){
      self::Connect();

      $sql = self::$con->query("SELECT * FROM SITZ WHERE id = '$sitz_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();
        return $row;
      }
      else
        return -1;
    }
    static function listSitze($raum_id){
      self::Connect();

      $list = array();
      if($raum_id != -1){
        $sql = self::$con->query("SELECT nummer, verfugbar FROM SITZ WHERE Raum_id = '$raum_id'");
        if($sql->num_rows > 0){
          while($row = $sql->fetch_array()){
              $list[] = $row;
          }
        }
        return $list;
      }
      else {
        echo 'Raum ist nicht Da!';
        return null;
      }
    }

    static function insertSitz($sitz){

      $nummer = $sitz->getNummer();

      $verfugbar = $sitz->getVerfugbar();

      $raum_id = $sitz->getRaum();
      $raum = self::searchRaumById($raum_id);
      if($raum == -1){
        echo 'Raum nicht gefunden!';
        return false;
      }

      $sql = self::$con->query("INSERT INTO SITZ (nummer, verfugbar, Raum_id)
      VALUES ('$nummer', '$verfugbar', '$raum_id')");

      /*if($sql == true){
        echo 'Insert erfolgreich!';
      }
      else {
        echo 'Insert nicht erfolgreich!';
      }*/

      return $sql;
    }
    static function updateSitz($sitz_id, $verfugbar){
      self::Connect();

      $sql = self::$con->query("UPDATE SITZ set verfugbar = '$verfugbar' where id = $sitz_id");

      if($sql == true){
        return true;
      }
      else {
        return false;
      }
    }
    static function deleteSitz($sitz){

      $s_id = self::searchSitzByObject($sitz);
      if($s_id != -1){
        $sql = self::$con->query("DELETE FROM SITZ WHERE id = $s_id");
      }
      else {
        //echo 'Sitz nicht gefunden!';
      }
    }

    //Termin_Dienste
    static function searchTerminByObject($termin){
      self::Connect();

      $datum = $termin->getDatum();
      $raum_id = $termin->getRaum();

      $sql = self::$con->query("SELECT id FROM TERMIN WHERE Raum_id = '$raum_id' AND datum = '$datum'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_assoc();

        return $row["id"];
      }
      else{
        return -1;
      }
    }
    static function searchTermin($termin_id){
      self::Connect();

      $sql = self::$con->query("SELECT Film_id, Raum_id, datum FROM TERMIN WHERE id = '$termin_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();

        $datum = $row["datum"];
        $d = DateTime::createFromFormat('Y-m-d H:i:s', $datum);
        $date = $d->format('d.m.Y H:i:s');

        $termin = new _Termin($row["Raum_id"], "$date", $row["Film_id"]);

        return $termin;
      }
      else{
        echo 'Termin ist nicht da!';
        return -1;
      }
    }
    static function listTermine(){
      self::Connect();

      $list = array();
      $sql = self::$con->query("SELECT Film_id, Raum_id, datum FROM TERMIN");
      if($sql->num_rows > 0){
        while($row = $sql->fetch_array()){
            $list[] = $row;
        }
      }
      else {
        echo 'Keine Termine!';
        return false;
      }
      return $list;
    }
    static function listTermineByRaum($raum_id){
      self::Connect();

      $list = array();
      $sql = self::$con->query("SELECT Film_id, Raum_id, datum FROM TERMIN where Raum_id = '$raum_id'");
      if($sql->num_rows > 0){
        while($row = $sql->fetch_array()){
            $list[] = $row;
        }
      }
      else {
        return false;
      }
      return $list;
    }
    static function searchDauerById($film_id) {

      self::Connect();

      $sql_dauer = self::$con->query("SELECT dauer FROM FILM WHERE id = '$film_id'");

      if($sql_dauer->num_rows > 0){
        $row = $sql_dauer->fetch_assoc();

        return $row["dauer"];
      }
      else{
        echo 'Film ist nicht da!';
        return -1;
      }
    }
    static function checkFilm_Zeit($raum_id, $datum){

      $check = 1;
      $array = self::listTermineByRaum($raum_id);

      if($array != false){
        foreach($array as $row){

            $dauer = self::searchDauerById($row["Film_id"]);
            $pause = 30;
            $d = new DateTime($row["datum"]);
            $d->modify("+ {$dauer} minutes");
            $d->modify("+ {$pause} minutes");

            $date = $d->format('Y-m-d H:i:s');

            echo $date." ".$datum."<br/>";
            if($date >= $datum){
                $check = 0;
            }
        }
      }
      else{
        $check = -1;
      }
      return $check;
    }

    static function insertTermin($termin){
      self::Connect();


      $raum_id = $termin->getRaum();
      $datum = $termin->getDatum();
      $sql = null;

      $film = self::searchRaumById($raum_id);
      if($film != -1){
        $film_id = $film["Film_id"];
      }
      else {
        echo 'Film nicht gefunden!';
        return false;
      }

      $check = self::checkFilm_Zeit($raum_id, $datum);

      if($check != 0 || $check == -1){
        $sql = self::$con->query("INSERT INTO TERMIN (Film_id, Raum_id, datum)
        VALUES ('$film_id', '$raum_id', '$datum')");

        if($sql == true){
          echo 'Insert erfolgreich!';
        }
        else {
          echo 'Insert nicht erfolgreich!';
        }
      }
      else {
        echo 'Raum ist besetzt!';

      }

      self::Disconnect();
      return $sql;
    }
    static function updateTermin($termin_id, $raum_id, $datum){
      self::Connect();

      $sql = null;
      $list = array();
      $termin = self::searchTermin($termin_id);

      $d = DateTime::createFromFormat('d.m.Y H:i:s', $datum);
      $date = $d->format('Y-m-d H:i:s');

      $film = self::searchRaumById($raum_id);
      if($film != -1){
        $film_id = $film["Film_id"];
      }
      else {
        echo 'Film nicht gefunden!';
        return false;
      }

      $raum = $termin->getRaum();

      if($raum_id == $raum){
        $sql_filter = self::$con->query("SELECT Film_id, Raum_id, datum FROM TERMIN
          WHERE Raum_id = '$raum_id' AND id != '$termin_id'");

        if($sql_filter->num_rows > 0){
          while($row = $sql_filter->fetch_array()){
              $list[] = $row;
          }
        }
        else{
          return false;
        }

        if($sql_filter == true){
          $check1 = 1;
          foreach($list as $row){

            $dauer = self::searchDauerById($row["Film_id"]);
            $pause = 30;
            $d = new DateTime($row["datum"]);
              //$d->modify("+ {$dauer} minutes");
            $d->modify("+ {$pause} minutes");

            $da = $d->format('Y-m-d H:i:s');

            $minutes = (strtotime($da) - strtotime($date)) / 60;
            if($minutes < 0){
              $minutes *= -1;
            }
            if($minutes < $dauer){
                $check1 = 0;
            }
          }
          if($check1 != 0){
            $sql = self::$con->query("UPDATE TERMIN set Film_id = $film_id, Raum_id = '$raum_id',
               datum = '$date' where id = $termin_id");

            if($sql == true){
              echo 'Updated!';
              self::Disconnect();
              return $sql;
            }
            else {
              echo 'Update nicht erfolgreich!';
              return $sql;
            }
          }
          else {
            echo 'Raum ist besetzt!';
          }
        }
        else {
          echo 'Raum ist besetzt!';
        }
      }
      else{
        $check = self::checkFilm_Zeit($raum_id, $date);

        if($check != 0){
          $sql = self::$con->query("UPDATE TERMIN set Film_id = $film_id, Raum_id = '$raum_id',
           datum = '$date' where id = $termin_id");

           if($sql == true){
             echo 'Updated!';
             self::Disconnect();
             return $sql;
           }
           else {
             echo 'Update nicht erfolgreich!';
             return $sql;
           }
        }
        else {
          echo 'Raum ist besetzt!';
        }
      }
    }
    static function deleteTermin($termin_id){
      self::Connect();

      $sql = self::$con->query("DELETE FROM TERMIN WHERE id = $termin_id");
      if($sql == true){
        echo 'Deleted!';
        self::Disconnect();
        return $sql;
      }
      else {
        echo 'Delete nicht erfolgreich!';
        return $sql;
      }
    }

    //Reservation_Dienste
    static function searchReservation($reservation_id){
      self::Connect();

      $sql = self::$con->query("SELECT * FROM RESERVATION WHERE id = '$reservation_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();

        $reservation = new _Termin($row["Termin_id"], $row["User_id"], $row["Sitz_id"]);

        return $reservation;
      }
      else{
        echo 'Termin ist nicht da!';
        return -1;
      }
    }
    static function searchReservationById($reservation_id){
      self::Connect();

      $sql = self::$con->query("SELECT * FROM RESERVATION WHERE id = '$reservation_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();

        return $row;
      }
      else
        return -1;
    }

    static function insertReservation($reservation){
      self::Connect();

      $termin_id = $reservation->getTermin();

      $user_id = $reservation->getUser();
      $sitz_id = $reservation->getSitz();

      $sql = self::$con->query("INSERT INTO RESERVATION (Termin_id, User_id, Sitz_id)
      VALUES ('$termin_id', '$user_id', '$sitz_id')");

      if($sql == true){
        echo 'Insert erfolgreich!';
        self::updateSitz($sitz_id,"0");
      }
      else {
        echo 'Insert nicht erfolgreich!';
      }
      self::Disconnect();

      return $sql;
    }
}
?>
