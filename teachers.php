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
    <title>Teachers</title>
</head>
<body>

<div class="container_1">
    <h3>Add Teacher</h3><br>
    
    <form class="needs-validation" novalidate action="teachers.php" method="POST">
        <div class="form-row">

            <div class="col-md-3 mb-3">
                <input type="text" name="tname" placeholder="Name:" class="form-control"/></div>

            <div class="col-md-2 mb-3">
                <input type="number" name="tnic" placeholder="NIC :" class="form-control"/></div>

            <div class="col-md-3 mb-3">
                <input type="text" name="subject" placeholder="Subject:" class="form-control"/></div>

            <div class="col-md-2 mb-3">
                <input type="number" name="phone" placeholder="Mobile Number" class="form-control"/></div>

            <div class="col-md-2 mb-3">
                <input type="submit" name="add" value="Add" class="btn btn-primary"/></div>

        </div> 
    </form>


    <?php

    if(isset($_POST["add"])){
        $tname = $_POST["tname"];
        $tnic = $_POST["tnic"];
        $subject = $_POST["subject"];
        $phone = $_POST["phone"];
        $errors =  array();

        if(empty($tname) OR empty($tnic) OR empty($subject) OR empty($phone)){
            array_push($errors, "All fields are required");
        }

        if(count($errors) < 1){
            $sql = "SELECT * FROM teacher WHERE tnic = '$tnic'";
            $result = $conn->query($sql);

            if($result -> num_rows > 0){
                array_push($errors, "Teacher already exist");
            }
        }

        if(count($errors) > 0){
            foreach($errors as $error){
                echo "<div class='alert alert-danger'>$error</div>";
            }
        }

        else{

            $sql = "INSERT INTO teacher(tnic, tname, subject, phone) VALUES(?,?,?,?)";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
            
            if($prepareStmt){
                mysqli_stmt_bind_param($stmt, "issi", $tnic, $tname, $subject, $phone);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>".$tname." Added Successfuly !</div>";
            }

            else{
                die("Student doesn't added !");
            }
        }
    }
    ?>

</div>


<div class="container_1">
        <br><h3>Teacher Details</h3><br>

        <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">NIC</th>
                <th scope="col">Subject</th>
                <th scope="col">Phone</th>
                <th scope="col">Update</th>
            </tr></thead>
            <tbody>

        <?php
            $sql = "SELECT * FROM teacher";
            $result = mysqli_query($conn, $sql);

            if($result){
                if(mysqli_num_rows($result) > 0){
                    $tno = 1;
                    while($row = mysqli_fetch_array($result)){

                ?>

                <tr>
                    <th scope="row"><?php echo $tno; ?></th>
                    <td><?php echo $row['tname']; ?></td>
                    <td><?php echo $row['tnic']; ?></td>
                    <td><?php echo $row['subject']; ?></td>
                    <td><?php echo $row['phone']; ?></td>
                    <td><?php echo "<a href='teacheredit.php?tid=" . $row["tid"] . "'><input type='button' value='Edit' class='btn btn-success'> </a>"?></td>
                </tr>
                        
                        
                <?php

                $tno++;
              
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