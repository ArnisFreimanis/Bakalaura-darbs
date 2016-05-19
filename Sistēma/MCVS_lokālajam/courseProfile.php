<?php
        include('login.php');      
        $username = $_SESSION['login_user']; 
if($username == ""){
    header("Location: index.php");
    session_destroy();
}
else{

        $kKods=$_REQUEST['kKods'];

        include('header.php');
        $mysqli = NEW MySQLi('localhost', 'root','', 'mcvs_db');
        mysqli_set_charset($mysqli, 'utf8');
        $resultSet  =$mysqli->query("SELECT * FROM kurss WHERE kursaKods='$kKods' ");
        if($resultSet->num_rows !=0){
            while($rows = $resultSet->fetch_assoc()){                    
                $fileId = $rows['idKurss'];
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
      <br><h1><?php echo "$kKursaNosaukums"; ?></h1>
    </div>
    <div class="row">
            <table class="table" width="100%">
                <tbody>
                <tr>        
                    <td><b>Kursa kods : </b><?php echo  $kursaKods ?></td>
                </tr>
                <tr>        
                    <td><b>Nepieciešamā auditorija : </b><?php if($tips == 'D'){
                                echo "Datorauditorija";
                            }
                            else{
                                echo "Auditorija";
                            }
                            ?></p>
                    </td>
                </tr>
                <tr>
                    <td><?php echo "<b>Maksimālais studentu skaits : </b> $skaits" ?></td>
                </tr>
                <tr>
                    <td><?php echo "<b>Kursa ilgums : </b> $ilgums dienas" ?></td>
                </tr>
                <tr>
                    <td><?php echo "<b>Kursa apraksts : </b> $kursaApraksts" ?></td>
                </tr>
                </tbody>
    </table>
</div>
</div>

<?php include('footer.php'); 
}
?>