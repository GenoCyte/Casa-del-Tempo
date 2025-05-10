<?php
    session_start();
    require 'config.php';

    if($conn->connect_error){
        die('Connection Failed : ' .$conn->connect_error);
    }
    if(isset($_SESSION['email'])){
        $user = $_SESSION['email'];
    }
    $stmt = $conn->prepare("SELECT * FROM user where email = '$user'");
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()){

        $username = $_POST["user_name"];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $address = $_POST['address'];
        $contact = $_POST['contact_number'];
        
        $stmt = $conn->prepare("UPDATE user SET username = ?, first_name = ?, last_name = ?, address = ?, contact = ? WHERE email = ?");
        $stmt->bind_param("ssssis", $username, $first_name, $last_name, $address, $contact, $user);
        $stmt->execute();
        echo"<script type='text/javascript'> 
                alert('Details Updated');
                window.location.href = 'user.php';
            </script>";
    }
?>