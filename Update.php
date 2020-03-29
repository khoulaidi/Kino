<?php
	require_once("config.php");
	session_start();

  if(isset($_POST['abmelden'])){
		session_unset();
		header("Location: Startseite.php");
		Connection::Disconnect();
	}
	if(isset($_SESSION['user'])){
		$user = $_SESSION['user'];
	}
	else {
		header("Location: Anmeldung.php");
	}

  if(isset($_GET['register'])){
    if(isset($_POST['speichern'])){
      $vorname = $_POST['vorname'];
      $nachname = $_POST['nachname'];
      $email = $_POST['email'];
      $altpasswort = $_POST['altpasswort'];
      $neupasswort = $_POST['neupasswort'];
      $adresse = $_POST['adresse'];

      $passwort = $user->getPasswort();

      if($altpasswort == $passwort && !empty($neupasswort)){
				if(empty($vorname) || empty($nachname) || empty($email)){
					$_SESSION['update_falsch'] = "Die Daten wurden nicht geändert";
				}
				else{
					$user->setVorname("$vorname");
	        $user->setNachname("$nachname");
	        $user->setEmail("$email");
	        $user->setPasswort("$neupasswort");
	        $user->setAdresse("$adresse");

	        if(Connection::updateUser($user)){
	          header("Location: Profil.php");
	        }
	        else {
	          $_SESSION['update_falsch'] = "Die Daten wurden nicht geändert";
	        }
				}
      }
      else {
        $_SESSION['passwort_falsch'] = "Altes Passwort ist falsch!";
      }
    }
  }
 ?>
<!doctype html>
<html lang="en">
	<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="homebg.css">

	<title >Update</title>

	<!-- Favicons -->
	<link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
	<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
	<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
	<link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
	<link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
	<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
	<meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
	<meta name="theme-color" content="#563d7c">

		<!-- Custom styles for this template -->
		<link href="album.css" rel="stylesheet">
	</head>


    <header>
			<div class="collapse bg-dark" id="navbarHeader">
				<div class="container">
					<div class="row">
						<div class="col-sm-8 col-md-7 py-4">
							<h4 class="text-white">About</h4>
							<p class="text-muted"> Diese webseite ist ein exslusive Projekt für Internet Technologie.Das ProjektTeam bestehst aus 2 Studenten (Ahmed Baffoun & Ibrahim Sentissi).</p>
							<p class="text-muted">in Unsere Webseit kann der kinoBesucher ein Ticket für film buchen sowie auch platz Reservieren. </p>
						</div>
						<div class="col-sm-4 offset-md-1 py-4">
							<h4 class="text-white">Contact</h4>
							<ul class="list-unstyled">
								<li><a  class="text-white">Unser Servicecenter ist in der aktuellen Lage nur per Email erreichbar</a></li>
								<li><a  class="text-white">diese Email kontaktieren:</a></li>
								<li><a class="text-white">ahmed_baffana@hotmail.com</a></li>
	              <li><a class="text-white">isentissi@htwsaar.de</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		<div class="navbar navbar-dark bg-dark shadow-sm">
			<div class="container d-flex justify-content-between">
				<a href="Startseite.php" class="navbar-brand d-flex align-items-center" style="color:#F6D155">
					<strong>Kinoprogramm</strong>
				</a>
		<?php
		if(!isset($_SESSION['user'])){
			echo '<a id="anmelden" href="Anmeldung.php" class="navbar-brand d-flex align-items-center"style="color:#F6D155">
				<strong>Anmelden</strong>
			</a>';
			echo '<a href="Regestrieren.php" class="navbar-brand d-flex align-items-center"style="color:#F6D155">
				<strong>Registrieren</strong>
			</a>';
		}
		else {
			$user = $_SESSION['user'];
			$nachname = $user->getNachname();
			$vorname= $user->getVorname();
			echo '<a id="Profil" href="Profil.php" class="navbar-brand d-flex align-items-center"style="color:#F6D155">
				<strong>Hallo, '.$nachname." ".$vorname.'</strong>
			</a>';
			echo '
			<form action="#" method="post">
				<button type="submit" class="btn btn-secondary" style name="abmelden">Abmelden</button>
			</form>';
		}
		?>
				<button class="navbar-toggler" style="color:#F6D155" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span> Info
				</button>
			</div>
		</div>
	</header>
	<main class="bg-light" role="main" >
		<br>
		<div class="container" style="background-color:EBF7E3">


			<h2><u>Profil</u></h2>
			<div class="col-md-8 order-md-1">
				<h4 class="mb-3">-Meine Daten:</h4>
        <?php
          if(isset($_SESSION['update_falsch'])){
            echo '<p style="color:red">'.$_SESSION['update_falsch'].'</p>';
            unset($_SESSION['update_falsch']);
          }
         ?>
				<h6> Geschlecht:</h6>
				<div class="form-check">
					<label class="form-check-label">
					 <?php echo '<b>'.$user->getGeschlecht().'</b>';?>
					</label>
				</div>
		<br>
				<form action="?register=3" method="post" class="needs-validation" novalidate>
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="firstName"><h6>Vorname</h6></label>
							<input type="text" class="form-control" id="firstName"  name="vorname" value=<?php echo '"'.$user->getVorname().'"';?> >

						</div>
						<div class="col-md-6 mb-3">
							<label for="lastName"><h6>Ihre Nachname</h6></label>
							<input type="text" class="form-control" id="lastName" name="nachname"  value=<?php echo '"'.$user->getNachname().'"';?>>

						</div>
					</div>

        <div class="mb-3">
          <label for="email"><h6>Ihre Email</h6></label>
          <input type="email" class="form-control" id="email" name="email" value=<?php echo '"'.$user->getEmail().'"';?>>
        </div>

        <div class="row">
          <div class="col-md-6 mb-3">
            <label for="pass"><h6>alte Passwort<h6></label>
  					<input type="password" class="form-control" id="pass" name="altpasswort"style="width:170%">
            <?php
              if(isset($_SESSION['passwort_falsch'])){
                echo '<p style="color:red">'.$_SESSION['passwort_falsch'].'</p>';
                unset($_SESSION['passwort_falsch']);
              }
             ?>
          </div>
          <div class="col-md-6 mb-3">
            <label for="pass"><h6>neue Passwort<h6></label>
  					<input type="password" class="form-control" id="pass" name="neupasswort"style="width:170%" required>

          </div>
        </div>

        <div class="mb-3">
          <label for="address"><h6>Ihre Address<h6></label>
          <input type="text" class="form-control" id="address" placeholder="goblinstraße-3 66117 saarland" name="adresse" style="width:170%" value=<?php echo '"'.$user->getAdresse().'"';?>>
        </div>
        <hr class="mb-4">
           <button class="btn btn-primary btn-lg btn-block" type="submit" name="speichern" value="speichern" >Speichern</button>
		</form>
	</div>
	<br>

</div>


<br>
<br>
<br>

</main>
<footer class="text-muted" style="background-color:#212529">
	<div class="container"style="background-color:#212529">
		<p class="float-right">

			<a href="#">Back to top</a>
			<br>#diese Webseite steht immer noch in test phase (Beta)
		</p>
		<p>Diese webseit &copy; Ahmed Baffoun und Ibrahim Sentissi</p>
		<p>*diese Seite ist nur in Deutschland erreichbar</P>
	</div>
</footer>

<body style="background-color:#212529">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
