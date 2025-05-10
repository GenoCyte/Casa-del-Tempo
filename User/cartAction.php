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
        if(isset($_GET['remove'])){
            $id = $_GET['remove'];
            $stmt = $conn->prepare("DELETE FROM cart WHERE id=? AND user_email = ?");
            $stmt->bind_param("is", $id, $user);
            $stmt->execute();

            $_SESSION['showAlert'] = 'block';
            $_SESSION['message'] = 'Item remove';
            header('location: cart.php');
        }

        if(isset($_GET['clear'])){
            $stmt = $conn->prepare("DELETE FROM cart WHERE user_email = ?");
            $stmt->bind_param("s", $user);
            $stmt->execute();
            header('location: cart.php');
        }

        if(isset($_POST['qty'])){
            $qty = $_POST['qty'];
            $pid = $_POST['pid'];
            $pprice = $_POST['pprice'];

            $tprice = $qty*$pprice;

            $stmt = $conn->prepare("UPDATE cart SET quantity = ?, sub_total = ? WHERE id = ? AND user_email = ?");
            $stmt->bind_param("iiis", $qty, $tprice, $pid, $user);
            $stmt->execute();
        }
    }
?>