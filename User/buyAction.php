<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';
require 'config.php';

if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
}

if (!isset($_SESSION['email'])) {
    die("User not logged in.");
}

$user = $_SESSION['email'];

// Fetch user data
$stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
$stmt->bind_param("s", $user);
$stmt->execute();
$user_result = $stmt->get_result();

if ($user_row = $user_result->fetch_assoc()) {
    $uid = $user_row['id'];
    $uname = $user_row['first_name'];
    $lname = $user_row['last_name'];
    $address = $user_row['address'];
    $contact = $user_row['contact'];
    $email = $user_row['email'];
    $date = date("Y-m-d");

    // Fetch cart items
    $cart_items = [];
    $query = $conn->prepare("SELECT * FROM cart WHERE user_email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $cart_result = $query->get_result();

    while ($cart_row = $cart_result->fetch_assoc()) {
        $cart_items[] = $cart_row;
    }

    // Process order
    if (isset($_GET['order']) && count($cart_items) > 0) {
        foreach ($cart_items as $item) {
            $pid = $item['product_id'];
            $pname = $item['product_name'];
            $pprice = $item['price'];
            $qty = $item['quantity'];
            $total_price = $item['sub_total'];
            $status = "Pending";

            $insert = $conn->prepare("INSERT INTO orders (user_id, user_email, product_id, product_name, price, quantity, sub_total, date, status)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $insert->bind_param("isississs", $uid, $email, $pid, $pname, $pprice, $qty, $total_price, $date, $status);
            $insert->execute();
        }

        // Build receipt HTML
        $total = 0;
        $tableRows = "";
        foreach ($cart_items as $item) {
            $itemName = $item['product_name'];
            $itemQuantity = $item['quantity'];
            $itemPrice = $item['price'];
            $itemTotal = $item['sub_total'];
            $total += $itemTotal;

            $tableRows .= "
                <tr>
                    <td style='text-align: center;'>$itemName</td>
                    <td style='text-align: center;'>$itemQuantity</td>
                    <td style='text-align: center;'>₱$itemPrice</td>
                    <td style='text-align: center;'>₱$itemTotal</td>
                </tr>
            ";
        }

        // Send receipt email
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'gazerampong@gmail.com';
            $mail->Password   = 'evyhcpmithdrhafp';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->setFrom('gazerampong@gmail.com', 'JNRR');
            $mail->addAddress($user, 'User');

            $mail->isHTML(true);
            $mail->Subject = 'JNRR Official Receipt';
            $mail->Body = "
                <h2>Receipt</h2>
                <p>Hello $uname $lname,</p>
                <p>Thank you for your purchase. Here is your receipt:</p>
                <table border='1' cellpadding='5' cellspacing='0'>
                    <tr>
                        <th>Item</th>
                        <th>Kilos</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                    $tableRows
                    <tr>
                        <td colspan='3' align='right'><strong>Total:</strong></td>
                        <td><strong>₱$total</strong></td>
                    </tr>
                </table>
                <p>This will be delivered to: $address</p>
                <p>The delivery rider will contact: $contact</p>
                <p>Please wait 1-3 hours for delivery.</p>
                <p>Thank you for your business!</p>
            ";

            $mail->send();
        } catch (Exception $e) {
            echo "Mailer Error: {$mail->ErrorInfo}";
        }

        // Clear cart
        $sql = $conn->prepare("DELETE FROM cart WHERE user_email = ?");
        $sql->bind_param("s", $email);
        $sql->execute();

        echo "<script>alert('Thank You For Ordering'); window.location='home.php';</script>";
        exit;
    }

    // Clear cart manually
    if (isset($_GET['clear'])) {
        $stmt = $conn->prepare("DELETE FROM cart WHERE user_email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        header('location: cart.php');
        exit;
    }

    // Update quantity
    if (isset($_POST['qty']) && isset($_POST['pid']) && isset($_POST['pprice'])) {
        $qty = (int)$_POST['qty'];
        $pid = (int)$_POST['pid'];
        $pprice = (float)$_POST['pprice'];
        $tprice = $qty * $pprice;

        $stmt = $conn->prepare("UPDATE cart SET quantity = ?, sub_total = ? WHERE id = ?");
        $stmt->bind_param("idi", $qty, $tprice, $pid);
        $stmt->execute();
    }
}
?>
