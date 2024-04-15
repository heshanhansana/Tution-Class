<?php
    include('navigation.php');
    include('db.php');
    session_start();

    // if user not loged in
    if(!isset($_SESSION["admin"])){
        header("Location: index.php");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Students</title>
</head>
<body>


<div class="container_1">
    <h3>Add Student</h3><br>
    
    <form class="needs-validation" novalidate action="students.php" method="POST">
        <div class="form-row">

            <div class="col-md-4 mb-3">
                <input type="text" name="stname" placeholder="Name:" class="form-control"/></div>

            <div class="col-md-3 mb-3">
                <input type="number" name="stnic" placeholder="NIC Number" class="form-control"/></div>

            <div class="col-md-5 mb-3">
                <textarea class="form-control" rows="1" name="address" placeholder="Address"></textarea></div>

        </div>
                
        <div class="form-row">

            <div class="col-md-2 mb-3">
                <input type="number" name="batch" placeholder="A/L Year:" class="form-control"/></div>           

            <div class="col-md-3 mb-3">
                <input type="number" name="phone" placeholder="Mobile Number" class="form-control"/></div>

            <div class="col-md-3 mb-3">
                <input type="submit" name="add" value="Add" class="btn btn-primary"/></div>

        </div> 
        
    </form>
    
    <?php

    if(isset($_POST["add"])){
    $stname = $_POST["stname"];
    $stnic = $_POST["stnic"];
    $batch = $_POST["batch"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $errors =  array();

    if(empty($stname) OR empty($batch) OR empty($address) OR empty($phone)){
        array_push($errors, "All fields are required");
    }

    if(count($errors) < 1){
        $sql = "SELECT * FROM student WHERE stnic = '$stnic'";
        $result = $conn->query($sql);

        if($result -> num_rows > 0){
            array_push($errors, "Student already exist");
        }
    }

    if(count($errors) > 0){
        foreach($errors as $error){
            echo "<div class='alert alert-danger'>$error</div>";
        }
    }

    else{
        $sql = "INSERT INTO student(batch, stnic, stname, address, phone) VALUES(?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        
        if($prepareStmt){
            mysqli_stmt_bind_param($stmt, "iissi", $batch, $stnic, $stname, $address, $phone);
            mysqli_stmt_execute($stmt);
            echo "<div class='alert alert-success'>".$stname." Added Successfuly !</div>";

            $sql = "SELECT MAX(stid) AS stid FROM student";
            $result = mysqli_query($conn, $sql);

            $row = mysqli_fetch_assoc($result);
            $stid = $row['stid'];

            include('qrgenerate.php');
        }

        else{
            die("Student doesn't added !");
        }
    }
    }
    ?>

</div>



<div class="container_1">
    <br><h3>Student Details</h3><br>

        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">StNo</th>
                <th scope="col">Batch</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Phone</th>
                <th scope="col">Update</th>
            </tr></thead>
            <tbody>

        <?php
            $sql = "SELECT * FROM student";
            $result = mysqli_query($conn, $sql);

            if($result){
                if(mysqli_num_rows($result) > 0){
                    $sno = 1;
                    while($row = mysqli_fetch_array($result)){

                ?>

                <tr>
                    <th scope="row"><?php echo $sno; ?></th>
                    <td><?php echo $row['batch']; ?></td>
                    <td><?php echo $row['stname']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo "<a href='studentedit.php?stid=" . $row["stid"] . "'><input type='button' value='Edit' class='btn btn-success'> </a>"?></td>
                </tr>
                        
                        
                <?php
                    $sno++;
                } ?>  
                </tbody></table><?php
            }
        }else{
            echo "<div class='alert alert-danger'>No Records</div>";
        }
     ?>

</div>

</body>
</html>