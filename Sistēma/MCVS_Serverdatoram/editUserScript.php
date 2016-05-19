<?php
# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = 'janisk';  # Norādiet savu lietotājvārdu
# ja nevaram pievienoties - rakstam kļūdu paziņojumus
$conn = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
mysqli_set_charset($conn, 'utf8');
 
$vards = $_REQUEST["vards"];
$uzvards = $_REQUEST["uzvards"];
$vardsMazieBurti = mb_strtolower($vards, 'UTF-8');
$uzvardsMazieBurti = mb_strtolower($uzvards, 'UTF-8');
$epasts =  $vardsMazieBurti .".". $uzvardsMazieBurti .'@mcvs.lv';
$talrunis = $_REQUEST["talrunis"];
$persKods =  $_REQUEST["personasKods"];
$dzivesAdrese = $_REQUEST["dzivesAdrese"];
$dzivesPilseta = $_REQUEST["dzivesPilseta"];
$darbaAdrese =  $_REQUEST["darbaAdrese"];
$darbaPilseta =  $_REQUEST["darbaPilseta"];
$lietotajvards = $vardsMazieBurti .".". $uzvardsMazieBurti;
$loma = $_REQUEST["loma"];


	$sql = "UPDATE Persona SET 	vards = '$vards', uzvards = '$uzvards', epasts = '$epasts', 
								talrunis = '$talrunis', personasKods = '$persKods', 
								dzivesAdrese = '$dzivesAdrese', dzivesPilseta = '$dzivesPilseta', 
								darbaAdrese = '$darbaAdrese', darbaPilseta = '$darbaPilseta',
								lietotajaLoma = '$loma', lietotajvards = '$lietotajvards' 
							WHERE idPersona='$ID'";

	if ($conn->query($sql) === TRUE) {}
	
mysqli_close($conn);
?>