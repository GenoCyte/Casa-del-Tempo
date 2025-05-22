<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="add_product.css" />
  <title>Add Product</title>
  <script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function(){
        const output = document.getElementById('imagePreview');
        output.src = reader.result;
        output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    </script>
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
    <a href="delete_product.php">Delete Product</a>
  </div>

  <div class="content">
    <div class="dashboard-header">
      <h3>Add Product</h3>
    </div>

    <form action="add_product_action.php" method="POST" enctype="multipart/form-data" class="add-product-form">
        <div class="form-columns">
            <div class="column">
            <label>Product Name: <input type="text" name="name" required /></label>
            <label>Brand: <input type="text" name="brand" required /></label>
            <label>Color: <input type="text" name="color" required /></label>
            <label>Price (₱): <input type="number" name="price" step="0.01" required /></label>
            <label>Stock: <input type="number" name="stock" required /></label>
            <div class="form-group">
                <label for="image">Product Image:</label>
                <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)" required>
                <img id="imagePreview" src="#" alt="Image Preview" style="display:none; margin-top:10px; max-width:100%; height:auto;" />
            </div>
            </div>

            <div class="column">
            <label>Spec 1: <input type="text" name="spec1" /></label>
            <label>Spec 2: <input type="text" name="spec2" /></label>
            <label>Spec 3: <input type="text" name="spec3" /></label>
            <label>Spec 4: <input type="text" name="spec4" /></label>
            <label>Spec 5: <input type="text" name="spec5" /></label>
            <label>Spec 6: <input type="text" name="spec6" /></label>
            <label>Description: <textarea name="description" rows="4"></textarea></label>
            </div>
        </div>

        <button type="submit">Add Product</button>
    </form>
  </div>
</body>
</html>
