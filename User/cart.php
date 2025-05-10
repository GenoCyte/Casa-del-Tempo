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
        $email = $row['email'];
?>
<!DOCTYPE html>
<html lang="en">
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Cart - CASA DEL TEMPO</title>
        <link rel="stylesheet" href="newcss.css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <script src="shop2.js" async></script>
        <style>
            .cartHeader{
                position: absolute;
                top: 100px;
                left: 100px;
            }
            .Cart {
                display: block;
                width: 100%;
                text-align: center;
            }

            #cart_panel {
                margin: 0 auto;
                width: 95%;
                max-width: 1100px;
                background-color: #fff;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
                text-align: left;
            }

            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            th, td {
                padding: 15px;
                border-bottom: 1px solid #ccc;
            }

            th {
                background-color: #f5f5f5;
                font-weight: bold;
            }

            img {
                border-radius: 8px;
            }

            .qty {
                width: 60px;
                text-align: center;
            }

            #cart_panel_btn {
                text-align: right;
                margin-top: 20px;
            }

            #buy_now {
                padding: 10px 20px;
                background-color: #28a745;
                color: white;
                text-decoration: none;
                border-radius: 6px;
                font-weight: bold;
            }

            #buy_now:hover {
                background-color: #218838;
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
        <div class="text-center my-4">
            <button id="showCart" class="btn btn-outline-dark mx-2">Cart</button>
            <button id="showOrders" class="btn btn-outline-dark mx-2">Orders</button>
        </div>
        <!-- Cart Section -->
        <section class="Cart" id="cart_section" style="display: block;">
            <h3 class="text-center mb-4"><strong>CART</strong></h3>
            <div id="cart_panel">
                <div id="cart_panel_menu" class="cart_menu">
                    </br>
                    </br>
                    <div class="row">
                        <table>
                            <tr>
                                <th width="200" id="cart_header">Image</th>
                                <th width="200" id="cart_header">Name</th>
                                <th width="200" id="cart_header">Price</th>
                                <th width="200" id="cart_header">Quantity</th>
                                <th width="200" id="cart_header"><a id="clearall_btn" href="cartAction.php?clear=all" onclick="return confirm('Are your sure?')">Clear All</a></th>
                            </tr>
                            <?php
                                require 'config.php';
                                $stmt = $conn->prepare("SELECT * FROM cart WHERE user_email = ?");
                                $stmt->bind_param("s", $email);
                                $stmt->execute();
                                $result = $stmt->get_result();
                                $grand_total = 0;
                                while($row = $result->fetch_assoc()):
                                    $sql = $conn->prepare("SELECT image, image_type FROM watch WHERE id = ?");
                                    $sql->bind_param("i", $row['product_id']);
                                    $sql->execute();
                                    $result2 = $sql->get_result();
                                    while($row2 = $result2->fetch_assoc()):
                                        $imageData = base64_encode($row2['image']);
                                        $imageType = $row2['image_type'];
                                        $imgSrc = "data:$imageType;base64,$imageData";
                            ?>
                            <tr>
                                <input type="hidden" value="<?= $row['id']?>" class="pid">
                                <td width="200" height="100" class="text-center"><img src="<?= $row['image']?>" width="100"></td>
                                <td width="200" class="text-center"><?= $row['product_name']?></td>
                                <td width="200" class="text-center">₱<?= number_format($row['price'],2)?></td>
                                <input type="hidden" value="<?= $row['price']?>" class="text-center pprice">
                                <td width="200" class="text-center"><input type="number" class="qty" value="<?= $row['quantity']?>"></td>
                                <td width="200" class="text-center"><a id="trash_btn" href="cartAction.php?remove=<?= $row['id']?>" onclick="return confirm('Are you sure?')">🗑</a></td>
                            </tr>
                            <?php $grand_total += $row['sub_total']?>
                            <?php endwhile;?>
                            <?php endwhile;?>
                        </table>
                    </div>
                </div>
                <?php endwhile; ?>
                <h3 id="total_price" style="text-align: right; margin-right: 40;">$<?= number_format($grand_total, 2)?></h3>
                <div id="cart_panel_btn">
                    <a id="buy_now" href="buyAction.php?order=<?=$email?>">Buy Now</a>
                </div>
            </div>
        </section>
        <section class="Orders" id="orders_section" style="display: none;">
            <div class="container">
                <h3 class="text-center mb-4"><strong>ORDERS</strong></h3>
                <div class="row">
                    <table class="table table-bordered text-center">
                        <thead class="thead-dark">
                            <tr>
                                <th>Order ID</th>
                                <th>Items</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require 'config.php';
                            $stmt = $conn->prepare("SELECT * FROM orders WHERE user_email = ?");
                            $stmt->bind_param("s", $email);
                            $stmt->execute();
                            $result = $stmt->get_result();

                            while ($row = $result->fetch_assoc()):
                            ?>
                            <tr>
                                <td><?= $row['id'] ?></td>
                                <td><?= $row['product_name'] ?></td>
                                <td><?= $row['quantity'] ?></td>
                                <td>₱<?= number_format($row['sub_total'], 2) ?></td>
                                <td><?= $row['status'] ?></td>
                                <td><?= $row['date'] ?></td>
                                <td>
                                    <?php if ($row['status'] !== 'Completed'): ?>
                                    <form action="updateStatus.php" method="POST" style="margin: 0;">
                                        <input type="hidden" name="order_id" value="<?= $row['id'] ?>">
                                        <button type="submit" class="btn btn-success btn-sm">Mark as Completed</button>
                                    </form>
                                    <?php else: ?>
                                    <span class="text-success">✓ Completed</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
        <script src="home.js"></script>
        <script>
            $(document).ready(function () {
                $(".qty").on('change', function () {
                    var $el = $(this).closest('tr');

                    var pid = $el.find(".pid").val();
                    var pprice = $el.find(".pprice").val();
                    var qty = $el. find(".qty").val();

                    $.ajax({
                        url: 'cartAction.php',
                        method: 'post',
                        cache: false,
                        data: {qty:qty,pid:pid,pprice:pprice},
                        success: function(response){
                            console.log(qty);
                        }
                    });
                });
            });

            document.getElementById("showCart").addEventListener("click", function () {
                document.getElementById("cart_section").style.display = "block";
                document.getElementById("orders_section").style.display = "none";
            });

            document.getElementById("showOrders").addEventListener("click", function () {
                document.getElementById("cart_section").style.display = "none";
                document.getElementById("orders_section").style.display = "block";
            });
        </script>
    </body>
</html>
