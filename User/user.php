<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'casa_del_tempo');
if($conn->connect_error){
    die('Connection Failed : ' .$conn->connect_error);
}
if(isset($_SESSION['email'])){
    $user = $_SESSION['email'];
}
$stmt = $conn->prepare("SELECT * FROM user WHERE email = '$user'");
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()):
    $user_email = $row['email'];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>User Profile - CASA DEL TEMPO</title>
    <link rel="stylesheet" href="newcss.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
      body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f9;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
      }

      .form-container {
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin: 0px auto;
        width: 400px;
        text-align: center;
      }

      h2 {
        color: #333;
        margin-bottom: 20px;
        font-size: 24px;
      }

      form {
        display: flex;
        flex-direction: column;
      }

      label {
        text-align: left;
        margin-bottom: 5px;
        font-size: 14px;
        color: #666;
      }

      input {
        padding: 10px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 16px;
        background-color: #f9f9f9;
        transition: background-color 0.3s ease;
      }

      input:focus {
        background-color: #fff;
        border-color: #0056b3;
      }

      button {
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }

      button:hover {
        background-color: #0056b3;
      }

      #updateBtn {
        display: none;
        background-color: #28a745;
      }

      #updateBtn:hover {
        background-color: #218838;
      }

      .form-container button {
        margin-top: 10px;
      }
    </style>
    <script>
      function toggleInput() {
        var user_name = document.getElementById('user_name');
        var first_name = document.getElementById('first_name');
        var last_name = document.getElementById('last_name');
        var address = document.getElementById('address');
        var contact_number = document.getElementById('contact_number');
        var updateBtn = document.getElementById('updateBtn');

        // Toggle the disabled state of the input fields
        if (user_name.disabled) {
          user_name.disabled = false;
          first_name.disabled = false;
          last_name.disabled = false;
          address.disabled = false;
          contact_number.disabled = false;
          updateBtn.style.display = 'block'; // Show the update button
        } else {
          user_name.disabled = true;
          first_name.disabled = true;
          last_name.disabled = true;
          address.disabled = true;
          contact_number.disabled = true;
          updateBtn.style.display = 'none'; // Hide the update button
        }
      }
    </script>
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
    <div class="form-container">
      <?php
        include 'config.php';
        $stmt = $conn->prepare("SELECT * FROM user WHERE email = ?");
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()):
      ?>
      <h2>User Details</h2>
      <form action="updateUser.php" method="POST">
        <label for="user_name">Username</label>
        <input type="text" id="user_name" name="user_name" value="<?= $row['username']?>" disabled/>

        <label for="first_name">First Name</label>
        <input type="text" id="first_name" name="first_name" value="<?= $row['first_name']?>" disabled/>

        <label for="last_name">Last Name</label>
        <input type="text" id="last_name" name="last_name" value="<?= $row['last_name']?>" disabled/>

        <label for="address">Address</label>
        <input type="text" id="address" name="address" value="<?= $row['address']?>" disabled/>

        <label for="contact_number">Contact</label>
        <input type="tel" id="contact_number" name="contact_number" value="<?= $row['contact']?>" disabled/>

        <button type="button" onclick="toggleInput()">Change Details</button>
        <button type="submit" id="updateBtn">Update</button> <!-- Hidden initially -->
      </form>
    </div>
    <?php endwhile; ?>
    <?php endwhile; ?>
  </body>
</html>