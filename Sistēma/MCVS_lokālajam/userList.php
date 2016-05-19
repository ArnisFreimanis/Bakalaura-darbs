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
?>
    <div class = "container">
    <div class="page-header">
      <br><h1>Visu lietotāju saraksts</h1>
    </div>
    <div class="row">

    <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead style="background-color: #337ab7; border-color: #337ab7; color:#fff;">
        <th><center>Nr.</center></th>
        <th><center>Vārds</center></th>
        <th><center>Uzvārds</center></th>
        <th><center>e-pasts</center></th>
        <th><center>Tālrunis</center></th>
        <th><center>Personas kods</center></th>    
    </thead>
    <tbody data-link="row" class="rowlink">
    
    
    <?php
            $tmp = 0;
            $x = 0;
    if ($resultSet->num_rows > 0) {
         while($row = $resultSet->fetch_assoc()) {
            $tmp = $tmp +1;
              ?> 
              <tr>
              <td><a href="userProfile.php?PK=<?php echo $row["personasKods"]; ?>"><center><?php echo $tmp ?></center></a></td>
              <td><center><?php echo $row["vards"] ?></center></td>
              <td><center><?php echo $row["uzvards"] ?></center></td>
              <td><center><?php echo $row["epasts"] ?></center></td>
              <td><center><?php echo $row["talrunis"] ?></center></td>
              <td><center><?php echo $row["personasKods"] ?></center></td>
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
