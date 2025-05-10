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

        $uid = $row["id"];
        $email = $row['email'];
        $pid = $_POST['pid'];
        $pname = $_POST['pname'];
        $pprice = $_POST['pprice'];
        $pimage = $_POST['pimage'];
        $quantity = 1;
        $subtotal = $pprice * $quantity;
        
        $query = $conn->prepare("SELECT product_id FROM cart WHERE product_id = ? AND user_email = ?");
        $query->bind_param("is", $pid, $user);
        $query->execute();
        $result = $query->get_result();
        $res = $result->fetch_assoc();

        if(!$res){
            $stmt = $conn->prepare("INSERT INTO cart (user_id, user_email, product_id, product_name, price, quantity, sub_total, image)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isisiiis", $uid, $email, $pid, $pname, $pprice, $quantity, $subtotal, $pimage);
            $stmt->execute();
            echo"<script type='text/javascript'> 
                    alert('Item added to cart');
                    window.location.href = 'specs.php?pid=$pid';
                    </script>";
        }else{
            echo"<script type='text/javascript'> 
                    alert('Item added to cart already');
                    window.location.href = 'specs.php?pid=$pid';
                    </script>";
        }
    }
?>