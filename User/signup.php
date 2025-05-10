<?php
    $username = $_POST['username'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    $otp = 0;

    $conn = new mysqli('localhost', 'root', '', 'casa_del_tempo');
    if($conn->connect_error){
        die('Connection Failed : ' .$conn->connect_error);
    }

    $sql = "SELECT email from user WHERE email = '$email'";
    $result = $conn->query($sql);
    if($result -> num_rows > 0){
        echo"<script>
                alert('Email is Already Used')
                window.location='login.html'
            </script>";
    }
    else{
        $stmt = $conn->prepare("insert into user(username, first_name, last_name, email, contact, address, password)
        values (?,?,?,?,?,?,?)");
        $stmt->bind_param("ssssiss", $username, $first_name, $last_name ,$email, $contact, $address, $password);
        $stmt->execute();

        echo"<script type='text/javascript'> 
                alert('Registration Successful');
                window.location='login.html'
            </script>";
        $stmt->close();
        $conn->close();
    }
?>