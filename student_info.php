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
    <title>Student Infomations</title>
</head>
<body>



<!-- section 01 -->
    <div class="container_1">

        <?php

            if (array_key_exists("val", $_GET)) {
                echo "<h3>Student Information</h3><br>";
                $_SESSION["stid"] = $_GET["val"];
                $stid = $_SESSION["stid"];

                $student_sql = "SELECT * FROM student WHERE stid = $stid";

                $student_result = mysqli_query($conn, $student_sql);

                if($student_result){
                
                    if(mysqli_num_rows($student_result) > 0){
                        while($row = mysqli_fetch_array($student_result)){

                        
                        echo "<div class='row g-2'> 
                                <div class='col-3'>
                                    <div class='p-3 border bg-light'>Name : </div></div>
                                <div class='col-5'>
                                    <div class='p-3 border bg-light'>" . $row['stname'] ."</div></div>
                            </div> ";

                        echo "<div class='row g-2'> 
                                <div class='col-3'>
                                    <div class='p-3 border bg-light'>NIC : </div></div>
                                <div class='col-5'>
                                    <div class='p-3 border bg-light'>" . $row['stnic'] ."</div></div>
                            </div> ";                    

                        echo "<div class='row g-2'> 
                                <div class='col-3'>
                                    <div class='p-3 border bg-light'>Address : </div></div>
                                <div class='col-5'>
                                    <div class='p-3 border bg-light'>" . $row['address'] ."</div></div>
                            </div> ";
                            
                        echo "<div class='row g-2'> 
                                <div class='col-3'>
                                    <div class='p-3 border bg-light'>Phone Number : </div></div>
                                <div class='col-5'>
                                    <div class='p-3 border bg-light'>" . $row['phone'] ."</div></div>
                            </div> ";

                        echo "<div class='row g-2'> 
                                <div class='col-3'>
                                    <div class='p-3 border bg-light'>Batch : </div></div>
                                <div class='col-5'>
                                    <div class='p-3 border bg-light'>" . $row['batch'] ."</div></div>
                            </div> <br>";

                        }

                    }else{
                        echo "<div class='alert alert-danger'>No Records</div>";
                        die();
                        }
                }

            }
        ?>

    </div>







<!-- section 02 -->
    <div class="container_1">

        <?php

            echo "<br><h3>Enrolled Classes</h3>";

            if (array_key_exists("att", $_GET)){
                echo "<div class='alert alert-success'>Attendance Marked</div>";
            }

            $class_sql = "SELECT * FROM student, student_class, class, teacher
                            WHERE student.stid = student_class.stid
                            AND student.stid = 55
                            AND class.cid = student_class.cid
                            AND teacher.tid = class.tid
                            ORDER BY(day)";

            $result_class = mysqli_query($conn, $class_sql);

            if($result_class){
                if(mysqli_num_rows($result_class) > 0){
                    
                    ?>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Class</th>
                            <th scope="col">Teacher</th>
                            <th scope="col">Day</th>
                            <th scope="col">From</th>
                            <th scope="col">To</th>
                            <th scope="col">Attendance</th>
                        </tr></thead>
                        <tbody>
        
                    <?php
                    $no = 1;
                    while($row = mysqli_fetch_array($result_class)){

                        ?>
                    <tr>
                        <th scope="row"><?php echo $no; ?></th>
                        <td><?php echo $row['cname']; ?></td>
                        <td><?php echo $row['tname']; ?></td>
                        <td><?php echo $row['day']; ?></td>
                        <td><?php echo $row['starttime']; ?></td>
                        <td><?php echo $row['endtime']; ?></td>
                        <td><?php echo "<a href='mark_attendace.php?cid=" . $row['cid'] . "&stid=" . $row['stid'] . "'><input type='button' value='Mark' class='btn btn-outline-success'> </a>" ?> </td>
                    </tr>                     
                        
                <?php
                    $no++; }
                ?>  

                 </tbody></table>

                <?php

                }else{
                    echo "<div class='alert alert-danger'>Not enrolled to any class</div>";
                }
            }
        ?>

    </div>








<!-- section 03 -->
    <div class="container_1">

        <h3>Add to Classes</h3>
        <div class="card-container" style="display: flex; flex-wrap: wrap;">
        
        <?php

$sql = "SELECT class.cid, cname, tname, starttime, endtime, day
                    FROM class , teacher , student_class , student
                    WHERE class.tid = teacher.tid 
                    AND student.stid = 55";

            $result = mysqli_query($conn, $sql);

            if($result){
                
                if(mysqli_num_rows($result) > 0){
                    while($row = mysqli_fetch_array($result)){

                        ?>  
                                
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['cname']; ?></h5>
                            <p class="card-text"><?php echo $row['tname'] . "<br>" . $row['day'] . "<br>" . $row['starttime'] . " to " . $row['endtime']; ?></p>
                            <?php echo "<a href='enroll.php?ecid=" .  $row['cid'] . "&estid=" . $stid . "'><input type='button' value='Enroll' class='btn btn-warning'> </a>" ?>
                        </div>
                    </div> 
                    
                        
                <?php
                   } ?></div>


                <?php
                }else{
                    echo "<div class='alert alert-danger'>There is not any class</div>";
                }
            }
        ?>
    </div>   

</body>
</html>