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
	  <br><h1>Jauna auditorijas izveide</h1>
	</div>
	<div class="panel panel-default">
	<form data-toggle="validator" role="form">
     <table class="table">
        <tr>
            <td style="position: relative;top: 50%;transform: translateY(25%); width: 25%;"><center><label>Nosaukums/numurs:</label></center></td>
            <td style="width: 25%;"><input type="text" class="form-control" id="newRoomName" name="nosaukums" name="vards" required></td>
            <td style="position: relative;top: 50%;transform: translateY(25%); width: 25%;"><center><center><label>Datorauditorija:</label></center></td>
            <td style="width: 10%;"><div class="radio"><label><input type="radio" name="auditorijasTips" value="D" required>Jā</label></div></td>
            <td style="width: 10%;"><div class="radio"><label><input type="radio" name="auditorijasTips" value="A" required>Nē</label></div></td>
        </tr>
     	<tr>
            <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Adrese:</label></center></td>
            <td ><input type="text" class="form-control" id="newRoomAdress" name="adrese" required></td>
            <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Tāfele:</label></center></td>
            <td style="width: 12%;"><div class="radio"><label><input type="radio" name="tafele" value="1" required>Ir</label></div></td>
            <td style="width: 12%;"><div class="radio"><label><input type="radio" name="tafele" value="2" required>Nav</label></div></td>
        </tr>
        <tr>
        	<td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Pilseta:</label></center></td>
            <td><input type="text" class="form-control" id="newRoomCity" name="pilseta" required></td>
            <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Projektors:</label></center></td>
            <td style="width: 12%;"><div class="radio"><label><input type="radio" name="projektors" value="1" required>Ir</label></div></td>
            <td style="width: 12%;"><div class="radio"><label><input type="radio" name="projektors" value="2" required>Nav</label></div></td>
        <tr>
        	<td style="position: relative;top: 50%;transform: translateY(15%);"><center><label>Maksimālais studentu skaits:</label></center></td>
            <td><input type="text" class="form-control" id="newRoomCapacity" name="skaits" required></td>
            <td style="position: relative;top: 50%;transform: translateY(15%);"><center><label>Video konference:</label></center></td>
            <td style="width: 12%;"><div class="radio"><label><input type="radio" name="video" value="1" required>Ir</label></div></td>
            <td style="width: 12%;"><div class="radio"><label><input type="radio" name="video" value="2" required>Nav</label></div></td>
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
        include('insertRoom.php');
    }
include('footer.php'); 
}
?>
