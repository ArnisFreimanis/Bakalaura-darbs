<?php
include('login.php');      
$username = $_SESSION['login_user']; 
if($username == ""){
    header("Location: index.php");
    session_destroy();
}
else{
    include('header.php');
        $PK=$_REQUEST['PK'];
        
        $mysqli = NEW MySQLi('localhost', 'root','', 'mcvs_db');
        mysqli_set_charset($mysqli, 'utf8');
        $resultSet  =$mysqli->query("SELECT * FROM persona WHERE personasKods='$PK' ");
        if($resultSet->num_rows !=0){
            while($rows = $resultSet->fetch_assoc()){ 
                $ID = $rows['idPersona'];
                $name = $rows['vards'];
                $surname = $rows['uzvards'];
                $phone = $rows['talrunis'];
                $city = $rows['dzivesPilseta']; 
                $adress = $rows['dzivesAdrese'];
                $cityWork = $rows['darbaPilseta']; 
                $workplaceAdress = $rows['darbaAdrese'];

            }
        }

$_SESSION['$ID'] = $ID;
?>
<div class = "container">
	<div class="page-header">
	   <br><h1>Lietotāja informācijas labošana</h1>
	</div>
	<div class="panel panel-default">
    	<form data-toggle="validator" role="form" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td style="position: relative;top: 50%;transform: translateY(25%); width: 20%;"><center><label>Vārds:</label></center></td>
                    <td style="width: 30%;"><input type="text" class="form-control" id="newUserName" name="vards" name="vards" value="<?php echo $name ?>"  required></td>
                    <td style="position: relative;top: 50%;transform: translateY(25%); width: 20%;"><center><label>Uzvārds:</label></center></td>
                    <td style="width: 30%;"><input type="text" class="form-control" id="newUserSurname" name="uzvards" value="<?php echo $surname ?>" required></td>
                </tr>
             	<tr>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Personas kods:</label></center></td>
                    <td ><input type="text" class="form-control" id="newUserPersonID" name="personasKods" value="<?php echo $PK ?>"required></td>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Talrunis:</label></center></td>
                    <td><input type="text" class="form-control" id="newUserPhone" name="talrunis" value="<?php echo $phone ?>" required></td>
                </tr>
                <tr>
                	<td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Dzīvesvietas adrese:</label></center></td>
                    <td><input type="text" class="form-control" id="newUserHomeAddress" name="dzivesAdrese" value="<?php echo $city ?>" required></td>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Dzīvesvietas pilsēta:</label></center></td>
                    <td><input type="text" class="form-control" id="newUserHomeCity" name="dzivesPilseta" value="<?php echo $adress ?>" required></td>
                </tr>
                <tr>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Darbavietas pilsēta:</label></center></td>
                    <td><input type="text" class="form-control" id="newUserHomeCity" name="darbaAdrese" value="<?php echo $cityWork ?>" required></td>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Darbavietas adrese:</label></center></td>
                    <td><input type="text" class="form-control" id="newUserWorkAddress" name="darbaPilseta" value="<?php echo $workplaceAdress ?>" required></td>
                </tr>
                <tr>        
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Lietotāja loma:</label></center></td>
                    <td><div class="radio"><label><input type="radio" name="loma" value="L" required> Darbinieks</label></div></td>
                    <td><div class="radio"><label><input type="radio" name="loma" value="P" required>Pasniedzējs</label></div></td>
                    <td><div class="radio"><label><input type="radio" name="loma" value="A" required>Administrators</label></div></td>
                </tr>
                <tr> 
                    <td></td>       
                    <td><input type="text" class="form-control" id="ID" name="ID" value="<?php echo $ID ?>" style="width:60px;" required disabled></td>                   
                    <td></td>
                    <td style="padding-top:16px;"> <button type="submit" class="btn btn-warning" name="submit" id="submit" style="width:200px; background-color: #337ab7; border-color: #337ab7; background-image: linear-gradient(to bottom,#337ab7 0,#337ab7 100%);">Labot</button> </td>
                </tr>
            </table>
         </form>   
    </div>
</div>
<script>
    $('#form').submit(function(e) {       
        $('#messages').removeClass('hide').addClass('alert alert-success alert-dismissible').slideDown().show();
        $('#messages_content').html('<h4>MESSAGE HERE</h4>');
        $('#modal').modal('show');
        e.preventDefault();
    });
</script>        
<?php
    if(isset($_REQUEST['submit']))
    {
        include('editUserScript.php');
        ?><div class="alert alert-success" role="alert">
		 	<center><b>Informācija par personu ir izlabota!</b></center>
		</div><?php
    }
include('footer.php'); 
}
?>
