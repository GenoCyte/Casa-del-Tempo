<!DOCTYPE html>
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
<html lang="en">
  <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <title>About Us - CASA DEL TEMPO</title>
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
        

    <section class="Aboutus" id="aboutus-section">
      <div class="Store">
        <img src="about us.png" alt="Casa Del tempo Shop"/>
      </div>
      <h2>The Casa Del Tempo Store</h2>
      <p>We are a company that is engaged in the retail trade of quality timepieces with affordable prices. We offer a variety of collections designed for clients who are looking for a timepiece that fits their personality. Timekeeping functionality is important but we also consider a few selected features and appearances in order to suit the needs and preferences of our customers. The Casa Del Tempo makes sure to offer a perfect combination of competitive pricing and excellent customer service in showcasing our brands such as Tissot, Alpina, Tommy Hilfiger, Calvin Klein, Leonard Montres, Bering, and Coach.</p>
      <ol>
        <li>We are a timepiece distributor, sales and service company.</li>
        <li>We commit to give total customer satisfaction by providing the widest choice of timepieces and accessories with competitive prices, uncompromised quality, and efficient service before, during and after sales, in the most convenient locations.</li>
        <li>We offer our employees quality of life. We give fair and competitive wages and benefits through equal opportunities and training, development and advancement.</li>
        <li>We treat our dealers and suppliers as our main business partners.</li>
        <li>We believe in protecting and sustaining each other’s interests for mutual benefit.</li>
      </ol>
    </section>
        <?php endwhile;?>
  </body>
</html>
