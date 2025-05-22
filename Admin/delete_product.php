<?php
include 'config.php';

// Fetch watches
$sql = "SELECT id, name, stock, image FROM watch";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Delete Product</title>
  <style>
    body {
      font-family: Arial, sans-serif;
    }
    .sidebar {
      width: 220px;
      height: 100vh;
      position: fixed;
      background: #2c3e50;
      padding: 20px;
      color: white;
    }
    .sidebar img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
      object-fit: cover;
      margin-bottom: 10px;
    }
    .sidebar a {
      display: block;
      margin: 10px 0;
      color: white;
      text-decoration: none;
    }
    .content {
      margin-left: 240px;
      padding: 20px;
    }
    .dashboard-header h3 {
      margin-bottom: 20px;
    }
    .stock-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }
    .stock-card {
      background-color: #fff;
      border-radius: 8px;
      width: 250px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      padding: 16px;
      text-align: center;
      position: relative;
    }
    .stock-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 6px;
    }
    .stock-card h4 {
      font-size: 16px;
      margin: 10px 0;
      height: 40px;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .stock-card p {
      margin: 5px 0;
    }
    .stock-card form {
      margin-top: 10px;
    }
    .stock-card button {
      padding: 6px 12px;
      background-color: #e74c3c;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }
    .stock-card button:hover {
      background-color: #c0392b;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <img src="494359330_1233460488360589_7879654938418815485_n.jpg" alt="Profile" />
  <p><strong>Jed Melben</strong></p>
  <p>jEdMeLbEn@gmail.com</p>
  <hr />
  <a href="dashboard.php">Dashboard</a>
  <a href="Pending_Orders.php">Pending Orders</a>
  <a href="Confirmed_Orders.php">Complete Orders</a>
  <a href="stock.php">Stocks</a>
  <a href="add_product.php">Add Product</a>
  <a href="delete_product_tab.php">Delete Product</a>
</div>

<div class="content">
  <div class="dashboard-header">
    <h3>Delete Products</h3>
  </div>

  <div class="stock-container">
    <?php while ($row = $result->fetch_assoc()): ?>
      <div class="stock-card">
        <img src="data:image/jpeg;base64,<?= base64_encode($row['image']) ?>" alt="Watch Image" />
        <h4><?= htmlspecialchars($row['name']) ?></h4>
        <p><strong>Stock:</strong> <?= $row['stock'] ?></p>
        <form action="delete_product_handler.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
          <input type="hidden" name="id" value="<?= $row['id'] ?>">
          <button type="submit" name="delete">Delete</button>
        </form>
      </div>
    <?php endwhile; ?>
  </div>
</div>

</body>
</html>
