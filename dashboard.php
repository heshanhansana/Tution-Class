<?php
    session_start();
    include('navigation.php');

    // if user not loged in
    if(!isset($_SESSION["admin"])){
        header("Location: index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Dashboard</title>
</head>
<body>

    <div class="container">
    
        <h2 align="center">Welcome To HanSol</h2><br>

        <a href="qrscane.php"><button type="button" class="btn btn-success btn-lg btn-block">Search Student</button></a><br>
        <a href="classes.php"><button type="button" class="btn btn-success btn-lg btn-block">Classes</button></a><br>
        <a href="teachers.php"><button type="button" class="btn btn-success btn-lg btn-block">Teachers</button></a><br>
        <a href="students.php"><button type="button" class="btn btn-success btn-lg btn-block">Students</button></a><br>

        <a href="logout.php"><button type="button" class="btn btn-warning btn-lg btn-block">Logout</button></a>

    </div>

</body>
</html>