<?php
    include('navigation.php');
    include('db.php');
    session_start();

    // if user not loged in
    if(!isset($_SESSION["admin"])){
        header("Location: index.php");
    }


    if (array_key_exists("ecid", $_GET) && array_key_exists("estid", $_GET) ) {

            $stid = $_GET["estid"];
            $cid = $_GET["ecid"];

            echo $stid;
            echo $cid;

            $sql = "INSERT INTO student_class (cid, stid) VALUES (?, ?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            
            if($prepareStmt){
                mysqli_stmt_bind_param($stmt, "ii", $cid, $stid);
                mysqli_stmt_execute($stmt);
                header("Location: student_info.php?entoll=true&val"); 
            }
    }

?>