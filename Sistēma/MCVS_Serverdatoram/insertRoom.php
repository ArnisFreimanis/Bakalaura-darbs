<?php
# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = 'janisk';  # Norādiet savu lietotājvārdu
# ja nevaram pievienoties - rakstam kļūdu paziņojumus
$d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
mysqli_set_charset($d, 'utf8');

$nosaukums = $_REQUEST["nosaukums"];
$tips = $_REQUEST["auditorijasTips"];
$adrese = $_REQUEST["adrese"];
$pilseta = $_REQUEST["pilseta"];
$maxSkaits = $_REQUEST["skaits"];
$tafele = $_REQUEST["tafele"];
$projektors = $_REQUEST["projektors"];
$video = $_REQUEST["video"];


		$sql_query="INSERT INTO Auditorija(aNumursNosaukums, aTips, aAdrese, aPilseta, aMaksimalaisStudentuSkaits, tafele, projektors, videoKonference) 
					VALUES('$nosaukums','$tips','$adrese','$pilseta','$maxSkaits', '$tafele', '$projektors', '$video');";
		if (mysqli_query($d, $sql_query)) {
			?><div class="alert alert-success" role="alert">
			 	<center><b>Auditorija veiksmīgi pievienota!</b></center>
			</div><?php
		} else {
			?><div class="alert alert-success" role="alert">
			 	<center><b>Auditorija nav pievienota!</b></center>
			</div><?php
		}
mysqli_close($d);
?>