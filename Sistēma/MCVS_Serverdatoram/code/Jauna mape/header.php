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
            $("#header").load("code/main/header.php"); 
            $("#footer").load("code/main/footer.php"); 
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
              
<!-- ------------Viss par Personu----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Persona <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a a href="code/add_new/addNewUser.php">Pievienot personu</a></li>
                    <li><a href="code/list/userList.php">Personu saraksts</a></li>
                  </ul>
                </li>
<!-- ------------Viss par Kursu----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Kurss <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="code/add_new/addNewCourse.php">Pievienot kursu</a></li>
                    <li><a href="code/list/courseList.php">Kursu saraksts</a></li>
                  </ul>
                </li>
<!-- ------------Viss par Auditoriju----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Auditorija <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="code/add_new/addNewRoom.php">Pievienot auditoriju</a></li>
                    <li><a href="code/list/roomList.php">Auditoriju saraksts</a></li>
                  </ul>
                </li>
<!-- ------------Viss par Mācību Grupu----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Mācību Grupa <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="code/add_new/groupPlanning.php">Izveidot mācību grupu</a></li>
                    <li><a href="code/add_new/addStudent.php">Pievienot personu grupai</a></li>
                    <li><a href="code/list/groupList.php">Mācību grupu saraksts</a></li>
                  </ul>
                </li>
<!-- ------------Visas citas lietotāja opcijas----------- -->
                <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="code/main/logout.php">Iziet</a></li>
                    <li><a href="#">...</a></li>
                  </ul>
                </li>               
              </ul>
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>   
    </div>