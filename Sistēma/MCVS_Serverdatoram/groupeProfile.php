<?php
        include('login.php');      
        $username = $_SESSION['login_user']; 
if($username == ""){
    header("Location: index.php");
    session_destroy();
}
else{

        $MGID=$_REQUEST['MGID'];
        $_SESSION['MGID'] = $MGID;
        include('header.php');
        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
        mysqli_set_charset($mysqli, 'utf8');
        $resultSet  =$mysqli->query("SELECT * FROM MacibuGrupa WHERE idMacibuGrupa ='$MGID'");
        if($resultSet->num_rows !=0){
            while($rows = $resultSet->fetch_assoc()){ 
                $KurssID = $rows['Kurss_idKurss'];
                $AuditorijaID = $rows['Auditorija_idAuditorija'];
                $nosaukums = $rows['mGrupasNosaukums'];
                $datumsNo = $rows['mgDatumsNo'];
                $datumsLidz = $rows['mgDatumsLidz'];
            }
        }
        $resultSetKurss = $mysqli->query("SELECT * FROM Kurss WHERE idKurss ='$KurssID'");
        if($resultSetKurss->num_rows !=0){
            while($rows = $resultSetKurss->fetch_assoc()){ 
                $kursaNosaukums = $rows['kKursaNosaukums'];
                $kursaApraksts = $rows['kursaApraksts'];
            }
        }
        $resultSetAuditorija = $mysqli->query("SELECT * FROM Auditorija WHERE idAuditorija ='$AuditorijaID'");
        if($resultSetAuditorija->num_rows !=0){
            while($rows = $resultSetAuditorija->fetch_assoc()){ 
                $auditorijasNosaukums = $rows['aNumursNosaukums'];
                $adrese = $rows['aAdrese'];
                $pilseta = $rows['aPilseta'];
            }
        }

    ?>

    <div class = "container">
    <div class="page-header">
      <br><h1><?php echo "$nosaukums"; ?></h1>
    </div>
    <div class="row">
        <table class="table" width="100%">
            <tbody>
            <tr>
                <td><?php echo "<b>Apgustamais kurss : </b> $kursaNosaukums" ?></td>
            </tr>
            <tr>
                <td><?php echo "<b>Kursa apraksts: </b> $kursaApraksts" ?></td>
            </tr>
            <tr>
                <td><?php echo "<b>Norises auditorija: </b> $auditorijasNosaukums" ?></td>
            </tr>
            <tr>
                <td><?php echo "<b>Auditorija atrodas: </b> $pilseta, $adrese" ?></td>
            </tr>
            <tr>
                <td><?php echo "<b>Norisināsies no </b> $datumsNo <b> līdz </b> $datumsLidz" ?></td>
            </tr>
            </tbody>
        </table>

    <div class="page-header">
        <h1><small>personas kas pievienotas grupai</small></h1>
    </div>
    <div class="row">
    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead style="background-color: #337ab7; border-color: #337ab7; color:#fff;">
        <th><center>Nr.</center></th>
        <th><center>Vārds</center></th>
        <th><center>Uzvārds</center></th>
        <th><center>e-pasts</center></th>
        <th><center>Tālrunis</center></th> 
        <th><center><span class="glyphicon glyphicon-cog" aria-hidden="true"></span></center></th>    
    </thead>
    <tbody>
    <tr>
    <?php
    $tmp = 0;
    $x = 0;

        $resultGrupa = $mysqli->query("SELECT * FROM Persona_has_MacibuGrupa WHERE MacibuGrupa_idMacibuGrupa = '$MGID' ");  
        if($resultGrupa->num_rows > 0){
            while($rows = $resultGrupa->fetch_assoc()){ 
                $IDmGrupaPersona = $rows['Persona_idPersona'];
                $resultPersona=$mysqli->query("SELECT * FROM Persona WHERE idPersona = '$IDmGrupaPersona'");
            if ($resultPersona->num_rows > 0) {
                while($row = $resultPersona->fetch_assoc()) {
                $tmp = $tmp +1;
                ?><td><center><?php echo $tmp; ?></center></td>
                <td><center><?php echo $row["vards"] ?></center></td>
                <td><center><?php echo $row["uzvards"] ?></center></td>
                <td><center><?php echo $row["talrunis"] ?></center></td>
                <td><center><?php echo $row["personasKods"] ?></center></td>
                <td><center><a href="deleteStudentScript.php?PK=<?php echo $row["personasKods"]; ?>"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></center></td></tr> <?php
                }
            } else {
                $x = 404;
            }
        }    
        }
     
    ?>
    </tbody>
    </table>
</div>
</div>

<?php include('footer.php'); 
}
?>