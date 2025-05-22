<?php
include 'config.php';

// Transfer completed orders to completed_orders table
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="dashboard.css" />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet" />
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
      <h3>Dashboard</h3>
    </div>

    <div class="dashboard-cards">
      <?php
        require 'config.php';
        $stocks = 0;
        $stmt = $conn->prepare("SELECT stock FROM watch");
        $stmt->execute();
        $result = $stmt->get_result();
        while ($row = $result->fetch_assoc()) {
            $stocks += $row['stock'];
        }
      ?>
      <div class="card">
        <h4>STOCKS</h4>
        <p><?= $stocks?></p>
      </div>
      <?php
        $stmt = $conn->prepare("SELECT COUNT(*) FROM orders");
        $stmt->execute();
        $stmt->bind_result($pending_orders);
        $stmt->fetch();
        $stmt->close();
      ?>
      <div class="card">
        <h4>PENDING ORDERS</h4>
        <p><?= $pending_orders?></p>
      </div>
      <?php
        $stmt = $conn->prepare("SELECT COUNT(*) FROM completed_orders");
        $stmt->execute();
        $stmt->bind_result($completed_orders);
        $stmt->fetch();
        $stmt->close();
      ?>
      <div class="card">
        <h4>COMPLETED ORDERS</h4>
        <p><?= $completed_orders?></p>
      </div>
      <?php
        $stmt = $conn->prepare("SELECT COUNT(*) FROM user");
        $stmt->execute();
        $stmt->bind_result($user_count);
        $stmt->fetch();
        $stmt->close();
      ?>
      <div class="card">
        <h4>USERS</h4>
        <p><?= $user_count?></p>
      </div>
    </div>
    
    <?php
      require 'config.php';
      $total_sales = 0;
      $stmt = $conn->prepare("SELECT sub_total FROM completed_orders");
      $stmt->execute();
      $result = $stmt->get_result();
      while ($row = $result->fetch_assoc()) {
          $total_sales += $row['sub_total'];
      }
    ?>
    <div class="chart">
      <h4>Sales Over Months</h4>
      <h1>$<?= $total_sales?></h1>
    </div>
  </div>
</body>
</html>
