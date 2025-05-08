<html?>
    <head>
        <title>CASA DEL TEMPO</title>
        <link rel="stylesheet" href="css.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
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

        <!-- Home Section -->
        <section class="Home" id="home-section" style="display: none;">
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
            <footer class="Home-footer">
                <p>Guaranteed Authentic.</p>
                <p>As official retailers of our brands, we pride ourselves on trust. The items we sell are genuine pieces of quality craftsmanship.</p>
            </footer>
        </section>

        <!-- Shop Section -->
        <section class="Shop" id="shop-section" style="display: none;">
            
            <div class="video2">
                <video autoplay muted loop>
                    <source src="shopvideo1.mp4" type="video/mp4" />
                </video>
            </div>
            <div id="menu">
                <div id="menu_section">
                    <div class="container">
                        <div class="row">
                            <?php
                                include 'config.php';
                                $stmt = $conn->prepare("SELECT * FROM watch");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while($row = $result->fetch_assoc()):
                            ?>
                            <div class="col-lg-4">
                                <div class="card-deck rounded-9">
                                    <div class="card p-2 border-secondary mb-2 rounded-9">
                                        <img src="<?= $row['image']?>" class="card-img-top" width="50">
                                        <div class="card-body p1">
                                            <h4 class="card-title text-center text-dark"><?= $row['name']?></h4>
                                            <h5 class="card-text text-center text-dark">₱<?= $row['price']?></h5>
                                        </div>
                                        <div class="card-footer p-1">
                                            <!--<form action="action_chicken.php" method="post" class="form-submit">
                                                <input type="hidden" name="pid" value="<?= $row['id']?>">
                                                <input type="hidden" name="pname" value="<?= $row['product_name']?>">
                                                <input type="hidden" name="pprice" value="<?= $row['product_price']?>">
                                                <input type="hidden" name="pimage" value="<?= $row['product_image']?>">
                                                <input type="hidden" name="pcode" value="<?= $row['product_code']?>">
                                                <button class="btn-outline-danger btn-block rounded-5 addItemBtn">Add to Cart</button>
                                            </form>-->
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

        <section class="Aboutus" id="aboutus-section" style="display: none;">
        <h1>About Us</h1>
        <div class="Store ">
            <img src="about us.png" alt="Casa Del tempo Shop"/>
        </div>
        <h2>The Casa Del Tempo Store</h2>
        <p> We are a company that is engaged in the retail trade of quality timepieces with affordable prices. We offer a variety of collections designed for clients who are looking for a timepiece that fits their personality. Timekeeping functionality is important but we also consider a few selected features and appearances in order to suit the needs and preferences of our customers.
        The Casa Del Tempo makes sure to offer a perfect combination of competitive pricing and excellent customer service in showcasing our brands such as Tissot, Alpina, Tommy Hilfiger, Calvin Klein, Leonard Montres, Bering, and Coach.</p>
        <ol>
            <li>We are a timepiece distributor, sales and service company.</li>
            <li>We commit to give total customer satisfaction by providing the widest choice of timepieces and accessories with competitive prices, uncompromised quality, and efficient service before, during and after sales, in the most convenient locations.</li>
            <li>We offer our employees quality of life. We give fair and competitive wages and benefits through equal opportunities and training, development and advancement.</li>
            <li>We treat our dealers and suppliers as our main business partners.</li>
            <li>We believe in protecting and sustaining each otherâ€™s interests for mutual benefit.</li>
        </ol>
        </section>
        <script src="home.js"></script>
    </body>
</html>
