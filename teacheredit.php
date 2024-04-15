<?php

    include('navigation.php');
    include('db.php');
    session_start();

    // if user not loged in
    if(!isset($_SESSION["admin"])){
        header("Location: index.php");
    }

?>


<?php

    if(isset($_POST["update"])){
        $id = $_POST["id"];
        $tname = $_POST["tname"];
        $tnic = $_POST["tnic"];
        $subject = $_POST["subject"];
        $phone = $_POST["phone"];

        $stmt = $conn->prepare("UPDATE teacher SET tnic = ?, tname = ?, subject = ?, phone = ? WHERE tid = ?");
        $stmt->bind_param("issii", $tnic, $tname, $subject, $phone, $id);

        if ($stmt->execute()) {
           header("Location: teachers.php"); 

        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit</title>
</head>
<body>


<div class="container_1">

    <h3>Edit Details</h3><br>


    <?php

        if (array_key_exists("tid", $_GET)) {
            $tid = $_GET["tid"];
     
            $sql = "SELECT * FROM teacher WHERE tid = '$tid'";
            $result = mysqli_query($conn, $sql);
     
            if($result){
              
                 if(mysqli_num_rows($result) > 0){
                     while($row = mysqli_fetch_array($result)){
                     
    ?>
    
    
    <form action="teacheredit.php" method="post">

        <div class="form-row" align="center">
            <input type="hidden" name="id" value="<?php echo $row["tid"]; ?>">

            <div class="col-md-3 mb-3">
                <input type="text" name="tname" class="form-control" placeholder="Teacher Name" value="<?php echo $row['tname']; ?>"></div>
                                    
            <div class="col-md-2 mb-3">
                <input type="number" name="tnic" class="form-control" placeholder="NIC" value=<?php echo $row['tnic']; ?>></div>

            <div class="col-md-2 mb-3">
                <input type="text" name="subject" class="form-control" placeholder="Subject" value="<?php echo $row['subject']; ?>"></div>

            <div class="col-md-3 mb-3">
                <input type="number" name="phone" class="form-control" placeholder="Phone" value="<?php echo $row['phone']; ?>"></div>

            <div class="col-md-2 mb-3">
                <input type="submit" value="Update" name="update" class="btn btn-info">
                <a href="teachers.php"><input type="button" value="Cancel" name="cancel" class="btn btn-danger"></div></a>

    </form>

    </div>
</body>
</html>

<?php
          }
        }
      }
    }
?>
