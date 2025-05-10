<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $status = $_POST['status'];

    if ($status === "Completed") {
        // Get the order details
        $stmt = $conn->prepare("SELECT * FROM orders WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($order = $result->fetch_assoc()) {
            $order_id = $order['id'];
            $user_id = $order['user_id'];
            $user_email = $order['user_email'];
            $product_id = $order['product_id'];
            $product_name = $order['product_name'];
            $quantity = $order['quantity'];
            $sub_total = $order['sub_total'];
            $date = date("Y-m-d H:i:s");

            // Get the user's full name (optional)
            $user_stmt = $conn->prepare("SELECT CONCAT(first_name, ' ', last_name) as full_name FROM user WHERE id = ?");
            $user_stmt->bind_param("i", $user_id);
            $user_stmt->execute();
            $user_result = $user_stmt->get_result();
            $user_name = $user_result->fetch_assoc()['full_name'];

            // Insert into completed_orders
            $insert = $conn->prepare("INSERT INTO completed_orders (order_id, user_id, user_name, product_id, product_name, quantity, sub_total, date_completed)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $insert->bind_param("iisssids", $order_id, $user_id, $user_name, $product_id, $product_name, $quantity, $sub_total, $date);
            $insert->execute();

            // Delete from orders
            $delete = $conn->prepare("DELETE FROM orders WHERE id = ?");
            $delete->bind_param("i", $id);
            $delete->execute();

            echo "Order marked as completed.";
        } else {
            echo "Order not found.";
        }
    } else {
        // Just update status
        $stmt = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->bind_param("si", $status, $id);
        if ($stmt->execute()) {
            echo "Status updated.";
        } else {
            echo "Failed to update.";
        }
    }
}
?>

