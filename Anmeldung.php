<?php
require_once("config.php");
start_session();
if(isset($_POST["submit"])){
	$mail = $_POST["email"];
	$passwort = $_POST["passwort"];
	$user = loginUser($mail, $passwort);

	if(!$user){

	}
	else {
		$user_id = $user->getId();
		$_Session["$user_id"] = $user_id;
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

	<title >Anmedlung</title>

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
				<a href="file:///C:/Users/ahmed/Desktop/Startseite.html" class="navbar-brand d-flex align-items-center" style="color:#F6D155">
					<strong>Kinoprogramm</strong>
				</a>
				<a href="Anmeldung.php" class="navbar-brand d-flex align-items-center"style="color:#F6D155">
					<strong>Anmelden</strong>
				</a>
				<a href="Regestrieren.php" class="navbar-brand d-flex align-items-center"style="color:#F6D155">
					<strong>Registrieren</strong>
				</a>
				<button class="navbar-toggler" style="color:#F6D155" type="button" data-toggle="collapse" data-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span> Info
				</button>
			</div>
		</div>
	</header>
<main class="text-center" style="background-color: #1d1e22 ">
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
    <form class="form-signin" method="post">

  <h1 class="h3 mb-3 font-weight-normal" style="color:white">Hier Anmelden</h1>
  <label for="inputEmail" class="sr-only">Email address</label>
 <center> <input type="email" id="inputEmail" class="form-control" style="width:25%" placeholder="Email address" name="email" required autofocus></center><br>

  <label for="inputPassword" class="sr-only">Kennwort</label>
  <center><input type="password" id="inputPassword" class="form-control" style="width:25%"  placeholder="Kennwort" name="passwort" required></center>
 <br>
 <br>
 <br>
  <center><button class="btn btn-lg btn-primary btn-block" style="width:15%" type="submit" name="submit">Einlogen</button></center>
  <p class="mt-5 mb-3 text-muted">&copy; 2019-2020</p>
</form>
<br>
<br>
<br>
<br>

<br>
<br>
<br>
</body>
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
		<p>Diese webseit &copy; Ahmed Baffoun</p>
		<p>*diese Seite ist nur in Deutschland erreichbar</P>
	</div>
</footer>

<body style="background-color:#212529">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
