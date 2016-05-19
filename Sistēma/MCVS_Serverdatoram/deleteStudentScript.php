<?php
session_start();
# Veidojam savienojumu ar savu serveri un datu bāzi
$myServer = 'localhost';
$myDB = 'mcvs_db'; # Norādiet savu datu bāzi
$myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
$myPass = 'janisk';  # Norādiet savu lietotājvārdu
# ja nevaram pievienoties - rakstam kļūdu paziņojumus

$link = mysqli_connect($myServer,$myUser,$myPass,$myDB);
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
mysqli_set_charset($link, 'utf8');


$PK=$_REQUEST['PK'];
$MGID = $_SESSION['MGID'];
echo $PK;
echo $MGID;
  $sql="DELETE FROM Persona_has_MacibuGrupa WHERE Persona_idPersona ='$PK' AND MacibuGrupa_idMacibuGrupa = '$MGID'"; 

 if(mysqli_query($link, $sql)){
    echo "Records were deleted successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}

mysqli_close($link);
?>