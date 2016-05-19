<?php
# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = '';  # Norādiet savu lietotājvārdu
# ja nevaram pievienoties - rakstam kļūdu paziņojumus
$d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
mysqli_set_charset($d, 'utf8');

        $pasniedzejsID = $_REQUEST["teacherName"];
		$kurssID = $_REQUEST["courseName"];

		$sql_query="INSERT INTO persona_has_kurss(Persona_idPersona, Kurss_idKurss) 
					VALUES('$pasniedzejsID','$kurssID');";
		if ($d->query($sql_query) === TRUE) {
		    ?><div class="alert alert-success" role="alert">
		 	<center><b>Kurss pievienots pasniedzēja pasniedzamo kursu sarakstā!</b></center>
		</div><?php
		} else {
		    ?><div class="alert alert-danger" role="alert">
		 	<center><b>Kurss nav pievienots pasniedzēja pasniedzamo kursu sarakstā!</b></center>
		</div><?php
		}

mysqli_close($d);
?>