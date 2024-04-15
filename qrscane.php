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
<title>Search Student</title>
<style>
    #preview {
        width: 100%;
        height: auto;
    }
</style>
</head>


<body>

<div class="main">

    <div class="container">
        <h3>With QR</h3>
        <button id="startButton" class="btn btn-outline-success">Scan QR Code</button><br>
        <div id="scanner-container" style="display: none;"> <br> <video id="preview"></video><br><br></div>
    </div>
        

    <div class="container">
        <h3>With NIC</h3>
        <input id="student_id" type="number" placeholder="Enter NIC number" class="form-control"><br>
        <button id="searchButton" class="btn btn-outline-success">Search</button>
    </div> 

</div>    


    
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>

        // const scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        
        // document.getElementById('startButton').addEventListener('click', function() {
        //     Instascan.Camera.getCameras().then(function (cameras) {
        //         if (cameras.length > 0) {
        //             scanner.start(cameras[0]);
        //             // When the button is clicked, show the video element
        //             videoElement.style.display = "block";
                    
        //         } else {
        //             console.error('No cameras found.');
        //         }
        //     }).catch(function (e) {
        //         console.error(e);
        //     });
        // });

        const scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
        const scannerContainer = document.getElementById('scanner-container');

        document.getElementById('startButton').addEventListener('click', function() {
            Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
                scannerContainer.style.display = "block"; // Show the video element on button click
            } else {
                console.error('No cameras found.');
            }
            }).catch(function (e) {
            console.error(e);
            });
        });
        
        scanner.addListener('scan', function (content) {
            document.getElementById('student_id').value = content;
            window.location.href = 'student_info.php?val='  + content;
        });


        const searchButton = document.getElementById('searchButton');

        searchButton.addEventListener('click', function() {
        const studentId = document.getElementById('student_id').value.trim();

        if (studentId) { 
            window.location.href = 'student_info.php?val=' + studentId;
        } else {
            alert('Please enter a student ID.');
        }
        });


    </script>
</body>
</html>
