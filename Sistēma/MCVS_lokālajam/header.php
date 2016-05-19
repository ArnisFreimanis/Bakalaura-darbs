<!DOCTYPE html>
<html>
<head>
<title>MCVS</title>
<meta charset="utf-8">
    <link href="atteli/favIcon.png" rel="shortcut icon" type="image/x-icon" />
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <meta name="viewport" content="width=device-width, initial-scal=1.0">
    <link href = "css/bootstrap.min.css" rel="stylesheet">
    <link href = "css/style.css" rel="stylesheet">
    <link href = "custom_style.css" rel="stylesheet">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
    <script> 
        $(function(){
            $("#header").load("header.php"); 
            $("#footer").load("footer.php"); 
        });
    </script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css">
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-table/1.5.0/bootstrap-table.min.js"></script>
    
    <script src="js/bootstrap.js"></script>

</head>
<body>
<?php 
     
$username = $_SESSION['login_user']; 
$mysqli = NEW MySQLi('localhost', 'root','', 'mcvs_db');
    mysqli_set_charset($mysqli, 'utf8');
        $resultSet  =$mysqli->query("SELECT * FROM persona WHERE lietotajvards='$username' ");
        if($resultSet->num_rows !=0){
            while($rows = $resultSet->fetch_assoc()){ 
                $role = $rows['lietotajaLoma'];
            }
        }
?>
    <div class="wrap">
        	   <div class = "header">
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand" href="main.php"><b> MCVS</b></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
<?php 

  if($role == "A"){
?>
<!-- ------------Viss par Personu----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Persona <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a a href="addNewUser.php">Pievienot personu</a></li>
                    <li><a href="userList.php">Personu saraksts</a></li>
                    <li><a href="addTeacherToCourse.php">Pasniedzējs + Kurss</a></li>
                    <li><a href="editUserList.php">Labot personu</a></li>
                  </ul>
                </li>
<!-- ------------Viss par Kursu----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kurss <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="addNewCourse.php">Pievienot kursu</a></li>
                    <li><a href="courseList.php">Kursu saraksts</a></li>
                    <li><a href="editCourseList.php">Labot kursu</a></li>
                  </ul>
                </li>
<!-- ------------Viss par Auditoriju----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Auditorija <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="addNewRoom.php">Pievienot auditoriju</a></li>
                    <li><a href="roomList.php">Auditoriju saraksts</a></li>
                    <li><a href="editRoomList.php">Labot auditoriju</a></li>
                  </ul>
                </li>
<!-- ------------Viss par Mācību Grupu----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mācību Grupa <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="groupPlanning.php">Izveidot mācību grupu</a></li>
                    <li><a href="addStudent.php">Pievienot personu grupai</a></li>
                    <li><a href="groupList.php">Mācību grupu saraksts</a></li>
                  </ul>
                </li>
<!-- ------------Visas citas lietotāja opcijas----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="logout.php">Iziet</a></li>
                    <li><a href="#">...</a></li>
                  </ul>
                </li> 
<?php 
  }else if($role == "P"){
?>
<!-- ------------Viss par Personu----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Persona <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="userList.php">Personu saraksts</a></li>
                    <li><a href="addTeacherToCourse.php">Pasniedzējs + Kurss</a></li>
                  </ul>
                </li>
<!-- ------------Viss par Kursu----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kurss <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="addNewCourse.php">Pievienot kursu</a></li>
                    <li><a href="courseList.php">Kursu saraksts</a></li>
                  </ul>
                </li>
<!-- ------------Viss par Auditoriju----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Auditorija <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="roomList.php">Auditoriju saraksts</a></li>
                  </ul>
                </li>
<!-- ------------Viss par Mācību Grupu----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mācību Grupa <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="groupPlanning.php">Izveidot mācību grupu</a></li>
                    <li><a href="addStudent.php">Pievienot personu grupai</a></li>
                    <li><a href="groupList.php">Mācību grupu saraksts</a></li>
                  </ul>
                </li>
<!-- ------------Visas citas lietotāja opcijas----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="logout.php">Iziet</a></li>
                  </ul>
                </li>
<?php
  }else if($role == "L"){
?>
<!-- ------------Visas citas lietotāja opcijas----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="logout.php">Iziet</a></li>
                  </ul>
                </li> 
<?php
  }
?>                           
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>   
    </div>