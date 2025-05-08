<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>CASA DEL TEMPO</title>
        <link rel="stylesheet" href="css.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <script src="shop2.js" async></script>
    </head>
    <body>
        <!-- Navigation -->
        <nav class="navigation" id="home-navi" style="display: flex;">
            <div class="nav-container">
                <div class="Logo">
                    <img src="logo.jpg" alt="Logo" />
                </div>
                <ul class="nav">
                    <li><a href="#" onclick="showHome()">Home</a></li>
                    <li><a href="#" onclick="showShop()">Shop</a></li>
                    <li><a href="#" onclick="showAboutus()">About us</a></li>
                    <li><a href="login.html" >Logout</a></li>
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
            <p class="mt-5 mb-5">Watches</p>
            <div id="menu" class="mt-5">
                <div id="menu_section">
                    <div class="container">
                        <div class="row">
                            <?php
                                include 'config.php';
                                $stmt = $conn->prepare("SELECT * FROM kala");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while($row = $result->fetch_assoc()):
                                    $imageData = $row['image']; // raw BLOB data
                                    $imageType = $row['image_type']; // e.g., "image/png"

                                    // Convert to base64
                                    $base64 = base64_encode($imageData);
                                    $imgSrc = "data:$imageType;base64,$base64";
                            ?>
                            <div class="col-lg-4">
                                <div class="card-deck rounded-9">
                                    <div class="card p-2 border-secondary mb-4 rounded-9">
                                        <img src="<?= $imgSrc ?>" class="card-img-top" width="50">
                                        <div class="card-body p1">
                                            <h4 class="card-title text-center text-dark"><?= $row['name']?></h4>
                                            <h5 class="card-text text-center text-dark">₱<?= $row['price']?></h5>
                                        </div>
                                        <div class="card-footer p-1">
                                            <button class="btn-outline-danger btn-block rounded-5 addItemBtn">Add to Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile;?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script src="home.js"></script>
    </body>
</html>
