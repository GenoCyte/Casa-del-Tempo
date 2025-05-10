<?php
include 'config.php';

$sql = "SELECT id, user_email, product_name, price, quantity, sub_total, status FROM orders";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Pending Orders</title>
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
      <h3>Pending Orders</h3>
    </div>

    <table>
      <thead>
        <tr>
          <th>User Email</th>
          <th>Product</th>
          <th>Price (₱)</th>
          <th>Qty</th>
          <th>Subtotal (₱)</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
          <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= htmlspecialchars($row['user_email']) ?></td>
              <td><?= htmlspecialchars($row['product_name']) ?></td>
              <td>₱<?= number_format($row['price'], 2) ?></td>
              <td><?= (int)$row['quantity'] ?></td>
              <td>₱<?= number_format($row['sub_total'], 2) ?></td>
              <td>
                <select onchange="updateStatus(<?= $row['id'] ?>, this.value)">
                  <option value="Pending" <?= $row['status'] == 'Pending' ? 'selected' : '' ?>>Pending</option>
                  <option value="Confirmed" <?= $row['status'] == 'Confirmed' ? 'selected' : '' ?>>Confirmed</option>
                  <option value="On Delivery" <?= $row['status'] == 'On Delivery' ? 'selected' : '' ?>>On Delivery</option>
                  <option value="Cancelled" <?= $row['status'] == 'Cancelled' ? 'selected' : '' ?>>Cancelled</option>
                </select>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="6">No orders found.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <script>
    function updateStatus(orderId, newStatus) {
      fetch('update_status.php', {
        method: 'POST',
        headers: {'Content-Type': 'application/x-www-form-urlencoded'},
        body: `id=${orderId}&status=${newStatus}`
      })
      .then(response => response.text())
      .then(data => {
        console.log("Updated:", data);
      })
      .catch(error => console.error('Error:', error));
    }
  </script>
</body>
</html>
