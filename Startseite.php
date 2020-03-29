<?php
	require_once("config.php");
	session_start();

	Connection::Connect();

	if(isset($_POST['abmelden'])){
		session_unset();
		header("Location: Startseite.php");
		Connection::Disconnect();
	}

	/*-------------------Database-------------------*/
	//Filme
	$joker = Connection::searchFilm("Joker");
	$morbius = Connection::searchFilm("Morbius");
	$hase = Connection::searchFilm("Peter Hase 2");
	$narziss = Connection::searchFilm("Narziss und Goldmund");
	$night = Connection::searchFilm("Night Life");
	$hotel = Connection::searchFilm("Hotel Beograd");

	$_SESSION['joker'] = $joker;
	$_SESSION['morbius'] = $morbius;
	$_SESSION['hase'] = $hase;
	$_SESSION['narziss'] = $narziss;
	$_SESSION['night'] = $night;
	$_SESSION['hotel'] = $hotel;

	//Säle
	$raum1_1 = Connection::searchRaum("139");
	$raum1_2 = Connection::searchRaum("151");
	$raum1_3 = Connection::searchRaum("152");
	$raum2_1 = Connection::searchRaum("140");
	$raum2_2 = Connection::searchRaum("153");
	$raum3_1 = Connection::searchRaum("141");
	$raum3_2 = Connection::searchRaum("154");
	$raum4_1 = Connection::searchRaum("142");
	$raum4_2 = Connection::searchRaum("155");
	$raum5_1 = Connection::searchRaum("145");
	$raum5_2 = Connection::searchRaum("156");
	$raum6_1 = Connection::searchRaum("146");
	$raum6_2 = Connection::searchRaum("157");

	$_SESSION['raum1_1'] = $raum1_1;
	$_SESSION['raum1_2'] = $raum1_2;
	$_SESSION['raum1_3'] = $raum1_3;
	$_SESSION['raum2_1'] = $raum2_1;
	$_SESSION['raum2_2'] = $raum2_2;
	$_SESSION['raum3_1'] = $raum3_1;
	$_SESSION['raum3_2'] = $raum3_2;
	$_SESSION['raum4_1'] = $raum4_1;
	$_SESSION['raum4_2'] = $raum4_2;
	$_SESSION['raum5_1'] = $raum5_1;
	$_SESSION['raum5_2'] = $raum5_2;
	$_SESSION['raum6_1'] = $raum6_1;
	$_SESSION['raum6_2'] = $raum6_2;

	//Termine
	$termin1_1 = Connection::searchTermin("127");
	$termin1_2 = Connection::searchTermin("140");
	$termin1_3 = Connection::searchTermin("128");

	$termin2_1 = Connection::searchTermin("129");
	$termin2_2 = Connection::searchTermin("130");

	$termin3_1 = Connection::searchTermin("132");
	$termin3_2 = Connection::searchTermin("133");

	$termin4_1 = Connection::searchTermin("134");
	$termin4_2 = Connection::searchTermin("135");

	$termin5_1 = Connection::searchTermin("136");
	$termin5_2 = Connection::searchTermin("137");

	$termin6_1 = Connection::searchTermin("138");
	$termin6_2 = Connection::searchTermin("139");


	$_SESSION['termin1_1'] = $termin1_1;
	$_SESSION['termin1_2'] = $termin1_2;
	$_SESSION['termin1_3'] = $termin1_3;

	$_SESSION['termin2_1'] = $termin2_1;
	$_SESSION['termin2_2'] = $termin2_2;

	$_SESSION['termin3_1'] = $termin3_1;
	$_SESSION['termin3_2'] = $termin3_2;

	$_SESSION['termin4_1'] = $termin4_1;
	$_SESSION['termin4_2'] = $termin4_2;

	$_SESSION['termin5_1'] = $termin5_1;
	$_SESSION['termin5_2'] = $termin5_2;

	$_SESSION['termin6_1'] = $termin6_1;
	$_SESSION['termin6_2'] = $termin6_2;

	if(isset($_SESSION['user'])){
		$user = $_SESSION['user'];
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

	<title >Startseite</title>

	<!-- Favicons -->
	<link rel="apple-touch-icon" href="/docs/4.4/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
	<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
	<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
	<link rel="manifest" href="/docs/4.4/assets/img/favicons/manifest.json">
	<link rel="mask-icon" href="/docs/4.4/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
	<link rel="icon" href="/docs/4.4/assets/img/favicons/favicon.ico">
	<meta name="msapplication-config" content="/docs/4.4/assets/img/favicons/browserconfig.xml">
	<meta name="theme-color" content="#563d7c">


		<style>

		.form-popup {
  display: none;
  background-color:#D3D3D3;
  border: 3px solid background-color:#D3D3D3;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}


/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #4CAF50;
  color: blau;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

		</style>
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
	<main style="background-color: #1d1e22 "  role="main">
		<div  class="container">
			<div id="demo" class="carousel slide" data-ride="carousel">

				<!-- Indicators -->
				<ul class="carousel-indicators">
					<li data-target="#demo" data-slide-to="0" class="active"></li>
					<li data-target="#demo" data-slide-to="1"></li>
					<li data-target="#demo" data-slide-to="2"></li>
					<li data-target="#demo" data-slide-to="3"></li>
				</ul>
				<!-- The slideshow -->
				<div class="carousel-inner">
					<div class="carousel-item active">
						<div class="info-container">
							<img src=<?php echo '"http://'.$image_path.'Jumanji.jpg"';?> alt="Los Angeles" width="1100" height="550">
								<div style="color:#B1A296" class="slide-title h2 col-xs-24">Demnächst verfügbar</div>
						</div>
					</div>

					<div class="carousel-item">
						<img src=<?php echo '"http://'.$image_path.'Aladdin.jpg"';?> alt="Chicago" width="1100" height="550">
							<div style="color:#B1A296"class="slide-title h2 col-xs-24">Demnächst verfügbar</div>
					</div>

					<div class="carousel-item">
						<img src=<?php echo '"http://'.$image_path.'Scary.jpg"';?> alt="Chicago" width="1100" height="550">
							<div style="color:#B1A296"class="slide-title h2 col-xs-24">Demnächst verfügbar</div>
					</div>

					<div class="carousel-item">
						<img src=<?php echo '"http://'.$image_path.'Bloodshot.jpg"';?> alt="Chicago" width="1100" height="550">
							<div style="color:#B1A296"class="slide-title h2 col-xs-24">Demnächst verfügbar</div>
					</div>

				</div>

				<!-- Left and right controls -->
				<a class="carousel-control-prev" href="#demo" data-slide="prev">
					<span class="carousel-control-prev-icon"></span>
				</a>
				<a class="carousel-control-next" href="#demo" data-slide="next">
					<span class="carousel-control-next-icon"></span>
				</a>
			</div>



		<div class="album py-5 bg-light"   >
			<div class="container">
				<div class="row">
					<div id="joker"class="col-md-4">
						<div class="card mb-4 shadow-sm">
							<img src=<?php echo '"'.$joker->getImage().'"';?>style="height: 477px;"alt="Joker">
							<div class="card-body" style="background-color:#D3D3D3">
								<p class="card-text" style="font-family:Roboto, sans-serif" > <?php echo "<i>".$joker->getBeschreibung()."</i>";?></p>
								<p class="card-text" style="font-family:arial"> <b>Genre:</b>Krimi, Action</p>
								<p class="card-text"> <b>Filmstart:</b> <?php echo $joker->convertDatum();?></p>
								<p class="card-text"> <b>Dauer:</b> <?php echo $joker->getDauer();?> min.</p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">
											<button id="hotelres"type="button" class="btn btn-sm btn-outline-secondary"onclick="openForm3()">Reservieren</button>
										</div>
								</div>
								<div class="form-popup" id="RF3">
									<form action="Reservation.php" method="get">
										<button type="submit" class="btn btn-secondary" style name="termin_id" value=<?php echo '"'.$termin1_1->getId().'"';?> ><?php echo $termin1_1->convertDatum(); ?></button><br>
										<button type="submit" class="btn btn-secondary" name="termin_id" value=<?php echo '"'.$termin1_2->getId().'"';?> ><?php echo $termin1_2->convertDatum(); ?></button><br>
										<button type="submit" class="btn btn-secondary" name="termin_id" value=<?php echo '"'.$termin1_3->getId().'"';?> ><?php echo $termin1_3->convertDatum(); ?></button><br>
										<button type="button" class="btn cancel" onclick="closeForm3()" style="background-color:red">zurück</button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div class="col-md-4">
						<div id="morbius"class="card mb-4 shadow-sm">
							<img src=<?php echo '"'.$morbius->getImage().'"';?> alt="Morbius">
							<div class="card-body"style="background-color:#D3D3D3">
								<p class="card-text"style="font-family:Roboto, sans-serif"><?php echo "<i>".$morbius->getBeschreibung()."</i>";?></p>
								<p class="card-text" style="font-family:arial"> <b>Genre:</b> Action.</p>
								<p class="card-text"> <b>Filmstart:</b> <?php echo $morbius->convertDatum();?>.</p>
								<p class="card-text"> <b>Dauer:</b> <?php echo $morbius->getDauer();?> min.</p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">
										<button id="hotelres"type="button" class="btn btn-sm btn-outline-secondary"onclick="openForm1()">Reservieren</button>
									</div>
								</div>
								<div class="form-popup" id="RF1">
										<form action="Reservation.php" method="get">
										<button type="submit" class="btn btn-secondary" name="termin_id" value=<?php echo '"'.$termin2_1->getId().'"';?> ><?php echo $termin2_1->convertDatum(); ?></button><br>
										<button type="submit" class="btn btn-secondary" name="termin_id" value=<?php echo '"'.$termin2_2->getId().'"';?> ><?php echo $termin2_2->convertDatum(); ?></button><br>
										<button type="button" class="btn cancel" onclick="closeForm1()" style="background-color:red">zurück</button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div id="peterhase2"class="col-md-4">
						<div class="card mb-4 shadow-sm">
							<img src=<?php echo '"'.$hase->getImage().'"';?> alt="PeterHase">
							<div class="card-body" style="background-color:#D3D3D3">
								<p class="card-text" style="font-family:Roboto, sans-serif" > <?php echo "<i>".$hase->getBeschreibung()."</i>";?></p>
								<p class="card-text" style="font-family:arial"> <b>Genre:</b> Komödie.</p>
								<p class="card-text"> <b>Filmstart:</b> <?php echo $hase->convertDatum();?>.</p>
								<p class="card-text"> <b>Dauer:</b> <?php echo $hase->getDauer();?> mn.</p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">
										<button id="hotelres"type="button" class="btn btn-sm btn-outline-secondary" onclick="openForm2()">Reservieren</button>
									</div>
								</div>
								<div class="form-popup" id="RF2">
								<form action="Reservation.php" method="get">
										<button type="submit" class="btn btn-secondary" name="termin_id" value=<?php echo '"'.$termin3_1->getId().'"';?> ><?php echo $termin3_1->convertDatum(); ?></button><br>
										<button type="submit" class="btn btn-secondary" name="termin_id" value=<?php echo '"'.$termin3_2->getId().'"';?> ><?php echo $termin3_2->convertDatum(); ?></button><br>
										<button type="button" class="btn cancel" onclick="closeForm2()" style="background-color:red">zurück</button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div id="narziss"class="col-md-4">
						<div class="card mb-4 shadow-sm">
							<img src=<?php echo '"'.$narziss->getImage().'"';?> style="height: 477px;"alt="Narziss">
							<div class="card-body" style="background-color:#D3D3D3" >
								<p class="card-text" style="font-family:Roboto, sans-serif"><?php echo "<i>".$narziss->getBeschreibung()."</i>";?></p>
								<p class="card-text" style="font-family:arial"> <b>Genre:</b>Drama</p>
								<p class="card-text"> <b>Filmstart:</b> <?php echo $narziss->convertDatum();?>.</p>
								<p class="card-text"> <b>Dauer:</b> <?php echo $narziss->getDauer();?> mn.</p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">
										<button id="hotelres"type="button" class="btn btn-sm btn-outline-secondary"onclick="openForm4()">Reservieren</button>
									</div>


								</div>
								<div class="form-popup" id="RF4">
									<form action="Reservation.php" method="get">
										<button type="submit" class="btn btn-secondary" style name="termin_id" value=<?php echo '"'.$termin4_1->getId().'"';?> ><?php echo $termin4_1->convertDatum(); ?></button><br>
										<button type="submit" class="btn btn-secondary" name="termin_id" value=<?php echo '"'.$termin4_2->getId().'"';?> ><?php echo $termin4_2->convertDatum(); ?></button><br>
										<button type="button" class="btn cancel" onclick="closeForm4()" style="background-color:red">zurück</button>
									</form>
								</div>
							</div>
						</div>
					</div>

					<div id="nightlife"class="col-md-4">
						<div class="card mb-4 shadow-sm">
							<img src=<?php echo '"'.$night->getImage().'"';?> style="height: 477px;"alt="Nightlife">
							<div class="card-body" style="background-color:#D3D3D3" >
								<p class="card-text" style="font-family:Roboto, sans-serif"><?php echo "<i>".$night->getBeschreibung()."</i>";?></p>
								<p class="card-text" style="font-family:arial"> <b>Genre:</b>Komödie</p>
								<p class="card-text"> <b>Filmstart:</b> <?php echo $night->convertDatum();?>.</p>
								<p class="card-text"> <b>Dauer:</b> <?php echo $night->getDauer();?> mn.</p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">
										<button id="hotelres"type="button" class="btn btn-sm btn-outline-secondary"onclick="openForm()">Reservieren</button>
									</div>
								</div>
								<div class="form-popup" id="myForm">
									<form action="Reservation.php" method="get">
										<button type="submit" class="btn btn-secondary" style name="termin_id" value=<?php echo '"'.$termin5_1->getId().'"';?> ><?php echo $termin5_1->convertDatum(); ?></button><br>
										<button type="submit" class="btn btn-secondary" name="termin_id" value=<?php echo '"'.$termin5_2->getId().'"';?> ><?php echo $termin5_2->convertDatum(); ?></button><br>
										<button type="button" class="btn cancel" onclick="closeForm()" style="background-color:red">zurück</button>
									</form>
								</div>
							</div>
						</div>
					</div>


					<div id="hotel"class="col-md-4">
						<div class="card mb-4 shadow-sm">
							<img src=<?php echo '"'.$hotel->getImage().'"';?> style="height: 477px;"alt="Hotel">
							<div class="card-body" style="background-color:#D3D3D3" >
								<p class="card-text" style="font-family:Roboto, sans-serif"><?php echo "<i>".$hotel->getBeschreibung()."</i>";?></p>
								<p class="card-text" style="font-family:arial"> <b>Genre:</b>Event</p>
								<p class="card-text"> <b>Filmstart:</b> <?php echo $hotel->convertDatum();?>.</p>
								<p class="card-text"> <b>Dauer:</b> <?php echo $hotel->getDauer();?> mn.</p>
								<div class="d-flex justify-content-between align-items-center">
									<div class="btn-group">
										<button id="hotelres"type="button" class="btn btn-sm btn-outline-secondary"onclick="openForm5()">Reservieren</button>
									</div>
								</div>
								<form action="Reservation.php" method="get">
								<div class="form-popup" id="RF5">
									<button type="submit" class="btn btn-secondary" style name="termin_id" value=<?php echo '"'.$termin6_1->getId().'"';?> ><?php echo $termin6_1->convertDatum(); ?></button><br>
									<button type="submit" class="btn btn-secondary" name="termin_id" value=<?php echo '"'.$termin6_2->getId().'"';?> ><?php echo $termin6_2->convertDatum(); ?></button><br>
									<button type="button" class="btn cancel" onclick="closeForm5()" style="background-color:red">zurück</button>
								</div>
									</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>


<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}
function openForm1() {
  document.getElementById("RF1").style.display = "block";
}

function closeForm1() {
  document.getElementById("RF1").style.display = "none";
}
function openForm2() {
  document.getElementById("RF2").style.display = "block";
}

function closeForm2() {
  document.getElementById("RF2").style.display = "none";
}
function openForm3() {
  document.getElementById("RF3").style.display = "block";
}

function closeForm3() {
  document.getElementById("RF3").style.display = "none";
}
function openForm4() {
  document.getElementById("RF4").style.display = "block";
}

function closeForm4() {
  document.getElementById("RF4").style.display = "none";
}
function openForm5() {
  document.getElementById("RF5").style.display = "block";
}

function closeForm5() {
  document.getElementById("RF5").style.display = "none";
}
</script>
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
</div>
<body style="background-color:#212529">
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
