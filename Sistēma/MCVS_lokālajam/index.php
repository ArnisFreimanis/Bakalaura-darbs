<?php
include('login.php'); // Includes Login Script
?>
<!DOCTYPE html>
<html>
<head>
    <title>MCVS</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="custom_style.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="main">
    <h1>MĀCĪBU CENTRA VADĪBAS SISTĒMA</h1>
        <div id="login">
            <form action="" method="post">
            <label style="height: 20px">Lietotājvārds:</label>
            <input id="name" name="username" type="text"><br>
            <label style="height: 20px">Parole:</label>
            <input id="password" name="password" type="password">
            <input id="ienaktSistema" name="submit" type="submit" value="Ienākt sistēmā">
            <span><br><br><?php echo $error; ?></span>
            </form>
        </div>
    </div>
</body>
</html>