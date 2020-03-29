<?php
	require_once("config.php");

	session_start();

	Connection::Connect();

	if(isset($_GET["register"])){
		$mail = $_POST["email"];
		$passwort = $_POST["passwort"];
		$adresse = $_POST["adresse"];
		$nachname = $_POST["nachname"];
		$vorname = $_POST["vorname"];
		$geburtsdatum = $_POST["geburtsdatum"];
		$geschlecht = $_POST["geschlecht"];


		$d = strtotime($geburtsdatum);
		$date = date('d.m.Y', $d);


		$u = new _User("$mail", "$passwort","$nachname", "$vorname", "$adresse", "$date", "$geschlecht");

		if(Connection::insertUser($u)){
			header("Location: Anmeldung.php");
		}
		else {
			session_unset();
		}
	}
	else {
		session_unset();
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

	<title >Regestrierung</title>

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
						<p class="text-muted"> Diese webseite ist ein exslusive Projekt für Internet Technologie.Das ProjektTeam bestehst aus 2 Studenten (Ahmed Baffoun & Ibrahim ....).</p>
						<p class="text-muted">in Unsere Webseit kann der kinoBesucher ein Ticket für film buchen sowie auch platz Reservieren. </p>
					</div>
					<div class="col-sm-4 offset-md-1 py-4">
						<h4 class="text-white">Contact</h4>
						<ul class="list-unstyled">
							<li><a  class="text-white">Unser Servicecenter ist in der aktuellen Lage nur per Email erreichbar</a></li>
							<li><a  class="text-white">diese Email kontaktieren:</a></li>
							<li><a class="text-white">ahmed_baffana@hotmail.com</a></li>
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
				<a href="Anmeldung.php" class="navbar-brand d-flex align-items-center"style="color:#F6D155">
					<strong>Anmelden</strong>
				</a>
				<!--<a href="Regestrieren.php" class="navbar-brand d-flex align-items-center"style="color:#F6D155">
					<strong>Registrieren</strong>
				</a>-->
				<button class="navbar-toggler" style="color:#F6D155" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span> Info
				</button>
			</div>
		</div>
	</header>
    <main class="bg-light" role="main" >
		<br>
		<div class="container" style="background-color:EBF7E3">
			<div class="py-5 text-center">
			<h2><u>Registrierung</u></h2>
			<p class="lead">Geben sie bitte ihre Personale Daten ein und dann auf Bestätigen drücken damit ihre Regestrierung abschließen.</p>
			</div>
			<div class="col-md-8 order-md-1">
				<h4 class="mb-3">-Mein Daten:</h4>

		<br>
		<p>*Achtung*: bitte die folgende buschtabe nicht nutzen:ü,Ü,ö,Ö,ä,Ä.
		</p>
				<!--<form  method="POST" class="needs-validation" novalidate>-->
	<form action="?register=1" method="post" class="was-validated">
		<h6> Geschlecht:</h6>
		<div class="form-check">
			<label class="form-check-label">
				<input type="radio" class="form-check-input" value="Frau" name="geschlecht">Frau
			</label>
		</div>
		<div class="form-check">
			<label class="form-check-label">
				<input type="radio" class="form-check-input" value="Herr" name="geschlecht">Herr
			</label>
		</div>
  <div class="form-group">
					<div class="row">
						<div class="col-md-6 mb-3">
							<label for="firstName"><h6>Vorname<h6></label>
							<input type="text" class="form-control" id="firstName" placeholder="" value="" name="vorname" required>
							<div class="invalid-feedback">
								Ein gültiger Nachname ist erforderlich.
							</div>
						</div>
						<div class="col-md-6 mb-3">
							<label for="lastName"><h6>Nachname<h6></label>
							<input type="text" class="form-control" id="lastName" name="nachname" placeholder="" value="" required>
							<div class="invalid-feedback">
								Ein gültiger Nachname ist erforderlich.
							</div>
						</div>
					</div>

				<div class="form-group">
                    <label for="birthDate" class="ol-md-6 mb-3" ><h6>Geburtsdatum<h6></label>
                    <div class="rows">
                        <input type="date" id="birthDate" name="geburtsdatum" max="2020-04-01" class="form-control" style="width:100%">
                    </div>
                </div>


        <div class="mb-3">
          <label for="email"><h6>Email<h6></label>
          <input type="email" class="form-control" id="email" name="email"style="width:150%" required>
          <div class="invalid-feedback">
            Ein gültiger Email ist erforderlich.
          </div>
        </div>


						<div class="mb-3">
							<label for="pass"><h6>Passwort<h6></label>
							<input type="password" class="form-control" id="pass" name="passwort"style="width:150%" required>
							<div class="invalid-feedback">
								Ein gültiger Passwort ist erforderlich.
							</div>
						</div>

        <div class="mb-3">
          <label for="address"><h6>Address<h6></label>
          <input type="text" class="form-control" id="address" style="width:150%" placeholder="goblinstraße-3 66117 saarland" name ="adresse" required>
          <div class="invalid-feedback">
            Eine gültige Adresse ist erforderlich.
          </div>
        </div>

		 <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit" name="Registrierung">Bestätigen</button>
	</div>
</div>
	</form>
</div>
<br>
</main>
<footer class="text-muted" style="background-color:#212529">
	<div class="container"style="background-color:#212529">
		<p class="float-right">

			<a href="#">Back to top</a>
			<br>#diese Webseite steht immer noch in test phase (Beta)
		</p>
		<p>Diese webseit &copy; Ahmed Baffoun</p>
		<p>*diese Seite ist nur in Deutschland erreichbar</P>
	</div>
</footer>

<body style="background-color:#212529">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>


</body>
<?php Connection::Disconnect(); ?>
</html>
