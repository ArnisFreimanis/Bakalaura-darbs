<?php
        include('login.php');      
        $username = $_SESSION['login_user']; 
if($username == ""){
    header("Location: index.php");
    session_destroy();
}
else{
	include('header.php');
    $mysqli = NEW MySQLi('localhost', 'root','janisk', 'mcvs_db');
    mysqli_set_charset($mysqli, 'utf8');
    $resultSet  =$mysqli->query("SELECT * FROM MacibuGrupa");
?>
    <div class = "container">
    <div class="page-header">
      <br><h1>Visu mācību grupu saraksts</h1>
    </div>
    <div class="row">

    <table id="example" class="table table-striped table-bordered table-hover" cellspacing="0" width="100%">
    <thead style="background-color: #337ab7; border-color: #337ab7; color:#fff;">
        <th><center>Nr.</center></th>
        <th><center>Nosaukums</center></th>
        <th><center>No</center></th>
        <th><center>Līdz</center></th>    
        <th><center>Apgūstamais kurs</center></th>
        <th><center>Auditorija</center></th>

    </thead>
    <tbody data-link="row" class="rowlink">
    <?php

            $tmp = 0;
            $x = 0;
    if ($resultSet->num_rows > 0) {
         while($row = $resultSet->fetch_assoc()) {
            $tmp = $tmp +1;
            $idMacibuGrupa = $row["idMacibuGrupa"];

              ?> 

              <tr>
              <td><a href="groupeProfile.php?MGID=<?php echo $row["idMacibuGrupa"]; ?>"><center><?php echo $tmp ?></center></a></td>
              <td><center><?php echo $row["mGrupasNosaukums"]; ?></center></td>
              <td><center><?php echo $row["mgDatumsNo"] ?></center></td>
              <td><center><?php echo $row["mgDatumsLidz"] ?></center></td>
              <?php             $resultSetSet  =$mysqli->query("SELECT * FROM MacibuGrupa WHERE idMacibuGrupa ='$idMacibuGrupa'");
            if ($resultSetSet->num_rows > 0) {
                 while($row = $resultSetSet->fetch_assoc()) {
                    $kursaID = $row["Kurss_idKurss"];
                    $auditorijasID = $row["Auditorija_idAuditorija"];
                 }
            }
            $kursaNosaukumsResult  = $mysqli->query("SELECT * FROM Kurss WHERE idKurss ='$kursaID'");
            $auditorijasNosaukumsResult  = $mysqli->query("SELECT * FROM Auditorija WHERE idAuditorija ='$auditorijasID'");
            if ($kursaNosaukumsResult->num_rows > 0) {
                 while($row = $kursaNosaukumsResult->fetch_assoc()) {
                      $kursaNosaukums = $row["kKursaNosaukums"];
                 }
            }
            if ($auditorijasNosaukumsResult->num_rows > 0) {
                 while($row = $auditorijasNosaukumsResult->fetch_assoc()) {   
                      $auditorijasNosaukums = $row["aNumursNosaukums"];
                 }
            } ?>
              <td><center><?php echo $kursaNosaukums ?></center></td>
              <td><center><?php echo $auditorijasNosaukums ?></center></td>
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
