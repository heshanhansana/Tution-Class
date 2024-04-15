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
        $stid = $_POST["stid"];
        $stname = $_POST["stname"];
        $stnic = $_POST["stnic"];
        $batch = $_POST["batch"];
        $address = $_POST["address"];
        $phone = $_POST["phone"];

        $stmt = $conn->prepare("UPDATE student SET stnic = ?, stname = ?, address = ?, batch = ?, phone = ? WHERE stid = ?");
        $stmt->bind_param("issiii", $stnic, $stname, $address, $batch, $phone, $stid);

        if ($stmt->execute()) {
           header("Location: students.php"); 

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

        if (array_key_exists("stid", $_GET)) {
            $stid = $_GET["stid"];
     
            $sql = "SELECT * FROM student WHERE stid = '$stid'";
            $result = mysqli_query($conn, $sql);
     
            if($result){
              
                 if(mysqli_num_rows($result) > 0){
                     while($row = mysqli_fetch_array($result)){
                     
    ?>
    
    
    <form action="studentedit.php" method="post">

        <div class="form-row">
            <input type="hidden" name="stid" value="<?php echo $row["stid"]; ?>">

            <div class="col-md-4 mb-3">
                <input type="text" name="stname" class="form-control" placeholder="Name:" value="<?php echo $row['stname']; ?>"></div>
                                    
            <div class="col-md-3 mb-3">
                <input type="number" name="stnic" class="form-control" placeholder="NIC Number:" value=<?php echo $row['stnic']; ?>></div>

            <div class="col-md-5 mb-3">
                <input type="text" name="address" class="form-control" placeholder="Address:" value="<?php echo $row['address']; ?>"></div>
        </div>

        <div class="form-row">
            <div class="col-md-2 mb-3">
                <input type="number" name="batch" class="form-control" placeholder="Batch:" value=<?php echo $row['batch']; ?>></div>

            <div class="col-md-3 mb-3">
                <input type="number" name="phone" class="form-control" placeholder="Phone:" value="<?php echo $row['phone']; ?>"></div>

            <div class="col-md-2 mb-3">
                <input type="submit" value="Update" name="update" class="btn btn-info">
                <a href="students.php"><input type="button" value="Cancel" name="cancel" class="btn btn-danger"></div></a>

        </div>

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
