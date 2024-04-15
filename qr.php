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
    <title>Generate QR</title>
</head>
<body>

    <div class="container">
        <center>
        <input type="text" id="qrText" placeholder="NIC number" class="form-control"><br>
        <button onclick="generateQR()" class="btn btn-outline-danger">Generate QR Code</button><br><br>
        <div id="qrCode"></div><br>
        <a id="downloadLink" download="qrcode.png" style="display: none;">Download QR Code</a>
        </center>
    </div>


    <script>
        function generateQR() {
        const qrText = document.getElementById('qrText').value;
        fetch(`https://api.qrserver.com/v1/create-qr-code/?data=${qrText}&size=200x200`)
            .then(response => response.blob())
            .then(blob => {
            const qrCode = URL.createObjectURL(blob);
            document.getElementById('qrCode').innerHTML = `<img src="${qrCode}" alt="QR Code">`;
            document.getElementById('downloadLink').href = qrCode;
            document.getElementById('downloadLink').style.display = 'block';
            });
        }
    </script>

</body>
</html>