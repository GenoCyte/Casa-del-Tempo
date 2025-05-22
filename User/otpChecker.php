<?php
    session_start();
    require 'config.php';

    $user = $_SESSION['email'];

    if($conn->connect_error){
        die('Connection Failed : ' .$conn->connect_error);
    }
    $otp = $_POST['otp'];

    $sql = "SELECT otp FROM user WHERE email = '$user'";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $storedPassword = $row['otp'];
    
        // Compare the input password with the stored password
        if ($otp == $storedPassword) {
            echo"<script>
                alert('OTP is Correct')
                window.location='forgotPass3.php'
            </script>";
        } else {
            echo"<script>
                alert('OTP is Incorrect')
                window.location='forgotPass2.php'
            </script>";
        }
    }
    $conn->close();
?>