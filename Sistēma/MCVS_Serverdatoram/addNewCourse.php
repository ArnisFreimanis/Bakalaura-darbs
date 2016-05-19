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
	   <br><h1>Jauna kursa izveide</h1>
	</div>
	<div class="panel panel-default">
    	<form data-toggle="validator" role="form" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td style="position: relative;top: 50%;transform: translateY(25%); width: 25%;"><center><label>Kods:</label></center></td>
                    <td style="width: 25%;"><input type="text" class="form-control" id="newCourseCode" name="code" required></td>
                    <td style="position: relative;top: 50%;transform: translateY(25%); width: 25%;"><center><center><label>Nosaukums:</label></center></td>
                    <td style="width: 25%;"><input type="text" class="form-control" id="newCourseTitle" name="title" required></td>
                </tr>
                <tr>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Studentu skaits:</label></center></td>
                    <td><input type="text" class="form-control" id="newCourseCapacity" name="capacity" required></td>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Ilgums (dienas):</label></center></td>
                    <td><input type="text" class="form-control" id="newCourseDuration" name="duration" required></td>
                </tr>
                <tr>
                     <td style="position: relative;top: 50%;transform: translateY(25%); width: 25%;"><center><label>Datorauditorija:</label></center></td>
                    <td><div class="radio"><label><input type="radio" name="auditorijasTips" value="D" required>Jā</label></div></td>
                    <td style="position: relative;top: 50%;transform: translateX(-75%); width: 25%;"><div class="radio"><label><input type="radio" name="auditorijasTips" value="A" required>Nē</label></div></td>
                </tr>
             	<tr>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Apraksts:</label></center></td>
                    <td colspan=3><textarea  type="text"   style="width:100%; height:150px;  resize: none;" class="form-control" id="newCourseSumary" name="sumary" required></textarea></td>
                </tr>
                <tr>
                	<td><center><label>Diploms:</label></center></td>
                    <td colspan=3 ><input type="file" class="foto" id="newCourseDiploms" name="diploms" required></td>
                </tr>
                <tr>
                    <td><center><label>Programma:</label></center></td>
                    <td colspan=3><input type="file" class="foto" id="newCourseProgramma" name="programma" required></td>
                </tr>
                <tr>
                    <td ><center><label>Mācību materiāls:</label></center></td>
                    <td colspan=3><input type="file" class="foto" id="newCourseMateriali" name="materiali" required></td>
                </tr>
                <tr>        
                    <td></td>
                    <td></td>
                    <td></td>
                    <td colspan="2" style="position: relative;top: 50%;transform: translateY(20%);"> <button type="submit" class="btn btn-warning" name="submit" id="submit" style="width:200px; background-color: #337ab7; border-color: #337ab7; background-image: linear-gradient(to bottom,#337ab7 0,#337ab7 100%);">Pievienot</button> </td>       
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
        include('insertCourse.php');
    }
include('footer.php'); 
}
?>
