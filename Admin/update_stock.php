<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['product_id'];
    $stock = $_POST['stock'];

    if (is_numeric($stock) && $stock >= 0) {
        $stmt = $conn->prepare("UPDATE watch SET stock = ? WHERE id = ?");
        $stmt->bind_param("ii", $stock, $id);
        if ($stmt->execute()) {
            echo "Stock updated successfully.";
        } else {
            echo "Error updating stock.";
        }
    } else {
        echo "Invalid stock value.";
    }
}
?>
