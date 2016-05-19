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
    $resultSet  =$mysqli->query("SELECT * FROM auditorija");
?>
    <div class = "container">
    <div class="page-header">
      <br><h1>Visu lietotāju saraksts</h1>
    </div>
    <div class="row">

    <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead style="background-color: #337ab7; border-color: #337ab7; color:#fff;">
        <th style="vertical-align:middle;"><center>Nr.</center></th>
        <th style="vertical-align:middle;"><center>Nosaukums</center></th>
        <th style="vertical-align:middle;"><center>Pilēta</center></th>
        <th style="vertical-align:middle;"><center>Adrese</center></th>
        <th style="vertical-align:middle;"><center>Ietilpība <br> (personās)</center></th>  
    </thead>
    <tbody data-link="row" class="rowlink">
    <tr>
    <?php
            $tmp = 0;
            $x = 0;
    if ($resultSet->num_rows > 0) {
         while($row = $resultSet->fetch_assoc()) {
            $tmp = $tmp +1;
            ?>
            <td><a href="roomProfile.php?AudID=<?php echo $row["idAuditorija"]; ?>"><center><?php echo $tmp ?></center></a></td>
            <td><center><?php echo $row["aNumursNosaukums"] ?></center></td>
            <td><center><?php echo $row["aPilseta"] ?></center></td>
            <td><center><?php echo $row["aAdrese"] ?></center></td>
            <td><center><?php echo  $row["aMaksimalaisStudentuSkaits"] ?></center></td>
            </tr> <?php 
        }
    } else {
        $x = 404;
    }
    ?>
    </tbody>
    </table>

</div>
</div>

<script type="text/javascript">
    $('tbody.rowlink').rowlink();
</script>

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

<?php
    include('footer.php'); 
}
?>
