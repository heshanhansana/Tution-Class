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
    <title>Classes</title>
</head>
<body>

<div class="container_1">
<h3>Add Classes</h3><br>
    
    <form class="needs-validation" novalidate action="classes.php" method="POST">
        <div class="form-row">

            <div class="col-md-4 mb-3">
                <input type="text" name="cname" placeholder="Class Name:" class="form-control"/></div>

            <div class="col-md-4 mb-3">
            <select name="teacher" class="form-control">
                <?php            
                
                $sql = "SELECT tid, tname FROM teacher";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    echo "<option value=''>Select Teacher</option>";
                
                while($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row["tid"] . "'>" . $row["tname"] . "</option>";
                  
                    }
                }

                ?>
                </select></div>


            <div class="col-md-3 mb-3">
                <select name="day" id="" class="form-control">
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select></div>
        </div>
        
        <div class="form-row">
            <div class="col-md-3 mb-3">
                <input type="time" name="starttime" value="08:30" class="form-control"/></div>

            <div class="col-md-3 mb-3">
                <input type="time" name="endtime" value="10:30" class="form-control"/></div>

            <div class="col-md-3 mb-3">
                <input type="submit" name="add" value="Add" class="btn btn-primary"/></div>

        </div> 
        
    </form>

    <?php

        if(isset($_POST["add"])){
            $cname = $_POST["cname"];
            $teacher = $_POST["teacher"];
            $day = $_POST["day"];
            $starttime = $_POST["starttime"];
            $endtime = $_POST["endtime"];
            $errors =  array();

            if(empty($cname) OR empty($teacher) OR empty($day) OR empty($starttime) OR empty($endtime)){
                array_push($errors, "All fields are required");
            }
        
            if(count($errors) < 1){
                $sql = "SELECT * FROM class WHERE cname = '$cname'";
                $result = $conn->query($sql);
        
                if($result -> num_rows > 0){
                    array_push($errors, "Class already exist");
                }
            }
        
            if(count($errors) > 0){
                foreach($errors as $error){
                    echo "<div class='alert alert-danger'>$error</div>";
                }
            }
        
            else{
                $sql = "INSERT INTO class(cname, tid, day, starttime, endtime) VALUES(?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                
                if($prepareStmt){
                    mysqli_stmt_bind_param($stmt, "sssss", $cname, $teacher, $day, $starttime, $endtime);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>".$cname." Added Successfuly !</div>";
                }
        
                else{
                    die("Student doesn't added !");
                }
            }
            }
    ?>


</div>


<div class="container_1">

        <h3>Class Details</h3><br>

        <table class="table table-hover">
            <thead>
                <tr>
            <!--    <th scope="col">No</th> -->
                <th scope="col">Name</th>
                <th scope="col">Teacher</th>
                <th scope="col">Day</th>
                <th scope="col">From</th>
                <th scope="col">To</th>
                <th scope="col">Update</th>
            </tr></thead>
            <tbody>



        <?php
            $sql = "SELECT * FROM class, teacher
                    WHERE class.tid = teacher.tid
                    ORDER BY(tname)";

            $result = mysqli_query($conn, $sql);

            if($result){
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){

                ?>

                <tr>
                  <!--  <th scope="row"><?php echo $row['cid']; ?></th> -->
                    <td><?php echo $row['cname']; ?></td>
                    <td><?php echo $row['tname']; ?></td>
                    <td><?php echo $row['day']; ?></td>
                    <td><?php echo $row['starttime']; ?></td>
                    <td><?php echo $row['endtime']; ?></td>
                    <td><?php echo "<a href='classedit.php?cid=" . $row["cid"] . "&teacher=" .$row["tid"] . "&day=" .$row["day"].  "&st=" .$row["starttime"] . "&end=".$row["endtime"]. "'><input type='button' value='Edit' class='btn btn-success'> </a>"?></td>
                </tr>
                        
                        
                <?php
              
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