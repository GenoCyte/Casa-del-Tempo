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
    <title>Home - CASA DEL TEMPO</title>
    <link rel="stylesheet" href="newcss.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
    <section class="Home" id="home-section">
        <h1>WELCOME TO CASA DEL TEMPO</h1>
        <div class="video">
            <video autoplay muted loop>
            <source src="home1video.mp4" type="video/mp4" />
            </video>
        </div>
        <h2>CURRENT HIGHLIGHTS</h2>
        <div class="highlights">
            <img src="pic1.jpg" alt="HIGHLIGHTS1" />
            <img src="pic2.jpg" alt="HIGHLIGHTS2" />
            <img src="pic3.jpg" alt="HIGHLIGHTS3" />
        </div>

      <h1> <br /></h1>

      <section class="Casa">
            <div class="Casaimg">
                <img src="about us.png" alt="Casa Del Tempo" />
            </div>
            <div class="text">
                <div class="text-wrapper">
                    <h2>Casa Del Tempo</h2>
                    <h3>Luxary Watch Brand<br />

                    </h3>
                    <p>
                        At Casa Del Tempo, we believe that time is more than a measurement—it's a legacy. Born from a passion for precision and a reverence for timeless design, our timepieces are crafted to embody the art of horology in its most refined form. Each watch is a statement of elegance, blending traditional craftsmanship with modern innovation to create heirlooms worthy of the name.
                        From the heart of design to the hands that assemble each movement, Casa Del Tempo is dedicated to excellence, exclusivity, and enduring style. Our collections speak to discerning individuals who value sophistication, detail, and the rare luxury of time well spent. 
                        Discover your moment. Own your legacy.
                    </p>
                </div>
            </div>
        </section>
        
        <h1> <br /></h1>

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
    <script src="script.js"></script>
    <?php endwhile; ?>
  </body>
</html>
