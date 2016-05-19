<?php
include('login.php');      
$username = $_SESSION['login_user']; 
if($username == ""){
    header("Location: index.php");
    session_destroy();
}
else{
	include('header.php');
?>


    <div class = "container">
        <div class="page-header">
            <br><h1>Jaunas mācību grupas pievienošana</h1>
        </div>
    <div class="panel panel-default">
     
		<form action="http://http://84.237.230.221//MCVS/groupPlanning.php" method="post" data-toggle="validator" role="form">
        <table class="table">
        <tr>
            <td style="position: relative;top: 50%;transform: translateY(10%);">
                <label style="display:block; width:x; height:y; text-align:center;">Izvēlieties mācību kursu:</label>
            </td>
            <td>
                <select input style="width:100%; height:30px;" class="selectpicker" id="gpCourseList" name="gbCourseListName">
                    <?php                    
                    //Ja tiek apstiprināts kurss, tikai tā vērtība tiek atlasīta sarakstā
                    if (isset($_POST['gpCourseAcceptButton'])) {
                        ?>
                        <option value="<?php echo $_POST['gbCourseListName']; ?>">
                            <?php echo $_POST['gbCourseListName']; ?>
                        </option>
                        <?php
                    }
                    //Ja kurss netiek apstiprināts un notiek kāda cita darbība, 
                    //tiek ielasīts pilns kursa saraksts
                    else {
                        ?>
                        <option value=""></option>
                        <?php
                        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
						mysqli_set_charset($mysqli, 'utf8');
                        $resultSet  =$mysqli->query("SELECT * FROM Kurss");
                        
                        if($resultSet -> num_rows != 0) {                
                            while($rows = $resultSet -> fetch_assoc()) {
                                ?>
                                <option value="<?php echo $rows['kKursaNosaukums']; ?>">
                                    <?php echo $rows['kKursaNosaukums']; ?>
                                </option>
                                <?php
                            }
                        }
                    }
                    ?>
                </select>
            </td>
            <td>
                <button type="submit" class="btn btn-warning" name="gpCourseAcceptButton" id="gpCourseAcceptButton" value="Apstiprināt" style="width:200px; background-color: #337ab7; border-color: #337ab7; background-image: linear-gradient(to bottom,#337ab7 0,#337ab7 100%);">Apstiprināt</button>
            </td>
        </tr>
        <tr>
            <td style="position: relative;top: 50%;transform: translateY(10%);">
                <label id="gpTeacherLabel" style="display:block; width:x; height:y; text-align:center;">Izvēlieties pasniedzēju:</label>
            </td>
            <td>
                <select style="width:100%; height:30px;" id="gpTeacherList" name="gpTeacherListName">
                    <?php
                        //Pēc kursa izvēles tiek ielasīti sarakstā attiecīgie pasniedzēji
                        if (isset($_POST['gpCourseAcceptButton'])) {
                            ?>
                            <option value=""></option>
                            <?php
                            
                            $selectedCourse = $_POST['gbCourseListName'];
                        
                            $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
							mysqli_set_charset($mysqli, 'utf8');
                            $resultSet1 = $mysqli->query("SELECT idKurss 
                            FROM Kurss 
                            WHERE kKursaNosaukums='$selectedCourse'");
        
                            if($resultSet1->num_rows !=0){
                                while($rows1 = $resultSet1->fetch_assoc()){
                                    $selectedCourseId = $rows1['idKurss'];
                                    
                                    $resultSet2 = $mysqli->query("SELECT Persona.vards, Persona.uzvards, Persona.personasKods
                                    FROM Persona
                                    LEFT JOIN Persona_has_Kurss 
                                    ON Persona.idPersona = Persona_has_Kurss.Persona_idPersona
                                    WHERE Persona.lietotajaLoma =  'P' 
                                    AND Persona_has_Kurss.Kurss_idKurss = '$selectedCourseId'");
                        
                                    if($resultSet2 -> num_rows != 0) {
                                        while($rows = $resultSet2 -> fetch_assoc()) {           
                                            ?>
                                            <option value="<?php echo $rows['vards'] . " " . $rows['uzvards'] . " " . $rows['personasKods']; ?>">
                                                <?php echo $rows['vards'] . " " . $rows['uzvards'] . " " . $rows['personasKods']; ?>
                                            </option>
                                            <?php
                                        }
                                    }   
                                }
                            }
                        }        
                    ?>
                    </select>
            </td>
            <td>
                <!-- <span style="padding-left: 20px"></span><input type="submit" id="gpTeacherAcceptButton" name="gpTeacherAcceptButton" value="Apstiprināt"> -->
            </td>
        </tr>
        <tr>
            <td style="position: relative;top: 50%;transform: translateY(10%);">
                <label id="gpRoomLabel" style="display:block; width:x; height:y; text-align:center;">Izvēlieties auditoriju:</label>
            </td>
            <td>
                <select id="gpRoomList" name="gpRoomListName" style="width:100%; height:30px;">
                    <?php
                        //Ja tiek izvēlēts kurss, 
                        //lietotājam tiek piedāvāts atbilstošs auditoriju saraksts
                        if (isset($_POST['gpCourseAcceptButton'])) {
                            ?>
                            <option value=""></option>
                            <?php
                            
                            $selectedCourse = $_POST['gbCourseListName'];
                        
                            $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
							mysqli_set_charset($mysqli, 'utf8');
                            $resultSet1 = $mysqli->query("SELECT nepieciesamaisAuditorijasTips 
                            FROM Kurss 
                            WHERE kKursaNosaukums='$selectedCourse'");
        
                            if($resultSet1->num_rows !=0){
                                while($rows1 = $resultSet1->fetch_assoc()){
                                    $selectedCourseType = $rows1['nepieciesamaisAuditorijasTips'];
                                    
                                    $resultSet2 = $mysqli->query("
                                    SELECT aNumursNosaukums, aAdrese, aPilseta 
                                    FROM Auditorija
                                    WHERE aTips =  '$selectedCourseType'");
                        
                                    if($resultSet2 -> num_rows != 0) {
                                        while($rows = $resultSet2 -> fetch_assoc()) {           
                                            ?>
                                            <option value="<?php echo $rows['aAdrese'] . ", " . $rows['aPilseta'] . ", " . $rows['aNumursNosaukums']; ?>">
                                                <?php echo $rows['aAdrese'] . ", " . $rows['aPilseta'] . ", " . $rows['aNumursNosaukums']; ?>
                                            </option>
                                            <?php
                                        }
                                    }   
                                }
                            }      
                        }
                    ?>
                </select>
            </td>
            <td >
                <!-- <span style="padding-left: 20px"></span><input type="submit" id="gpRoomAcceptButton" name="gpRoomAcceptButton" value="Apstiprināt"> -->
            </td>
        </tr>
                <tr >
            <td style="position: relative;top: 50%;transform: translateY(25%); width: 30%;">
                <label style="display:block; width:x; height:y; text-align:center;">Grupas nosaukums: </label>
            </td>
            <td style="width: 45%;"><input style="width:100%;" type="text" class="form-control" id="groupName" name="groupName"></td>
            <td style="width: 25%;"></td>
        </tr>
        <tr>
            <td style="position: relative;top: 50%;transform: translateY(15%);">
                <label id="gpDateLabel" style="display:block; width:x; height:y; text-align:center;">Norisināsies no</label>
            </td>
            <td colspan=2>
                <input type="date" id="gpDateFrom" name="gpDateFrom" style="width:45%; height:30px;"> <b>līdz</b> <input type="date" id="gpDateTo" name="gpDateTo" style="width:45%; height:30px;">
            </td>
        </tr>
        <tr>
        <td><button type="submit" class="btn btn-warning" name="gpCourseRefreshButton" id="gpCourseRefreshButton" value="Atjaunot" style="width:50px; background-color: #337ab7; border-color: #337ab7; background-image: linear-gradient(to bottom,#337ab7 0,#337ab7 100%);"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></button></td>
        <td></td>
        <td><button type="submit" class="btn btn-warning" name="gpCreateButton" id="gpCreateButton" value="IZVEIDOT MĀCĪBU GRUPU" style="width:200px; background-color: #337ab7; border-color: #337ab7; background-image: linear-gradient(to bottom,#337ab7 0,#337ab7 100%);">IZVEIDOT MĀCĪBU GRUPU</button></td>
        </tr>      
    </table>
    <?php 
    if (isset($_POST['gpCreateButton'])) {
        
        $groupName = $_POST['groupName'];
        $selectedCourse = $_POST['gbCourseListName'];
        $selectedRoom = $_POST['gpRoomListName'];
        $selectedRoomPieces = explode(",", $selectedRoom);
        $selectedRoomName = $selectedRoomPieces[2];
        $selectedRoomNameFinal = substr($selectedRoomName, 1);
        $dateFrom = $_POST['gpDateFrom'];
        $dateTo = $_POST['gpDateTo'];
               
        
        $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
		mysqli_set_charset($mysqli, 'utf8');
        
        
        $resultSet = $mysqli->query(
            "SELECT idKurss FROM Kurss WHERE kKursaNosaukums = '$selectedCourse'");
                        
        if($resultSet -> num_rows != 0) {                
            while($rows = $resultSet -> fetch_assoc()) {
                $selectedCourseId = $rows['idKurss'];
            }
        }
        
        $resultSet2 = $mysqli->query(
            "SELECT idAuditorija FROM Auditorija WHERE aNumursNosaukums = '$selectedRoomNameFinal'");
        
        if($resultSet2 -> num_rows != 0) {                
            while($rows = $resultSet2 -> fetch_assoc()) {
                $selectedRoomId = $rows['idAuditorija'];
            }
        }
        
        $myServer = 'localhost';
        $myDB = 'mcvs_db'; # Norādiet savu datu bāzi
        $myUser = 'root';  # Norādiet savu datu bāzes lietotājvārdu
        $myPass = 'janisk';  # Norādiet savu lietotājvārdu
                            
        $d = mysqli_connect($myServer,$myUser,$myPass,$myDB) or die('Kļūda pieslēdzoties datubāzei!');
        mysqli_set_charset($d, 'utf8');

        $sql_query="INSERT INTO macibugrupa(Kurss_idKurss, Auditorija_idAuditorija, mGrupasNosaukums, mgDatumsNo, mgDatumsLidz) VALUES('$selectedCourseId','$selectedRoomId', '$groupName', '$dateFrom', '$dateTo');";
        
        if (mysqli_query($d, $sql_query)) {
            // echo "Ieraksts par lietotaju veiksmīgi pievienots";
        } else {
            echo "Error: " . $sql_query . "<br>" . mysqli_error($d);
        }
        
        //----------------------------------------
        
        $selectedTeacher = $_POST['gpTeacherListName'];
        $selectedTeacherPieces = explode(" ", $selectedTeacher);
        $selectedTeacherPK = $selectedTeacherPieces[2];
        
        $mysqli2 = NEW MySQLi('localhost', 'root','', 'mcvs_db');
		mysqli_set_charset($mysqli2, 'utf8');
        
        $resultSet1 = $mysqli2->query(
            "SELECT idPersona FROM Persona WHERE personasKods = '$selectedTeacherPK';");
                        
        if($resultSet1 -> num_rows != 0) {                
            while($rows = $resultSet1 -> fetch_assoc()) {
                $selectedTeacherId = $rows['idPersona'];
            }
        }
        
        
        $resultSet3 = $mysqli2->query(
            "SELECT idMacibuGrupa FROM MacibuGrupa ORDER BY idMacibuGrupa DESC LIMIT 1;");
        
        if($resultSet3 -> num_rows != 0) {                
            while($rows = $resultSet3 -> fetch_assoc()) {
                $selectedGroupId = $rows['idMacibuGrupa'];
            }
        }
        
        $sql_query2="INSERT INTO Persona_has_MacibuGrupa(Persona_idPersona, MacibuGrupa_idMacibuGrupa, vaiIrPasniedzejs) VALUES('$selectedTeacherId','$selectedGroupId','J');";
        
        if (mysqli_query($d, $sql_query2)) {
            ?><div class="alert alert-success" role="alert">
            <center><b>Auditorija veiksmīgi pievienota!</b></center>
            </div><?php
        }
        
        mysqli_close($d);   
    }
    ?>
    </form>
</div>
<?php
    include('footer.php'); 
}
?>
