<?php
    session_start();

    // if user loged in
    if(isset($_SESSION["admin"])){
        header("Location: dashboard.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Home</title>
</head>
<body>

   <div class="container">

   <h3>Admin Login</h3><br>
    

        
    <?php

        if(isset($_POST['login'])){
            require_once "db.php";
            $admin = $_POST['admin'];
            $password = $_POST['password'];

            $sql = "SELECT * FROM admin WHERE admin_name = '$admin'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

            // check eamil and password
            if($user){

               // if(password_verify($password, $user["password"])){
                    
                    $_SESSION["admin"] = $user['admin_name'];
                  //  $_SESSION["password_hash"] = $user['password'];
                
                 
                    header("Location: dashboard.php");
                    die();
              /*  }
                else{
                    echo "<div class='alert alert-danger'>Password dose not match</div>";
                }   /*/
            }

            else{
                echo "<div class='alert alert-danger'>Admin Name dose not match</div>";
            }
        }
        
    ?>


    <form action="index.php" method="post">

        <div class="form-group">
            <input type="text" name="admin" placeholder="Admin Name" class="form-control"/>
        </div>

        <div class="form-group">
            <input type="password" name="password" placeholder="Enter Password" class="form-control"/>
        </div>

        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-primary"/>
        </div>

    </form>

   </div>
    
</body>
</html>