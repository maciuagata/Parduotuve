<?php
session_start();

$status = "";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Cart | E-Shopper</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/font-awesome.min.css" rel="stylesheet">
        <link href="css/prettyPhoto.css" rel="stylesheet">
        <link href="css/price-range.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/main.css" rel="stylesheet">
        <link href="css/responsive.css" rel="stylesheet">
        <!--[if lt IE 9]>
        <script src="js/html5shiv.js"></script>
        <script src="js/respond.min.js"></script>
        <![endif]-->       
        <link rel="shortcut icon" href="images/ico/favicon.ico">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
        <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    </head><!--/head-->

    <body>
        <header id="header"><!--header-->
            <div class="header_top"><!--header_top-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="contactinfo">
                                <ul class="nav nav-pills">
                                    <li><a href="#"><i class="fa fa-phone"></i> +370 5 2476560</a></li>
                                    <li><a href="#"><i class="fa fa-envelope"></i>vtvpmc_lt@gmail.com</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="social-icons pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href=""><i class="fa fa-facebook"></i></a></li>
                                    <li><a href=""><i class="fa fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header_top-->

            <div class="header-middle"><!--header-middle-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="logo pull-left">
                                <a href="index.php"><img src="images/home/logo.png" alt="" /></a>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="shop-menu pull-right">
                                <ul class="nav navbar-nav">
                                    <li><a href="cart.php"><i class="fa fa-shopping-cart"></i> Krepšys</a></li>
                                    <li><a href="indexs.php"><i class="fa fa-user"></i> Account</a></li>																
                                    <li><a href="login.php"><i class="fa fa-lock"></i> Login</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-middle-->

            <div class="header-bottom"><!--header-bottom-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li><a href="index.php">Pagrindinė</a></li>
                                    <li class="dropdown"><a href="#">Parduotuvė<i class="fa fa-angle-down"></i></a>
                                        <ul role="menu" class="sub-menu">
                                            <li><a href="shop.php">Products</a></li> 
                                            <li><a href="cart.php" class="active">Cart</a></li> 
                                            <li><a href="login.php">Login</a></li> 
                                        </ul>
                                    </li> 
                                    <li class="dropdown"><a href="#">Blogas<i class="fa fa-angle-down"></i></a>
                                        <ul role="menu" class="sub-menu">
                                            <li><a href="blog.php">Blog List</a></li>
                                        </ul>
                                    </li> 
                                    <li><a href="#">Apie parduotuvę</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--/header-bottom-->
        </header><!--/header-->
        <?php
        if (isset($_POST['action']) && $_POST['action'] == "remove") {
            if (!empty($_SESSION["shopping_cart"])) {
                foreach ($_SESSION["shopping_cart"] as $key => $value) {
                    if ($_POST["code"] == $key) {
                        unset($_SESSION["shopping_cart"][$key]);
                        $status = "<div class='box' style='color:red;'>
		Product is removed from your cart!</div>";
                    }
                    if (empty($_SESSION["shopping_cart"]))
                        unset($_SESSION["shopping_cart"]);
                }
            }
        }

        if (isset($_POST['action']) && $_POST['action'] == "change") {
            foreach ($_SESSION["shopping_cart"] as &$value) {
                if ($value['code'] === $_POST["code"]) {
                    $value['availability'] = $_POST["availability"];
                    break; // Stop the loop after we've found the product
                }
            }
        }
        ?>
        <div style="width:700px; margin:0 auto;">

            <h2 align="center"> Shopping Cart</h2>   

            <?php
            if (!empty($_SESSION["shopping_cart"])) {
                $cart_count = count(array_keys($_SESSION["shopping_cart"]));
                ?>
                <div class="cart_div">
                    <a href="cart.php">
                        <img src="cart/cart-icon.png" /> Cart
                        <span><?php echo $cart_count; ?></span></a>
                </div>
                <?php
            }
            ?>

            <div class="cart">
                <?php
                if (isset($_SESSION["shopping_cart"])) {
                    $total_price = 0;
                    ?>	
                <div class=" section 0 margin auto">
                        <table class="table table-condensed ">
                            <thead>
                                <tr class="cart_menu ">
                                    <td class="image">Item name</td>
                                    <td class="description"></td>
                                    <td class="quantity">Quantity</td>
                                    <td class="price">Unit price</td>                            
                                    <td class="total">Items total</td>                                           
                                </tr>
                            </thead>
                        </table>
                </div>
                    
                    <?php
                    foreach ($_SESSION["shopping_cart"] as $product) {
                        ?>


                        <tr>
                            <td><img src='<?php echo $product['image']; ?>' width="50" height="40" /></td>
                            <td><?php echo $product["name"]; ?><br />
                                <form method='post' action=''>
                                    <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                                    <input type='hidden' name='action' value="remove" />
                                    <button type='submit' class='remove'>Remove Item</button>
                                </form>
                            </td>
                            <td>
                                <form method='post' action=''>
                                    <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
                                    <input type='hidden' name='action' value="change" />
                                    <select name='availability' class='quantity' onchange="this.form.submit()">
                                        <option <?php if ($product["availability"] == 1) echo "selected"; ?> value="1">1</option>
                                        <option <?php if ($product["availability"] == 2) echo "selected"; ?> value="2">2</option>
                                        <option <?php if ($product["availability"] == 3) echo "selected"; ?> value="3">3</option>
                                        <option <?php if ($product["availability"] == 4) echo "selected"; ?> value="4">4</option>
                                        <option <?php if ($product["availability"] == 5) echo "selected"; ?> value="5">5</option>
                                    </select>
                                </form>
                            </td>
                            <td><?php echo "$" . $product["price"]; ?></td>

                        </tr>
                        <?php
                        $total_price += ($product["price"] * $product["availability"]);
                    }
                    ?>
                    <tr>
                        <td colspan="5" align="right">
                            <strong>TOTAL: <?php echo "$" . $total_price; ?></strong>
                        </td>
                    </tr>
                    </tbody>
                    </table>		
                    <?php
                }else {
                    echo "<h3>Your cart is empty!</h3>";
                    
                }
                ?>
                   
            </div>
 <a href="inde.php">Atgal prideti</a>
 
            <div style="clear:both;"></div>

            <div class="message_box" style="margin:10px 0px;">
                <?php echo $status; ?>
            </div>


        </div>



        <footer id="footer"><!--Footer-->
            <div class="footer-top">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="companyinfo">
                                <h2><span>e</span>-shopper</h2>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,sed do eiusmod tempor</p>
                            </div>
                        </div>
                        <div class="col-sm-7">
                            <div class="col-sm-3">
                                <div class="video-gallery text-center">
                                    <a href="#">
                                        <div class="iframe-img">
                                            <img src="images/home/iframe1.png" alt="" />
                                        </div>
                                        <div class="overlay-icon">
                                            <i class="fa fa-play-circle-o"></i>
                                        </div>
                                    </a>
                                    <p>Circle of Hands</p>
                                    <h2>24 DEC 2014</h2>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="video-gallery text-center">
                                    <a href="#">
                                        <div class="iframe-img">
                                            <img src="images/home/iframe2.png" alt="" />
                                        </div>
                                        <div class="overlay-icon">
                                            <i class="fa fa-play-circle-o"></i>
                                        </div>
                                    </a>
                                    <p>Circle of Hands</p>
                                    <h2>24 DEC 2014</h2>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="video-gallery text-center">
                                    <a href="#">
                                        <div class="iframe-img">
                                            <img src="images/home/iframe3.png" alt="" />
                                        </div>
                                        <div class="overlay-icon">
                                            <i class="fa fa-play-circle-o"></i>
                                        </div>
                                    </a>
                                    <p>Circle of Hands</p>
                                    <h2>24 DEC 2014</h2>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="video-gallery text-center">
                                    <a href="#">
                                        <div class="iframe-img">
                                            <img src="images/home/iframe4.png" alt="" />
                                        </div>
                                        <div class="overlay-icon">
                                            <i class="fa fa-play-circle-o"></i>
                                        </div>
                                    </a>
                                    <p>Circle of Hands</p>
                                    <h2>24 DEC 2014</h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="address">
                                <img src="images/home/map.png" alt="" />
                                <p>505 S Atlantic Ave Virginia Beach, VA(Virginia)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer-widget">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="single-widget">
                                <h2>Service</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="">Online Help</a></li>
                                    <li><a href="">Contact Us</a></li>
                                    <li><a href="">Order Status</a></li>
                                    <li><a href="">Change Location</a></li>
                                    <li><a href="">FAQ’s</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="single-widget">
                                <h2>Quock Shop</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="">T-Shirt</a></li>
                                    <li><a href="">Mens</a></li>
                                    <li><a href="">Womens</a></li>
                                    <li><a href="">Gift Cards</a></li>
                                    <li><a href="">Shoes</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="single-widget">
                                <h2>Policies</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="">Terms of Use</a></li>
                                    <li><a href="">Privecy Policy</a></li>
                                    <li><a href="">Refund Policy</a></li>
                                    <li><a href="">Billing System</a></li>
                                    <li><a href="">Ticket System</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="single-widget">
                                <h2>About Shopper</h2>
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="">Company Information</a></li>
                                    <li><a href="">Careers</a></li>
                                    <li><a href="">Store Location</a></li>
                                    <li><a href="">Affillate Program</a></li>
                                    <li><a href="">Copyright</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-sm-3 col-sm-offset-1">
                            <div class="single-widget">
                                <h2>About Shopper</h2>
                                <form action="#" class="searchform">
                                    <input type="text" placeholder="Your email address" />
                                    <button type="submit" class="btn btn-default"><i class="fa fa-arrow-circle-o-right"></i></button>
                                    <p>Get the most recent updates from <br />our site and be updated your self...</p>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </footer><!--/Footer-->



        <script src="js/jquery.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/jquery.scrollUp.min.js"></script>
        <script src="js/jquery.prettyPhoto.js"></script>
        <script src="js/main.js"></script>
    </body>
</html>






