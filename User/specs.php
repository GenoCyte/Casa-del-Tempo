<?php
    session_start();
    $conn = new mysqli('localhost', 'root', '', 'casa_del_tempo');
    if($conn->connect_error){
        die('Connection Failed : ' .$conn->connect_error);
    }
    if(isset($_SESSION['email'])){
        $user = $_SESSION['email'];
    }
    $stmt = $conn->prepare("SELECT * FROM user where email = '$user'");
    $stmt->execute();
    $result = $stmt->get_result();
    while($row = $result->fetch_assoc()):
        $uname = $row['username'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>Watch - CASA DEL TEMPO</title>
      <link rel="stylesheet" href="newcss.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
      <style>
        .product-container {
          display: flex;
          gap: 40px; /* Adds space between image and details */
          margin-bottom: 60px; /* Adds space below the entire section */
          align-items: flex-start;
        }

        .product-image {
          max-width: 300px;
        }

        .product-details {
          flex: 1;
        }

        .addItemBtn {
          color: black;
        }

        .backButton{
          position: relative;
          left: 20px;
        }
      </style>
  </head>
  <body>
    <nav class="navigation">
        <div class="nav-container">
            <div class="Logo">
                <p class=" m-3" style="font-size: 25px; font-weight: bold;position: relative; left: 10px;">Casa Del Tempo</p>
            </div>
            <ul class="nav">
                <li><a href="home.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="about.php">About us</a></li>
                <li><a href="login.html">Logout</a></li>
                <li><a href="cart.php"><i class="fas fa-shopping-bag"></i></a></li>
                <li><a href="user.php"><i class="fas fa-user"></i></a></li>
            </ul>
        </div>
    </nav>
    <a href="shop.php" class="btn px-4 py-2 mb-5 mt-2 backButton" style="font-weight: 500; font-size: 20px; transition: all 0.3s;">
      ← Back
    </a>
    <?php
      include 'config.php';
      $product_id = $_POST['pid'] ?? $_GET['pid'];
      $stmt = $conn->prepare("SELECT * FROM watch WHERE id = $product_id");
      $stmt->execute();
      $result = $stmt->get_result();
      while($row = $result->fetch_assoc()):
        $imageData = $row['image']; // raw BLOB data
        $imageType = $row['image_type']; // e.g., "image/png"

        // Convert to base64
        $base64 = base64_encode($imageData);
        $imgSrc = "data:$imageType;base64,$base64";
    ?>
    <div class="product-container" id="specs">
      <div class="product-image">
        <img src="<?= $imgSrc ?> " class="card-img-top" width="50" alt="Luxury Watch" />
        <form action="addToCart.php" method="POST" class="form-submit mt-3">
          <input type="hidden" name="pid" value="<?= $row['id'] ?>">
          <input type="hidden" name="pname" value="<?= $row['name'] ?>">
          <input type="hidden" name="pprice" value="<?= $row['price'] ?>">
          <input type="hidden" name="pimage" value="<?= $imgSrc ?>">
          <button class="btn btn-outline-primary btn-block rounded-pill addItemBtn d-flex justify-content-center align-items-center" style="height: 45px;">
            <i class="fas fa-cart-plus mr-2"></i> Add to Cart
          </button>
        </form>
      </div>

      <div class="product-details">
        <h2 class="mb-3"><strong><?= $row['name'] ?></strong></h2>
        <h3 class="mt-1">BRAND</h3>
        <p><strong>Brand:</strong> <?= $row['brand'] ?></p>
        <p><strong>Color:</strong> <?= $row['color'] ?></p>
        <p><strong>Price:</strong> $<?= $row['price'] ?></p>
        <p><strong>Description:</strong> <?= $row['description'] ?></p>

        <h3 class="mt-5">KEY FEATURES</h3>
        <p><strong>-</strong> <?= $row['spec1'] ?></p>
        <p><strong>-</strong> <?= $row['spec2'] ?></p>
        <p><strong>-</strong> <?= $row['spec3'] ?></p>
        <p><strong>-</strong> <?= $row['spec4'] ?></p>
        <p><strong>-</strong> <?= $row['spec5'] ?></p>
        <p><strong>-</strong> <?= $row['spec6'] ?></p>
      </div>
      <?php endwhile; ?>
    </div>
    <?php endwhile;?>
    <footer class="Home-footer">
      <div class="footer-content">
          <!-- Left Column: Logo and Description -->
          <div class="footer-column footer-description">
          <img src="logo.jpg" alt="Casa Del Tempo" class="footer-logo" />
          <p>
          Established in 2025, Casa Del Tempo has earned its reputation as the premier destination for luxury timepieces in the Philippines. Representing a carefully curated portfolio of prestigious watches, including Casa Del tempo V1, Tempo Vivo, Tempus Lux, and Vero Tempo, Casa Del Tempo combines exclusivity with diversity. Driven by an unwavering commitment to quality and a passion for timeless elegance, we proudly uphold a legacy of excellence, redefining the art of luxury watch.
          </p>
          <p class="footer-email">📧 Email us at <span class="plain-email">CasaDelTempo@gmail.com</span></p>
          </div>
      
          <!-- Company Links -->
          <div class="footer-column">
          <h4>COMPANY</h4>
          <ul>
              <li><a href="about.html">About Us</a></li>
              <li><a href="shop.html">Our Brands</a></li>
              <li>Contact Us</li>
          </ul>
          </div>
      
          <div class="footer-column">
          <h4>HELP</h4>
          <ul>
              <li>Service Centers</li>
              <li>Privacy Policy</li>
              <li>Cookie Settings</li>
              <li>Terms and Conditions</li>
          </ul>
          </div>
      
          <div class="footer-column">
          <h4>SOCIAL MEDIA</h4>
          <ul>
              <li>Instagram</li>
              <li>Facebook</li>
              <li>Youtube</li>
          </ul>
          </div>
      </div>
      
      <div class="footer-bottom">
          <p>© Copyright 2025 Casa Del Tempo</p>
      </div>
  </footer>
  </body>
</html>
