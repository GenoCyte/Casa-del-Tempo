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
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="stock.css" />
  <title>Stock Management</title>
  <style>
    .stock-container {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      padding: 20px;
    }

    .stock-card {
      background-color: #fff;
      border-radius: 8px;
      width: 250px;
      box-shadow: 0 0 8px rgba(0,0,0,0.1);
      padding: 16px;
      text-align: center;
    }

    .stock-card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
      border-radius: 6px;
    }

    .stock-form {
      margin-top: 10px;
    }

    .stock-form input[type="number"] {
      width: 60px;
      padding: 5px;
      margin: 0 5px;
    }

    .stock-form button {
      padding: 5px 10px;
      background-color: #1abc9c;
      border: none;
      color: white;
      border-radius: 5px;
      cursor: pointer;
    }
    .stock-card h4 {
      text-align: center;
      font-size: 16px;
      margin: 0 0 10px 0;
      height: 40px;
      display: -webkit-box;
      -webkit-line-clamp: 2;       /* Limit to 2 lines */
      -webkit-box-orient: vertical;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .stock-form button:hover {
      background-color: #16a085;
    }
  </style>
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
      <h3>Stock</h3>
    </div>

    <div class="stock-container">
      <?php while ($row = $result->fetch_assoc()): ?>
        <div class="stock-card">
          <img src="data:image/jpeg;base64,<?= base64_encode($row['image']) ?>" alt="Watch Image" />
          <h4><?= htmlspecialchars($row['name']) ?></h4>
          <label>Stock:</label>
          <input type="number" value="<?= $row['stock'] ?>" min="0"
                 onchange="updateStock(<?= $row['id'] ?>, this.value)" />
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <script>
    function updateStock(productId, newStock) {
      fetch('update_stock.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `product_id=${productId}&stock=${newStock}`
      })
      .then(response => response.text())
      .then(data => {
        console.log('Stock updated:', data);
      })
      .catch(error => {
        console.error('Error updating stock:', error);
      });
    }
  </script>
</body>
</html>
