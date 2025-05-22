<?php
include 'config.php';

if (isset($_POST['delete'])) {
    $id = intval($_POST['id']);

    // Optional: remove image file if stored separately on disk

    // Delete the product from the table
    $stmt = $conn->prepare("DELETE FROM watch WHERE id = ?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: delete_product_tab.php?deleted=1");
        exit;
    } else {
        echo "Error deleting product.";
    }
}
?>
