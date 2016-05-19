<?php
include('login.php');      
$username = $_SESSION['login_user']; 
if($username == ""){
    header("Location: index.php");
    session_destroy();
}
else{
	include('header.php');
    $mysqli = NEW MySQLi('localhost', 'root','', 'mcvs_db');
    mysqli_set_charset($mysqli, 'utf8');
    $resultSet  =$mysqli->query("SELECT * FROM persona");
    $group_Name = "";

?>

<div class = "container">
        <div class="page-header">
            <br><h1>Personu pievienošana mācību grupai</h1>
        </div>
    <div class="panel panel-default">     
		<form action="http://localhost/MCVS/addStudent.php" method="post">
        <table class="table">
			<tr>
				<td style="position: relative;top: 50%;transform: translateY(10%);">
                <label style="display:block; width:x; height:y; text-align:center;">Izvēlieties mācību grupu:</label>
            	</td>
				<td>
					<select input style="width:100%; height:30px;" class="selectpicker" id="gpGroupNameList" name="gpGroupNameListName">		
							<?php
							if (isset($_POST['gpCourseAcceptButton'])
							) {
							?>
							<option value="<?php echo $_POST['gpGroupNameListName']; ?>">
								<?php echo $_POST['gpGroupNameListName']; ?>
							</option>
							<?php
							$group_Name = $_POST['gpGroupNameListName'];
							$_SESSION['groupName'] = $group_Name;
							}else{
							?>
							<option selected="selected" value="0"></option>
							<?php
							$mysqli = NEW MySQLi('localhost', 'root','', 'mcvs_db');
							mysqli_set_charset($mysqli, 'utf8');
							$resultSet  =$mysqli->query("SELECT * FROM macibugrupa");
							
							if($resultSet -> num_rows != 0) {                
								while($rows = $resultSet -> fetch_assoc()) {
									?>
									<option value="<?php echo $rows['mGrupasNosaukums']; ?>">
										<?php echo $rows['mGrupasNosaukums'];?>									
									</option>
									<?php
								}
							}
							mysqli_close($mysqli);  
	}						
						
						?>
					</select>
				</td>
				<td>
					<button type="submit" class="btn btn-warning" name="gpCourseAcceptButton" id="gpCourseAcceptButton" value="Apstiprināt" style="width:200px; background-color: #337ab7; border-color: #337ab7; background-image: linear-gradient(to bottom,#337ab7 0,#337ab7 100%);">Apstiprināt</button>
					<button type="submit" class="btn btn-warning" name="gpCourseRefreshButton" id="gpCourseRefreshButton" value="Atjaunot" style="width:50px; background-color: #337ab7; border-color: #337ab7; background-image: linear-gradient(to bottom,#337ab7 0,#337ab7 100%);"><span class="glyphicon glyphicon-refresh" aria-hidden="true"></span></button>
				</td>
			</tr>		
		</table>	

	</div>
	<div class="row">

    <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
    <thead style="background-color: #337ab7; border-color: #337ab7; color:#fff;">
        <th><center>Nr.</center></th>
        <th><center>Vārds</center></th>
        <th><center>Uzvārds</center></th>
        <th><center>e-pasts</center></th>
        <th><center>Tālrunis</center></th>
        <th><center>Pievienot</center></th>    
    </thead>
    <tbody>
    <tr>
    <?php
    $tmp = 0;
    $x = 0;
    
    $IDmGrupaPersona = array();

    if($group_Name != ""){
    $resultNoslogojums = $mysqli->query("SELECT * FROM macibugrupa WHERE mGrupasNosaukums ='$group_Name' ");

		if($resultNoslogojums->num_rows >0){
            while($rows = $resultNoslogojums->fetch_assoc()){ 
                $IDmGrupa = $rows['idMacibuGrupa'];
				$resultGrupa = $mysqli->query("SELECT * FROM persona_has_macibugrupa WHERE MacibuGrupa_idMacibuGrupa = '$IDmGrupa' ");  
			if($resultGrupa->num_rows > 0){
            	while($rows = $resultGrupa->fetch_assoc()){ 
					$IDmGrupaPersona[] = $rows['Persona_idPersona'];
				}    
			}
		}
	}		
    if ($resultSet->num_rows > 0) {
         while($row = $resultSet->fetch_assoc()) {
            $tmp = $tmp +1;
            $pogaiPersonasKods = $row["personasKods"];
            $idPersona = $row["idPersona"];
              ?><td><center><?php echo $tmp; ?></center></td><td><center><?php echo $row["vards"] ?></center></td><td><center><?php echo $row["uzvards"] ?></center></td><td><center><?php echo $row["talrunis"] ?></center></td><td><center><?php echo $row["personasKods"] ?></center></td><td><center> 

             <a href="addStudentScript.php?PK=<?php echo $row["personasKods"]; ?>" class="btn btn-primary btn-lg 
									<?php for($i = 0; $i < sizeof($IDmGrupaPersona);$i++){
				            				if($IDmGrupaPersona[$i] == $idPersona){
				            					echo 'disabled';
				            				}else{
				            					echo '';
				            				}
				           				}?>  btn-sm " role="button">Pievienot </a>

             </center></td></tr> <?php
        }
    } else {
        $x = 404;
    }
}
    ?>
    </tbody>
    </table>
</form>
</div>
</div>
<script>
$(document).ready(function() {
    $('#example').DataTable({
        "language": {
                "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Latvian.json"
            }
    });
} );
</script>
<script src="//code.jquery.com/jquery-1.12.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js"></script>


</div>
<?php
    include('footer.php'); 
}
?>

