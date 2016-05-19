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
    ?>

	<div class = "container">
	<div class="page-header">
	  	<br><h1>Pievienot pasniedzējam pasniedzamo kursu</h1>
	</div>
	<div class="row">
		<form data-toggle="validator" role="form" method="post" enctype="multipart/form-data">
		    <table class="table" width="100%">
		    	<tbody>
		    	<tr style="border-top: thick double #fff">
		    		<td style="width:50%"><h3><center>Pasniedzējs</center></h3></td>
		    		<td style="width:50%"><h3><center>Kurss</center></h3></td>
		    	</tr>
		    	<tr>    	
		    		<td><center>
			    		<select class="selectpicker" name="teacherName" id="teacherName" style="width:100%; height: 30px;">
			    			<?php 
					        $resultSet  =$mysqli->query("SELECT * FROM persona WHERE lietotajaLoma = 'P'");
					        if($resultSet->num_rows !=0){
					            while($rows = $resultSet->fetch_assoc()){
					            	$personasID =  $rows['idPersona']; 
					            	?><option 
					            		value="<?php echo $personasID; ?>">
                                                <?php echo $rows['vards'] . " " . 
                                                $rows['uzvards'] . " " . 
                                                $rows['personasKods'];?>
                                    </option><?php
					            }
					        }
					        ?>
						</select>
					</center></td>   	
		    		<td><center>
			    		<select class="selectpicker" name="courseName" id="courseName" style="width:100%; height: 30px;">
							<?php 
					        $resultSet2  =$mysqli->query("SELECT * FROM kurss");
					        if($resultSet2->num_rows !=0){
					            while($rows = $resultSet2->fetch_assoc()){
					            	$kursaID =  $rows['idKurss']; 
					            	?><option 
					            		value="<?php echo $kursaID; ?>">
                                                <?php echo $rows['kKursaNosaukums'];?>
                                    </option><?php
					            }
					        }
					        ?>
						</select>
					</center></td>
		    	</tr>
		    	<tr style="border-top: thick double #fff"><td></td></tr>
		    	<tr style="border-top: thick double #fff"><td></td></tr>
		    	<tr style="border-top: thick double #fff"><td></td></tr>
		    	<tr style="border-top: thick double #fff"><td></td></tr>
		    	<tr style="border-top: thick double #fff"><td></td></tr>
		    	<tr style="border-top: thick double #fff"><td></td></tr>
		    	<tr>
		    		<td colspan="2"><center><button type="submit" class="btn btn-warning" name="submit" id="submit" style="width:200px; background-color: #337ab7; border-color: #337ab7; background-image: linear-gradient(to bottom,#337ab7 0,#337ab7 100%);">Pievienot</button></center></td>
		    	</tr>
			    </tbody>
			    </table>
	        </form>
	    </div>
	</div>
<?php
    if(isset($_REQUEST['submit']))
    {
        include('insertTeacherToCourse.php');
    }

include('footer.php'); 
}
?>    