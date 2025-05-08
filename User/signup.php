<?php
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $otp = 0;

    $conn = new mysqli('localhost', 'root', '', 'casa_del_tempo');
    if($conn->connect_error){
        die('Connection Failed : ' .$conn->connect_error);
    }

    $sql = "SELECT username from user WHERE username = '$username'";
    $result = $conn->query($sql);
    if($result -> num_rows > 0){
        echo"<script>
                alert('Username is Already Used')
                window.location='login.html'
            </script>";
    }
    else{
        $stmt = $conn->prepare("insert into user(username, email, password)
        values (?,?,?)");
        $stmt->bind_param("sss", $username, $email, $password);
        $stmt->execute();

        echo"<script type='text/javascript'> 
                alert('Registration Successful');
                window.location='login.html'
            </script>";
        $stmt->close();
        $conn->close();
    }
?>