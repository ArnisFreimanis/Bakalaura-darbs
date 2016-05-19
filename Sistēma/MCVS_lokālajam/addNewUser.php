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
	   <br><h1>Jauna lietotāja izveide</h1>
	</div>
	<div class="panel panel-default">
    	<form data-toggle="validator" role="form" method="post" enctype="multipart/form-data">
            <table class="table">
                <tr>
                    <td style="position: relative;top: 50%;transform: translateY(25%); width: 25%;"><center><label>Vārds:</label></center></td>
                    <td style="width: 25%;"><input type="text" class="form-control" id="newUserName" name="vards" name="vards" required></td>
                    <td style="position: relative;top: 50%;transform: translateY(25%); width: 25%;"><center><label>Uzvārds:</label></center></td>
                    <td style="width: 25%;"><input type="text" class="form-control" id="newUserSurname" name="uzvards" required></td>
                </tr>
             	<tr>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Personas kods:</label></center></td>
                    <td ><input type="text" class="form-control" id="newUserPersonID" name="personasKods" required></td>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Talrunis:</label></center></td>
                    <td><input type="text" class="form-control" id="newUserPhone" name="talrunis" required></td>
                </tr>
                <tr>
                	<td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Dzīves vietas adrese:</label></center></td>
                    <td><input type="text" class="form-control" id="newUserHomeAddress" name="dzivesAdrese" required></td>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Dzīves vietas pilsēta:</label></center></td>
                    <td><input type="text" class="form-control" id="newUserHomeCity" name="dzivesPilseta" required></td>
                </tr>
                <tr>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Darba vietas pilsēta:</label></center></td>
                    <td><input type="text" class="form-control" id="newUserHomeCity" name="darbaAdrese" required></td>
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Darba vietas adrese:</label></center></td>
                    <td><input type="text" class="form-control" id="newUserWorkAddress" name="darbaPilseta" required></td>
                </tr>
                <tr>        
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Lietotāja loma:</label></center></td>
                    <td><div class="radio"><label><input type="radio" name="loma" value="L" required> Darbinieks</label></div></td>
                    <td><div class="radio"><label><input type="radio" name="loma" value="P" required>Pasniedzējs</label></div></td>
                    <td><div class="radio"><label><input type="radio" name="loma" value="A" required>Administrators</label></div></td>
                </tr>
                <tr>        
                    <td style="position: relative;top: 50%;transform: translateY(25%);"><center><label>Personas foto:</label></center></td>
                    <td style="position: relative;top: 50%;transform: translateY(20%);"><input type="file" class="foto" name="foto" required></td>
                    <td></td>
                    <td> <button type="submit" class="btn btn-warning" name="submit" id="submit" style="width:200px; background-color: #337ab7; border-color: #337ab7; background-image: linear-gradient(to bottom,#337ab7 0,#337ab7 100%);">Pievienot</button> </td>
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
        include('insertUser.php');
    }
include('footer.php'); 
}
?>
