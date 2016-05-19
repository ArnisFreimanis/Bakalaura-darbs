<?php
include('login.php');      
$username = $_SESSION['login_user']; 
if($username == ""){
    header("Location: index.php");
    session_destroy();
}
else{
	include('header.php');
        $kKods=$_REQUEST['kKods'];

        $mysqli = NEW MySQLi('localhost', 'root','', 'mcvs_db');
        mysqli_set_charset($mysqli, 'utf8');
        $resultSet  =$mysqli->query("SELECT * FROM kurss WHERE kursaKods='$kKods' ");
        if($resultSet->num_rows !=0){
            while($rows = $resultSet->fetch_assoc()){                    
                $ID = $rows['idKurss'];
                $kursaKods = $rows['kursaKods'];
                $kKursaNosaukums = $rows['kKursaNosaukums'];
                $kursaApraksts = $rows['kursaApraksts'];
                $tips = $rows['nepieciesamaisAuditorijasTips'];
                $skaits = $rows['kMaksimalaisStudentuSkaits'];
                $ilgums = $rows['kursaIlgums'];
            }
        }
?>
<div class = "container">
	<div class="page-header">
	   <br><h1>Kursa informācijas labošana</h1>
	</div>
	<div class="panel panel-default">
    	<form data-toggle="validator" role="form" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td style="position: relative;top: 50%;transform: translateY(25%); width: 25%;"><center><label>Kods:</label></center></td>
                    <td style="width: 25%;"><input type="text" class="form-control" id="newCourseCode" name="code" value="<?php echo $kursaKods ?>" required></td>
                    <td style="position: relative;top: 50%;transform: translateY(25%); width: 25%;"><center><center><label>Nosaukums:</label></center></td>
                    <td style="width: 25%;"><input type="text" class="form-control" id="newCourseTitle" name="title" value="<?php echo $kKursaNosaukums ?>" required></td>
                </tr>
                <tr>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Studentu skaits:</label></center></td>
                    <td><input type="text" class="form-control" id="newCourseCapacity" name="capacity" value="<?php echo $skaits ?>" required></td>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Ilgums (dienas):</label></center></td>
                    <td><input type="text" class="form-control" id="newCourseDuration" name="duration" value="<?php echo $ilgums ?>" required></td>
                </tr>
                <tr>
                     <td style="position: relative;top: 50%;transform: translateY(25%); width: 25%;"><center><label>Datorauditorija:</label></center></td>
                    <td><div class="radio"><label><input type="radio" name="auditorijasTips" value="D" required>Jā</label></div></td>
                    <td style="position: relative;top: 50%;transform: translateX(-75%); width: 25%;"><div class="radio"><label><input type="radio" name="auditorijasTips" value="A" required>Nē</label></div></td>
                    <td></td>
                </tr>
             	<tr>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Apraksts:</label></center></td>
                    <td colspan=3><textarea  type="text"   style="width:100%; height:150px;  resize: none;" class="form-control" id="newCourseSumary" name="sumary" required><?php echo $kursaApraksts ?></textarea></td>
                </tr>
                <tr>        
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" style="position: relative;top: 50%;transform: translateY(20%);"> <button type="submit" class="btn btn-warning" name="submit" id="submit" style="width:200px; background-color: #337ab7; border-color: #337ab7; background-image: linear-gradient(to bottom,#337ab7 0,#337ab7 100%);">Labot</button> </td>       
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
        include('editCourseScript.php');
        ?><div class="alert alert-success" role="alert">
		 	<center><b>Informācija par auditoriju ir izlabota!</b></center>
		</div><?php
    }
include('footer.php'); 
}
?>
