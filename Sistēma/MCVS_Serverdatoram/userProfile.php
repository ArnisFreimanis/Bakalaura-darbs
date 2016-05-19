<?php
        include('login.php');      
        $username = $_SESSION['login_user']; 
if($username == ""){
    header("Location: index.php");
    session_destroy();
}
else{

        $PK=$_REQUEST['PK'];

        include('header.php');
        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
        mysqli_set_charset($mysqli, 'utf8');
        $resultSet  =$mysqli->query("SELECT * FROM Persona  WHERE personasKods='$PK' ");
        if($resultSet->num_rows !=0){
            while($rows = $resultSet->fetch_assoc()){ 
                $ID = $rows['idPersona'];
                $name = $rows['vards'];
                $surname = $rows['uzvards'];
                $mail = $rows['epasts'];
                $phone = $rows['talrunis'];
                $city = $rows['dzivesPilseta']; 
                $adress = $rows['dzivesAdrese'];
                $cityWork = $rows['darbaPilseta']; 
                $workplaceAdress = $rows['darbaAdrese'];
                $foto = $rows['foto'];
                if (empty($foto)) $foto = "atteli/defaultPerson.png";
                $role = $rows['lietotajaLoma'];
            }
        }
    $KurssID1 = array();
    $KurssID2 = array();
    $resultSet3 = $mysqli->query("SELECT *
                                    FROM Persona_has_Kurss 
                                    LEFT JOIN Persona
                                    ON Persona_has_Kurss.Persona_idPersona = Persona.idPersona
                                    WHERE Persona.lietotajaLoma =  'L'");

                                if($resultSet3->num_rows >0){
                                    while($rows = $resultSet3->fetch_assoc()){
                                        $KurssID1[] = $rows['Kurss_idKurss'];
                                    }   
                                }
    $resultSet5 = $mysqli->query("SELECT *
                                    FROM Persona_has_Kurss 
                                    LEFT JOIN Persona
                                    ON Persona_has_Kurss.Persona_idPersona = Persona.idPersona
                                    WHERE Persona.lietotajaLoma =  'P'");

                                if($resultSet3->num_rows >0){
                                    while($rows = $resultSet3->fetch_assoc()){
                                        $KurssID2[] = $rows['Kurss_idKurss'];
                                    }   
                                }
                          
    ?>

    <div class = "container">
    <div class="page-header">
      <br><h1><?php echo "$name $surname"; ?></h1>
    </div>
    <div class="row">
            <table class="table" width="100%">
                <tbody>
                <tr>
                    <td width="35%"><center><b>e-pasts</b></center></td>        
                    <td width="35%"><?php echo $mail ?></td>
                    <td rowspan="4"><center><?php echo '<img class="img-responsive center-block" style="border: 2px solid #DDD;" src="data:image/jpeg;base64,' . base64_encode($foto) . '" width="180"'; ?></center></td>
                </tr>
                <tr>        
                    <td><center><b>tālrunis</b></center></td>
                    <td><?php echo  $phone ?></td>
                </tr>
                <tr>        
                    <td><center><b>dzīvesvietas adrese</b></center></td>
                    <td><?php echo "$adress, $city" ?></td>
                </tr>
                <tr>        
                    <td><center><b>darbavietas adrese</b></center></td>
                    <td><?php echo  "$workplaceAdress, $cityWork" ?></td>
                </tr>
                        <?php
                        if($role == 'L'){
                            ?>
                            <tr>        
                                <td><center><b>apgūtie kursi</b></center></td>
                                <td>
                                    <?php 
                                        for($i = 0; $i < sizeof($KurssID1);$i++){
                                            $resultSet4 = $mysqli->query("SELECT * FROM Kurss WHERE idKurss = '$KurssID1[$i]'");
                                            if($resultSet4->num_rows !=0){
                                                while($rows = $resultSet4->fetch_assoc()){ 
                                                    $kursaNosaukums = $rows['kKursaNosaukums'];
                                                    echo "$kursaNosaukums, ";
                                                }
                                            }
                                        }
                                    ?>
                                </td>
                            </tr>
                            <?php
                        }
                        else if($role == 'P'){
                            ?>
                            <tr>        
                                <td><!-- <center><b>pasniedzamie kursi</b></center> --></td>
                                <td>
                                    <?php      
                                        // $resultSetPasniedz = $mysqli->query("SELECT * FROM persona_has_kurss WHERE Persona_idPersona = '$ID'");
                                        // if($resultSetPasniedz->num_rows !=0){
                                        // while($rows = $resultSetPasniedz->fetch_assoc()){ 
                                        //     $kursaID = $rows['Kurss_idKurss'];
                                        //     $resultSetKurss = $mysqli->query("SELECT * FROM kurs WHERE idKurss = '$kursaID'");
                                        //         if($resultSetKurss->num_rows > 0){
                                        //         while($rows = $resultSetKurss->fetch_assoc()){ 
                                        //             echo $rows['kKursaNosaukums'];
                                                
                                        //     }
                                        // }
                                        //     }
                                        // }
                                        
                                    ?>
                                </td>
                            </tr><?php
                        }
                    ?>
                    </tbody>
    </table>
    <div class="page-header">
        <h1><small>personas noslogojums</small></h1>
    </div>
    <div class="row">

    <div class="panel panel-default">
            <div id="tablePanelBody" class="panel-body" style="padding: 0;">
                <table class="table table-bordered table-hover specialCollapse">
                    <tr style = "background-color:#337ab7; color:#fff">
                        <th style="border-right: 1px solid #ddd; border-bottom:0;"><center>Nr.</center></th>    
                        <th style="border-right: 1px solid #ddd; border-bottom:0;"><center>Aktivitāte</center></th>
                        <th style="border-right: 1px solid #ddd; border-bottom:0;"><center>Datums no</center></th>
                        <th style="border-right: 1px solid #ddd; border-bottom:0;"><center>Datums līdz</center></th>
                    </tr>
                    <tr>
            <?php
            $tmp = 0;
            $x = 0;
            
            $resultNoslogojums=$mysqli->query("SELECT * FROM Persona_has_MacibuGrupa WHERE Persona_idPersona='$ID' ");
            if($resultNoslogojums->num_rows !=0){
                while($rows = $resultNoslogojums->fetch_assoc()){ 
                    $IDmGrupa = $rows['MacibuGrupa_idMacibuGrupa'];
                    $resultMacibuGrupa=$mysqli->query("SELECT * FROM MacibuGrupa WHERE  idMacibuGrupa='$IDmGrupa'");
                        if ($resultMacibuGrupa->num_rows > 0) {
                            while($row = $resultMacibuGrupa->fetch_assoc()) {
                                $tmp = $tmp +1;
                                echo "<td><center>" . $tmp. "</center></td><td><center>" . $row["mGrupasNosaukums"]. "</center></td><td><center>" . $row["mgDatumsNo"]. "</center></td><td><center>" . $row["mgDatumsLidz"]."</center></td></tr>";
                            }
                        } else {
                            $x = 404;
                        }
                }
            }
            ?>  
                    
                </table>
            </div>
        </div>
    </div>
</div>
</div>

<?php include('footer.php'); 
}
?>