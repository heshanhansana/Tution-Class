
<?php

    include('navigation.php');
    include('db.php');
    session_start();

    // if user not loged in
    if(!isset($_SESSION["admin"])){
        header("Location: index.php");
    }


    if (array_key_exists("cid", $_GET) and array_key_exists("stid", $_GET)) {
        $cid = (int)$_GET["cid"];
        $stid = (int)$_GET["stid"];
        $date = date("Y-m-d");

        // Corrected prepared statement with proper concatenation and date handling:
        $stmt = $conn->prepare("INSERT INTO student_attendance (stid, cid, date) VALUES (?, ?, STR_TO_DATE(?, '%Y-%m-%d'))");
        $stmt->bind_param("iis", $stid, $cid, $date);

        if ($stmt->execute()) {
            header("Location: student_info.php?att=true&val"); 
        }
        }

?>