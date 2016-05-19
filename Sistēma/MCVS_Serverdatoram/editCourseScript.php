<?php
# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = 'janisk';  # Norādiet savu lietotājvārdu
# ja nevaram pievienoties - rakstam kļūdu paziņojumus
$conn = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
 mysqli_set_charset($conn, 'utf8');
 
$code = $_REQUEST["code"];
$nosaukums = $_REQUEST["title"];
$apraksts = $_REQUEST["sumary"];
$tips = $_REQUEST["auditorijasTips"];
$skaits =  $_REQUEST["capacity"];
$ilgums = $_REQUEST["duration"];



	$sql = "UPDATE Kurss SET 	kursaKods = '$code', kKursaNosaukums = '$nosaukums',
								kursaApraksts = '$apraksts', nepieciesamaisAuditorijasTips = '$tips', 
								kMaksimalaisStudentuSkaits = '$skaits', kursaIlgums = '$ilgums' 
							WHERE idKurss='$code'";

	if ($conn->query($sql) === TRUE) {}

mysqli_close($conn);

?>
