<?php
session_start();
# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = '';  # Norādiet savu lietotājvārdu
# ja nevaram pievienoties - rakstam kļūdu paziņojumus

$mysqli = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Nevaru pievienoties datubāzei');
mysqli_set_charset($mysqli, 'utf8');


$PK=$_REQUEST['PK'];
$group_Name = $_SESSION['groupName'];
$vaiIr = 0;
$irPievienots = 99;
$_SESSION['irPievienots'] = $irPievienots;
#Pēc personas koda atrodu personu
$resultSetForPerson =$mysqli->query("SELECT * FROM persona WHERE personasKods='$PK'");
if($resultSetForPerson->num_rows !=0){
    while($rows = $resultSetForPerson->fetch_assoc()){ 
        $IDpersona = $rows['idPersona'];		#nolasu ID ko rakstīšu datubāzē
        $loma = $rows['lietotajaLoma'];		#nolasu, lomu, kas nepieciešama datubāzei
        $epasts = $rows['epasts'];   #nolasu epasta daresi lai nosutitu epastu
   }
}
#Salīdzinu lomas
if($loma == 'P'){	#Ja loma ir P, jeb pasniedzējs tad ierakstīs J (jā)
	$vaiIr = 'J';
}else{				#Ja jebkura cita loma tad ierakstīs N (nē)
	$vaiIr = 'N';
}
#Pēc grupas nosaukum atrod tās ID, itkā nav labakais variants, bet cerams pagaidām derēs
$resultSetForGroup =$mysqli->query("SELECT * FROM macibugrupa WHERE mGrupasNosaukums='$group_Name'");
if($resultSetForGroup->num_rows !=0){
    while($rows = $resultSetForGroup->fetch_assoc()){ 
		  $IDgrupai = $rows['idMacibuGrupa'];
      $mgDatumsNo = $rows['mgDatumsNo'];
      $mgDatumsLidz = $rows['mgDatumsLidz'];
   }
}
        $myServer = 'localhost';
        $myDB = 'mcvs_db'; # Norādiet savu datu bāzi
        $myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
        $myPass = '';  # Norādiet savu lietotājvārdu                     
        $d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Kļūda pieslēdzoties datubāzei!');

        mysqli_set_charset($d, 'utf8');
		$sql_query="INSERT INTO persona_has_macibugrupa(Persona_idPersona, MacibuGrupa_idMacibuGrupa, vaiIrPasniedzejs) VALUES ('$IDpersona','$IDgrupai','$vaiIr');";		
		if (mysqli_query($d, $sql_query)) {
			header("Location: addStudent.php");

      # --------------------------AIZSUTA_EPASTU ------------------------
     
      $subject = 'Jaunas apmācības no MCVS';
      $message = 'Sveiki, Jūs tikāt pievienots mācību grupai: $group_Name . 
                  Apmācības norisināsies no $mgDatumsNo līdz $mgDatumsLidz .
                  Vairāk varat uzināt pieslēdoties sistēmai.';
      $headers =  'From: pasniedzejs@mcvs.com' . "\r\n" .
                  'Reply-To: pasniedzejs@mcvs.com' . "\r\n";

      mail($epasts, $subject, $message, $headers);
		} else {
      echo "Neizdevas";
			//header("Location: addStudent.php");
		}
mysqli_close($mysqli);
?>