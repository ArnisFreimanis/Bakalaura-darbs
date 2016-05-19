<?php
# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = '';  # Norādiet savu lietotājvārdu
# ja nevaram pievienoties - rakstam kļūdu paziņojumus
$conn = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
mysqli_set_charset($conn, 'utf8');

$nosaukums = $_REQUEST["nosaukums"];
$tips = $_REQUEST["auditorijasTips"];
$adrese = $_REQUEST["adrese"];
$pilseta = $_REQUEST["pilseta"];
$maxSkaits = $_REQUEST["skaits"];
$tafele = $_REQUEST["tafele"];
$projektors = $_REQUEST["projektors"];
$video = $_REQUEST["video"];

	$sql = "UPDATE auditorija SET 	aNumursNosaukums = '$nosaukums', aTips = '$tips',
								aAdrese = '$adrese', aPilseta = '$pilseta', 
								aMaksimalaisStudentuSkaits = '$maxSkaits', tafele = '$tafele',
								projektors = '$projektors', video = '$video'  
							WHERE idAuditorija='$ID'";

	if ($conn->query($sql) === TRUE) {}

mysqli_close($conn);
?>