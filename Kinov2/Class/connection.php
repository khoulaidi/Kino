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
    static function searchUser($mail){
      self::Connect();

      $u_id = self::searchUserByMail($mail);
      if($u_id == -1){
        return false;
      }

      $sql = self::$con->query("SELECT * FROM USER WHERE id = '$u_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();

        $geburtsdatum = $row["geburtsdatum"];
        $d = DateTime::createFromFormat('Y-m-d', $geburtsdatum);
        $date = $d->format('d.m.Y');


        $user = new _User($row["email"], $row["passwort"], $row["nachname"], $row["vorname"], $row["adresse"], "$date",
         $row["geschlecht"]);

        $user->setId($row["id"]);

        return $user;
      }
      else{
        return false;
      }
    }
    static function loginUser($mail, $passwort){
      self::Connect();

      $user = false;

      $sql = self::$con->query("SELECT * FROM USER WHERE email = '$mail' AND passwort ='$passwort'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();
        $user = self::searchUser($row["email"]);
        return $user;
      }
      else
        return false;
    }

    static function insertUser($user){
      self::Connect();

      $email = $user->getEmail();
      if($email == false){
        return false;
      }
      $password = $user->getPasswort();
      $nachname = $user->getNachname();
      $vorname = $user->getVorname();
      $adresse = $user->getAdresse();
      $geburtsdatum = $user->getGeburtsdatum();
      $geschlecht = $user->getGeschlecht();

      $sql = self::$con->query("INSERT INTO USER (email, passwort, nachname, vorname, adresse, geburtsdatum, geschlecht)
      VALUES ('$email', '$password', '$nachname', '$vorname', '$adresse', '$geburtsdatum', '$geschlecht')");

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

        return $sql;
      }
      else {
        return false;
      }
    }
    static function deleteUser($user){
      self::Connect();

      $u_id = self::searchUserByMail($user->getEmail());
      if($u_id != -1){

        $sql = self::$con->query("DELETE FROM USER WHERE id = $u_id");

        return $sql;
      }
      else {
        return false;
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
        return false;
      }

      $sql = self::$con->query("SELECT * FROM FILM WHERE id = '$f_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();

        $date_sortie = $row["date_sortie"];

        $d = DateTime::createFromFormat('Y-m-d', $date_sortie);
        $date = $d->format('d.m.Y');

        $film = new _Film($row["name"], $row["beschreibung"], $row["dauer"], "$date", $row["autor"], $row["image"]);

        $film->setId($row["id"]);

        return $film;
      }
      else{
        return false;
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

          return $sql;
      }
      else {
        return false;
      }
    }
    static function deleteFilm($film){
      self::Connect();

      $name = $film->getName();

      $f_id = self::searchFilmByName($name);
      if($f_id != -1){
        $sql = self::$con->query("DELETE FROM FILM WHERE id = $f_id");

        return $sql;
      }
      else {
        return false;
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
        return false;
      }

      $sql = self::$con->query("SELECT * FROM RAUM WHERE id = '$r_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();

        $raum = new _Raum($row["nummer"], $row["Film_id"], $row["kapazitat"]);

        $raum->setId($row["id"]);

        return $raum;
      }
      else{
        return false;
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
        $r_id = self::searchRaumByNummer($raum->getNummer());
        for($i = 1; $i <= $kapazitat; $i++){
          $s = new _Sitz("$i","$r_id");
          self::insertSitz($s);
        }
      }
      else {
        return false;
      }

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
              return true;
            }
            else{
              while($anz > $kapazitat){
                $s = new _Sitz("$anz", "$r_id");
                self::deleteSitz($s);
                $anz--;
              }
              return true;
            }
          }
          else {
            return $sql_count;
          }
        }
        else {
          return $sql;
        }
      }
      else {
        return false;
      }
    }
    static function deleteRaum($raum){
      self::Connect();

      $r_id = self::searchRaumByNummer($raum->getNummer());
      if($r_id != -1){
        $sql = self::$con->query("DELETE FROM RAUM WHERE id = $r_id");

        return $sql;
      }
      else {
        return false;
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
        return false;
    }
    static function listSitze($raum_id){
      self::Connect();

      $list = array();
      if($raum_id != -1){
        $sql = self::$con->query("SELECT * FROM SITZ WHERE Raum_id = '$raum_id'");
        if($sql->num_rows > 0){
          while($row = $sql->fetch_array()){
              $list[] = $row;
          }
        }
        return $list;
      }
      else {
        return false;
      }
    }

    static function insertSitz($sitz){
      self::Connect();
      $nummer = $sitz->getNummer();

      $verfugbar = $sitz->getVerfugbar();

      $raum_id = $sitz->getRaum();
      $raum = self::searchRaumById($raum_id);

      if($raum == -1){
        return false;
      }

      $sql = self::$con->query("INSERT INTO SITZ (nummer, verfugbar, Raum_id)
      VALUES ('$nummer', '$verfugbar', '$raum_id')");

      return $sql;
    }
    static function updateSitz($sitz_id, $verfugbar){
      self::Connect();

      $sql = self::$con->query("UPDATE SITZ set verfugbar = '$verfugbar' where id = $sitz_id");

      return $sql;
    }
    static function deleteSitz($sitz){

      $s_id = self::searchSitzByObject($sitz);
      if($s_id != -1){
        $sql = self::$con->query("DELETE FROM SITZ WHERE id = $s_id");

        return $sql;
      }
      else {
        return false;
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

      $sql = self::$con->query("SELECT * FROM TERMIN WHERE id = '$termin_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();

        $datum = $row["datum"];
        $d = DateTime::createFromFormat('Y-m-d H:i:s', $datum);
        if($d == false){
          return false;
        }
        $date = $d->format('d.m.Y H:i:s');

        $termin = new _Termin($row["Raum_id"], "$date", $row["Film_id"]);

        $termin->setId($row["id"]);

        return $termin;
      }
      else{
        return false;
      }
    }
    static function listTermine(){
      self::Connect();

      $list = array();
      $sql = self::$con->query("SELECT * FROM TERMIN");
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
    static function listTermineByRaum($raum_id){
      self::Connect();

      $list = array();
      $sql = self::$con->query("SELECT * FROM TERMIN where Raum_id = '$raum_id'");
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
        return false;
      }
    }
    static function checkFilm_Zeit($raum_id, $datum){
      self::Connect();

      $check = 1;
      $array = self::listTermineByRaum($raum_id);

      if($array != false){
        foreach($array as $row){

            $dauer = self::searchDauerById($row["Film_id"]);
            if($dauer == false){
              return false;
            }
            $pause = 30;
            $date = $row["datum"];

            if(strtotime($datum) > strtotime($date)){
              $d = new DateTime($date);
              $d->modify("+ {$dauer} minutes");
              $d->modify("+ {$pause} minutes");

              $da = $d->format('Y-m-d H:i:s');

              echo "1. Database: ".$date." Gegeben: ".$datum." Addition:".$da."<br/>";
              echo "1. Vor Check: ".$check."<br/>";
              if(strtotime($datum) < strtotime($da)){
                  $check = 0;
              }
              echo "1. Nach Check: ".$check."<br/>";
            }
            else {
              $d1 = new DateTime($date);
              $d1->modify("+ {$dauer} minutes");
              $d1->modify("+ {$pause} minutes");

              $da1 = $d1->format('Y-m-d H:i:s');

              $d = new DateTime($datum);
              $d->modify("+ {$dauer} minutes");
              $d->modify("+ {$pause} minutes");

              $da = $d->format('Y-m-d H:i:s');

              echo "2. Database: ".$date." Gegeben: ".$datum." Gegeben Addition: ".$da." Database_Addition: ".$da1."<br/>";
              echo "2. Vor Check: ".$check."<br/>";
              if((strtotime($da) > strtotime($date)) && (strtotime($da) < strtotime($da1))){
                  $check = 0;
              }
              echo "2. Nach Check: ".$check."<br/>";
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
      if($datum == false){
       return false;
      }

      $film = self::searchRaumById($raum_id);
      if($film != -1){
        $film_id = $film["Film_id"];
      }
      else {
        return false;
      }

      $check = self::checkFilm_Zeit($raum_id, $datum);

      if($check != 0 || $check == -1){
        $sql = self::$con->query("INSERT INTO TERMIN (Film_id, Raum_id, datum)
        VALUES ('$film_id', '$raum_id', '$datum')");

        return $sql;
      }
      else {
        return false;
      }
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
            if($dauer == false){
              return false;
            }
            $pause = 30;

            $db_date = $row["datum"];

            $d = new DateTime($db_date);
              //$d->modify("+ {$dauer} minutes");
            $d->modify("+ {$pause} minutes");

            $da = $d->format('Y-m-d H:i:s');

            if(strtotime($date) > strtotime($db_date)){
              $d = new DateTime($db_date);
              $d->modify("+ {$pause} minutes");

              $da = $d->format('Y-m-d H:i:s');

              echo "3. Database: ".$db_date." Gegeben: ".$date." Addition:".$da."<br/>";
              echo "3. Vor Check: ".$check1."<br/>";
              $test1 = self::checkFilm_Zeit($raum_id, $date);
              if($test1 == 0){
                return false;
              }
              if(strtotime($date) < strtotime($da)){
                  $check1 = 0;
              }
              echo "3. Nach Check: ".$check1."<br/>";
            }
            else {
              $d1 = new DateTime($date);
              $d1->modify("+ {$pause} minutes");

              $da1 = $d1->format('Y-m-d H:i:s');

              $d = new DateTime($db_date);
              $d->modify("+ {$pause} minutes");

              $da = $d->format('Y-m-d H:i:s');

              echo "4. Database: ".$db_date." Gegeben: ".$date." Gegeben Addition: ".$da1." Database_Addition: ".$da."<br/>";
              echo "4. Vor Check: ".$check1."<br/>";
              $test2 = self::checkFilm_Zeit($raum_id, $da1);
              if($test2 == 0){
                return false;
              }
              if((strtotime($da1) > strtotime($db_date)) && (strtotime($da1) < strtotime($da))){
                  $check1 = 0;
              }
              echo "4. Nach Check: ".$check1."<br/>";
            }
          }
          if($check1 != 0){
            $sql = self::$con->query("UPDATE TERMIN set Film_id = $film_id, Raum_id = '$raum_id',
               datum = '$date' where id = $termin_id");

            return $sql;
          }
          else {
            return false;
          }
        }
        else {
          return false;
        }
      }
      else{
        $check = self::checkFilm_Zeit($raum_id, $date);

        if($check != 0){
          $sql = self::$con->query("UPDATE TERMIN set Film_id = $film_id, Raum_id = '$raum_id',
           datum = '$date' where id = $termin_id");

          return $sql;
        }
        else {
          return false;
        }
      }
    }
    static function deleteTermin($termin_id){
      self::Connect();

      $sql = self::$con->query("DELETE FROM TERMIN WHERE id = $termin_id");

      return $sql;
    }

    //Reservation_Dienste
    static function searchReservation($reservation_id){
      self::Connect();

      $sql = self::$con->query("SELECT * FROM RESERVATION WHERE id = '$reservation_id'");

      if($sql->num_rows > 0){
        $row = $sql->fetch_array();

        $reservation = new _Reservation($row["Termin_id"], $row["User_id"], $row["Sitz_id"]);

        $reservation->setId($row["id"]);

        return $reservation;
      }
      else{
        return false;
      }
    }
    static function searchUserReservation($user_id){
      self::Connect();

      $list = array();
      if($user_id != -1){
        $sql = self::$con->query("SELECT * FROM RESERVATION WHERE User_id = '$user_id'");
        if($sql->num_rows > 0){
          while($row = $sql->fetch_array()){
              $list[] = $row;
          }
        }
        return $list;
      }
      else {
        return false;
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
        self::updateSitz($sitz_id,"0");
        return $sql;
      }
      else {
        return false;
      }
    }
    static function updateReservartion($reservation_id, $sitz_id){
      self::Connect();

      $reservation = self::searchReservation($reservation_id);
      $old = $reservation->getSitz();

      if($old != $sitz_id){
        $array = self::searchSitzById($sitz_id);
        if($array == false){
          return false;
        }
        $verfugbar = $array["verfugbar"];
        if($verfugbar != 0) {
          $sql = self::$con->query("UPDATE RESERVATION set Sitz_id = '$sitz_id' where id = $reservation_id" );

          if($sql == true){
            self::updateSitz($old,"1");
            self::updateSitz($sitz_id,"0");
            return $sql;
          }
          else {
            return false;
          }
        }
        else {
          return false;
        }
      }
      else {
        return true;
      }
    }
    static function deleteReservation($reservation_id){
      self::Connect();

      $sitz = 0;
      $reservation = self::searchReservation($reservation_id);

      if($reservation != false){
        $sitz = $reservation->getSitz();
      }
      else {
        return false;
      }

      $sql = self::$con->query("DELETE FROM RESERVATION WHERE id = $reservation_id");

      if($sql == true){
        self::updateSitz($sitz,"1");
        return true;
      }
      else {
        return false;
      }
    }
}
?>
