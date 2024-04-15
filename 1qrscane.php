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
<title>QR Code Reader</title>
<style>
    #qr-video {
        width: 100%;
        height: auto;
    }
</style>
</head>


<body>
  <div class="container">
    <h3 align="center">Scan QR Code</h3><br>
    <video id="qr-video" playsinline></video><br><br>
<!--    <input type="text" id="qrData" placeholder="Student details" class="form-control" readonly> -->
  </div>

  <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <script>
    let scanner = new Instascan.Scanner({ video: document.getElementById('qr-video') });

    scanner.addListener('scan', function (content) {
    //  document.getElementById('qrData').value = content;

      // Redirect to abc.php if qrData has content
      if (content) {
        window.location.href = 'student_info.php?val='  + content;
      }
    });

    Instascan.Camera.getCameras().then(function (cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
      }
    }).catch(function (e) {
      console.error(e);
    });
  </script>
</body>

</html>