<?php
include 'config.php';

$completedOrders = $conn->query("SELECT * FROM orders WHERE status = 'Completed'");

while ($row = $completedOrders->fetch_assoc()) {
    $order_id = $row['id'];
    $user_id = $row['user_id'];
    $user_email = $row['user_email'];
    $product_id = $row['product_id'];
    $product_name = $row['product_name'];
    $quantity = $row['quantity'];
    $sub_total = $row['sub_total'];
    $date_completed = date('Y-m-d');

    // Insert into completed_orders
    $stmt = $conn->prepare("INSERT INTO completed_orders (order_id, user_id, user_email, product_id, product_name, quantity, sub_total, date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("iisssids", $order_id, $user_id, $user_email, $product_id, $product_name, $quantity, $sub_total, $date_completed);
    $stmt->execute();

    // Delete from orders
    $conn->query("DELETE FROM orders WHERE id = '$order_id'");
}

$sql = "SELECT order_id, user_id, user_email, product_id, product_name, quantity, sub_total, date FROM completed_orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Completed Orders</title>
  <link rel="stylesheet" href="Pending_Orders.css" />
</head>
<body>
  <div class="sidebar">
    <img src="494359330_1233460488360589_7879654938418815485_n.jpg" class="profile1-img" />
    <p><strong>Jed Melben</strong></p>
    <p>jEdMeLbEn@gmail.com</p>
    <hr />
    <a href="dashboard.php">Dashboard</a>
    <a href="Pending_Orders.php">Pending Orders</a>
    <a href="Confirmed_Orders.php">Complete Orders</a>
    <a href="stock.php">Stocks</a>
    <a href="add_product.php">Add Product</a>
  </div>

  <div class="content">
    <div class="dashboard-header">
      <h3>Completed Orders</h3>
    </div>

    <table>
      <thead>
        <tr>
          <th>Order ID</th>
          <th>User ID</th>
          <th>User email</th>
          <th>Product ID</th>
          <th>Product Name</th>
          <th>Quantity</th>
          <th>Subtotal (₱)</th>
          <th>Date Completed</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['order_id']) ?></td>
              <td><?= htmlspecialchars($row['user_id']) ?></td>
              <td><?= htmlspecialchars($row['user_email']) ?></td>
              <td><?= htmlspecialchars($row['product_id']) ?></td>
              <td><?= htmlspecialchars($row['product_name']) ?></td>
              <td><?= (int)$row['quantity'] ?></td>
              <td>₱<?= number_format($row['sub_total'], 2) ?></td>
              <td><?= htmlspecialchars($row['date']) ?></td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="8">No completed orders found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
