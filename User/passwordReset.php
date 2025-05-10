<?php
    session_start();
    require 'config.php';

    if($conn->connect_error){
        die('Connection Failed : ' .$conn->connect_error);
    }

    $user = $_SESSION['email'];

    $reset = $_POST['password'];

    $sql = "UPDATE user SET password = '$reset' WHERE email = '$user'";

    // Execute the query
    if ($conn->query($sql) === TRUE) {
        echo"<script>
                alert('Password Reset Successfully')
                window.location='Login.html'
            </script>";
    }
    $conn->close();
?>