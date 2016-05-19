<?php
        include('login.php');      
        $username = $_SESSION['login_user']; 
if($username == ""){
    header("Location: index.php");
    session_destroy();
}
else{

        $AudID=$_REQUEST['AudID'];

        include('header.php');
        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
        mysqli_set_charset($mysqli, 'utf8');
        $resultSet  =$mysqli->query("SELECT * FROM Auditorija WHERE idAuditorija='$AudID' ");
        if($resultSet->num_rows !=0){
            while($rows = $resultSet->fetch_assoc()){ 
                $ID = $rows['idAuditorija'];
                $nosaukums = $rows['aNumursNosaukums'];
                $tips = $rows['aTips'];
                $adrese = $rows['aAdrese'];
                $pilseta = $rows['aPilseta'];
                $skaits = $rows['aMaksimalaisStudentuSkaits'];
                $tafele = $rows['tafele'];
                $projektors = $rows['projektors']; 
                $video = $rows['videoKonference']; 
            }
        }
        $sql = "SELECT * FROM AuditorijaNoslogojums WHERE Auditorija_idAuditorija='$ID' ORDER BY aDatums, aLaiksNo";
        $resultAudNoslogojums = $mysqli->query($sql);
    ?>

    <div class = "container">
    <div class="page-header">
      <br><h1><?php echo "$nosaukums"; ?></h1>
    </div>
    <div class="row">
        <table class="table" width="100%">
            <tbody>
            <tr>
                <td><?php echo "<b>Atrodas : </b> $pilseta, $adrese" ?></td>
            </tr>
            <tr>        
                <td><b>Auditorijas tips : </b>
                <?php if($tips == 'D'){
                            echo "Datorauditorija";
                        }else{
                            echo "Auditorija";
                        }?>
                    </td>
                </tr>
                <tr>
                    <td><?php echo "<b>Sēdvietas: </b> $skaits" ?></td>
                </tr>
                <tr>
                    <td><?php echo "<b>Tāfele : </b>"; 
                    if($tafele == '1'){
                        echo "Ir";
                    }
                    else{
                        echo "Nav";
                    }
                    ?></td>
                </tr>
                <tr>
                    <td><?php echo "<b>Projektors</b> : "; 
                    if($projektors == '1'){
                        echo "Ir";
                    }
                    else{
                        echo "Nav";
                    }
                    ?></td>
                </tr>
                <tr>
                    <td><?php echo "<b>Video konference</b> : "; 
            if($video == '1'){
                echo "Ir";
            }
            else{
                echo "Nav";
            }
            ?></td>
                </tr>
            </tbody>
        </table>
    <div class="page-header">
        <h1><small>auditorijas noslogojums</small></h1>
    </div>
    <div class="row">

    <div class="panel panel-default">
            <div id="tablePanelBody" class="panel-body" style="padding: 0;">
                <table class="table table-bordered table-hover specialCollapse">
                    <tr style = "background-color:#337ab7; color:#fff">
                        <th style="border-right: 1px solid #ddd; border-bottom:0;"><center>Nr.</center></th>    
                        <th style="border-right: 1px solid #ddd; border-bottom:0;"><center>Aktivitātes datums</center></th>
                        <th style="border-right: 1px solid #ddd; border-bottom:0;"><center>Datums no</center></th>
                        <th style="border-right: 1px solid #ddd; border-bottom:0;"><center>Datums līdz</center></th>
                    </tr>
                    <tr>
            <?php
            $tmp = 0;
            $x = 0;
            
            if ($resultAudNoslogojums->num_rows > 0) {
                while($row = $resultAudNoslogojums->fetch_assoc()) {
                    $tmp = $tmp +1;
                    ?> 
                    <td><center><?php echo $tmp ?></center></td>
                    <td><center><?php echo $row["aDatums"] ?></center></td>
                    <td><center><?php echo $row["aLaiksNo"] ?></center></td>
                    <td><center><?php echo $row["aLaiksLidz"] ?></center></td>
                    </tr><?php
                }
            } else {
                $x = 404;
            }
            
            if($x == 404){
                ?> <td colspan="4"><center><h3 class="text-danger">Auditorija tuvākajā laikā nav aizņemta!</h3></center></td></tr> <?php
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