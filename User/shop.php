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
        <title>Shop - CASA DEL TEMPO</title>
        <link rel="stylesheet" href="newcss.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <style>
            .cartHeader{
                position: relative;
                left: 80px
            }
            .item_name {
                text-align: center;
                margin: 0 0 10px 0;
                height: 60px;
                display: -webkit-box;
                -webkit-line-clamp: 2;       /* Limit to 2 lines */
                -webkit-box-orient: vertical;
                overflow: hidden;
                text-overflow: ellipsis;
            }
            .zoom-hover {
                transition: transform 0.3s ease;
                cursor: pointer;
            }

            .zoom-hover:hover {
                transform: scale(1.05);
            }
        </style>
    </head>
    <body>
        <!-- Navigation -->
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
        <!-- Shop Section -->
        <section class="Shop" id="shop-section" style="display: block;">
            
            <div class="video2">
                <video autoplay muted loop>
                    <source src="shopvideo1.mp4" type="video/mp4" />
                </video>
            </div>
            <h3 class="mt-5 cartHeader"><strong>Watches</strong></h3>
            <div id="menu" class="mt-5">
                <div id="menu_section">
                    <div class="container">
                        <div class="row">
                            <?php
                                include 'config.php';
                                $stmt = $conn->prepare("SELECT * FROM watch");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while($row = $result->fetch_assoc()):
                                    $imageData = $row['image'];
                                    $imageType = $row['image_type'];
                                    $base64 = base64_encode($imageData);
                                    $imgSrc = "data:$imageType;base64,$base64";
                            ?>
                            <div class="col-lg-4">
                                <div class="card-deck rounded-9">
                                    <div class="card p-2 mb-4 rounded-9">
                                        <!-- Image inside a form and made clickable -->
                                        <form action="specs.php" method="POST" class="form-submit">
                                            <input type="hidden" name="pid" value="<?= $row['id'] ?>">
                                            <button type="submit" style="border: none; background: none; padding: 0;">
                                                <img src="<?= $imgSrc ?>" class="card-img-top zoom-hover" alt="Product Image">
                                            </button>
                                        </form>
                                        <div class="card-body p1">
                                            <h4 class="card-title text-center text-dark item_name"><?= $row['name']?></h4>
                                            <h5 class="card-text text-center text-dark">$<?= $row['price']?></h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="home.js"></script>
        <?php endwhile;?>
    </body>
</html>
