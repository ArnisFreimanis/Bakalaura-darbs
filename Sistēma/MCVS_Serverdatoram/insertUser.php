<?php
# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = 'janisk';  # Norādiet savu lietotājvārdu
# ja nevaram pievienoties - rakstam kļūdu paziņojumus
$d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
mysqli_set_charset($d, 'utf8');

    
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
$foto=addslashes (file_get_contents($_FILES['foto']['tmp_name']));
$lietotajvards = $vardsMazieBurti .".". $uzvardsMazieBurti;
$loma = $_REQUEST["loma"];

$bytes = openssl_random_pseudo_bytes(4);
$parole = bin2hex($bytes);



		$sql_query="INSERT INTO Persona(vards, uzvards, epasts, talrunis, personasKods, dzivesAdrese, 
										dzivesPilseta, darbaAdrese, darbaPilseta, foto, lietotajaLoma, lietotajvards, parole) 
					VALUES('$vards','$uzvards','$epasts', '$talrunis', '$persKods', '$dzivesAdrese', '$dzivesPilseta'
							, '$darbaAdrese', '$darbaPilseta','$foto' ,'$loma', '$lietotajvards', '$parole');";
		if (mysqli_query($d, $sql_query)) {
    		?><div class="alert alert-success" role="alert">
		 		<center><b>Persona veiksmīgi pievienota!</b></center>
			</div><?php
		} else {
		    ?><div class="alert alert-success" role="alert">
		 		<center><b>Persona nav pievienota!</b></center>
			</div><?php
		}
	
mysqli_close($d);
?>