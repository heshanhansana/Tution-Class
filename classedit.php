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
        $cname = $_POST["cname"];
        $teacher = $_POST["teacher"];
        $day = $_POST["day"];
        $st = $_POST["starttime"];
        $end = $_POST["endtime"];

        $stmt = $conn->prepare("UPDATE class SET cname = ?, day = ?, tid = ?, starttime = ?, endtime= ? WHERE cid = ?");
        $stmt->bind_param("ssisss", $cname, $day, $teacher, $st, $end, $id);

        if ($stmt->execute()) {
           header("Location: classes.php"); 

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

        if (array_key_exists("cid", $_GET) && array_key_exists("teacher", $_GET)) {
            $cid = $_GET["cid"];
            $teacher = $_GET["teacher"];
     
            $sql = "SELECT * FROM class WHERE cid = '$cid'";
            $result = mysqli_query($conn, $sql);
     
            if($result){
              
                 if(mysqli_num_rows($result) > 0){
                     while($row = mysqli_fetch_array($result)){
                     
    ?>
    
    
    <form action="classedit.php" method="post">

        <div class="form-row">
            <input type="hidden" name="id" value="<?php echo $row["cid"]; ?>">

            <div class="col-md-4 mb-3">
                <input type="text" name="cname" class="form-control" placeholder="Class Name" value="<?php echo $row['cname']; ?>"></div>
                                    
            <div class="col-md-4 mb-3">
                <select name="teacher" class="form-control">
                    <?php            
                    
                    $sql = "SELECT tid, tname FROM teacher";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                                           
                        while ($row = $result->fetch_assoc()) {
                            $selected = ($row['tid'] == $teacher) ? ' selected' : '';
                            echo "<option value='" . $row["tid"] . "'" . $selected . ">" . $row["tname"] . "</option>";
                          }
                        }   

                    ?>
                </select>
            </div>

            <div class="col-md-4 mb-3">
                <select name="day" id="" class="form-control">
                    <option value="Monday">Monday</option>
                    <option value="Tuesday">Tuesday</option>
                    <option value="Wednesday">Wednesday</option>
                    <option value="Thursday">Thursday</option>
                    <option value="Friday">Friday</option>
                    <option value="Saturday">Saturday</option>
                    <option value="Sunday">Sunday</option>
                </select>
            </div>

            <div class="col-md-3 mb-3">
                <input type="time" name="starttime" class="form-control" value="<?php echo $row['starttime']; ?>"></div>

            <div class="col-md-3 mb-3">
                <input type="time" name="endtime" class="form-control" value="<?php echo $row['endtime']; ?>"></div>

            <div class="col-md-2 mb-3">
                <input type="submit" value="Update" name="update" class="btn btn-info">
                <a href="classes.php"><input type="button" value="Cancel" name="cancel" class="btn btn-danger"></div></a>

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
