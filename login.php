<?php
    session_start();
    $conn = new mysqli('localhost', 'root', '', 'casa_del_tempo');
    if($conn->connect_error){
        die('Connection Failed : ' .$conn->connect_error);
    }
    if(isset($_POST['submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $stmt = $conn->prepare("select * from user where username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt_result = $stmt->get_result();
        if($stmt_result->num_rows > 0){
            $data = $stmt_result->fetch_assoc();
            if($data['password'] === $password){
                $_SESSION['username'] = $username;
                echo"<script type='text/javascript'> 
                    alert('Log-In Successful');
                    window.location='home.html';
                    </script>";
            }else{
                echo"<script type='text/javascript'> 
                    alert('Wrong Email or Password');
                    window.location='login.html';
                </script>";
            }
        }else{
            echo"<script type='text/javascript'> 
                alert('Wrong Email or Password');
                window.location='login.html';
            </script>";
        }
    }
?>