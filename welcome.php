<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome to Initech</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/welcome.css" rel="stylesheet" type="text/css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="javascript"></script>
</head>
<body>
<div class="main_bg">
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="jumbotron text-center col-sm-8">
            <?php
            if(isset($_POST['username']) && isset($_POST['email'])) {
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['email'] = $_POST['email'];
            }
            ?>
            <h2>Welcome, <?php echo "<strong>". $_SESSION['username'] . "!</strong>" ?></h2>
            <p>Initech....where initiative meets technology</p>
            <p>We sell products that meet your technological needs, no matter what your stack</p>
        </div>
        <div class="col-sm-2"></div>
    </div>
    <br>
    <br>
    <div class="row">
        <div class="products">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <h3>Our Products</h3><span class="logout"><a href="logout.php"><button class="btn btn-primary btn-block">Logout</button></a></span><br>
                <form action="checkout.php" method="post">
                    <table class="table">
                        <tr>
                            <th>Product</th><th>Information</th><th>See More</th><th>Price</th><th>Quantity</th>
                        </tr>
                        <tr>
                            <td>Swingline Stapler, Red</td><td>An absolute classic, heavy duty, durable, and lasting</td>
                            <td><a href="productInfo.php?product_id=red_stapler" class="productPic"><img src="pics/stapler.jpg" width="50px" height="50px"></a></td>
                            <td>$19.99</td>
                            <td><input type="number" min = "0" max="50" name="stapler_red_quantity" class="quantity"></td>
                        </tr>
                        <tr>
                            <td>Swingline Stapler, Blue</td><td>An absolute classic, heavy duty, durable, and lasting</td>
                            <td><a href="productInfo.php?product_id=blue_stapler" class="productPic"><img src="pics/staplerBlue.jpg" width="50px" height="50px"></a></td>
                            <td>$19.99</td>
                            <td><input type="number" min = "0" max="50" name="stapler_blue_quantity" class="quantity"></td>
                        </tr>
                        <tr>
                            <td>Floppy disk, 3.5"</td><td>For your storage needs, up to 1.44 MB disk storage</td>
                            <td><a href="productInfo.php?product_id=small_floppy" class="productPic"><img src="pics/floppySmall.jpeg" width="50px" height="50px"></a></td>
                            <td>$5.18</td>
                            <td><input type="number" min = "0" max="50" name="small_floppy_quantity" class="quantity"></td>
                        </tr>
                        <tr>
                            <td>Floppy disk, 5.5"</td><td>Stores up to 1.2 MB, excellet storage solution</td>
                            <td><a href="productInfo.php?product_id=big_floppy" class="productPic"><img src="pics/floppyBig.jpg" width="50px" height="50px"></a></td>
                            <td>$9.11</td>
                            <td><input type="number" min = "0" max="50" name="large_floppy_quantity" class="quantity"></td>
                        </tr>
                        <tr>
                            <td>Macintosh PC</td><td>With a 1.1 Ghz processor and 512Kb Memory, desktop processing is simplistic and easy</td>
                            <td><a href="productInfo.php?product_id=macintosh_1" class="productPic"><img src="pics/macintosh1.jpeg" width="50px" height="50px"></a></td>
                            <td>$1,237.74</td>
                            <td><input type="number" min = "0" max="50" name="mac_quantity" class="quantity"></td>
                        </tr>
                        <tr>
                            <td>Imac PC</td><td>Featuring a 2 Ghz, Dual-core processor, this one takes server computing to the next level</td>
                            <td><a href="productInfo.php?product_id=macintosh_2" class="productPic"><img src="pics/macintosh2	.jpg" width="50px" height="50px"></a></td>
                            <td>$1,237.74</td>
                            <td><input type="number" min = "0" max="50" name="imac_quantity" class="quantity"></td>
                        </tr>
                        <tr>
                            <td>Commadore Amiga</td><td>The future of graphic intense applications</td>
                            <td><a href="productInfo.php?product_id=amiga" class="productPic"><img src="pics/amiga.jpg" width="50px" height="50px"></a></td>
                            <td>$1,556.01</td>
                            <td><input type="number" min = "0" max="50" name="amiga_quantity" class="quantity"></td>
                        </tr>
                        <tr>
                            <td>IBM Desktop</td>
                            <td>Utilizing hardware and software that took NASA to the moon</td>
                            <td><a href="productInfo.php?product_id=ibm" class="productPic"><img src="pics/ibm.jpg" width="50px" height="50px"></a></td>
                            <td>$2,300.11</td>
                            <td><input type="number" min = "0" max="50" name="ibm_quantity" class="quantity"></td>
                        </tr>
                        <tr>
                            <td>Sony Vaio Laptop</td>
                            <td>Sexy, sleek, simplistic. This laptop gives you power in your pocket</td>
                            <td><a href="productInfo.php?product_id=sony" class="productPic"><img src="pics/sony.png" width="50px" height="50px"></a></td>
                            <td>$898.71</td>
                            <td><input type="number" min = "0" max="50" name="sony_quantity" class="quantity"></td>
                        </tr>
                        <tr>
                            <td>Rack Server</td>
                            <td>Turn your small business into a modern-day Turing machine and never look back</td>
                            <td><a href="productInfo.php?product_id=server" class="productPic"><img src="pics/server.jpg" width="50px" height="50px"></a></td>
                            <td>$7,019.33</td><td><input type="number" min = "0" max="50" name="rack_quantity" class="quantity"></td>
                        </tr>
                        <tr>
                            <td>Mr. Coffee</td>
                            <td>Drive. Initiative. Productive developers. Bring the crack epidemic into the office</td>
                            <td><a href="productInfo.php?product_id=coffee" class="productPic"><img src="pics/coffee.png" width="50px" height="50px"></a></td>
                            <td>$1,900.21</td>
                            <td><input type="number" min = "0" max="50" name="coffee_quantity" class="quantity"></td>
                        </tr>
                        <tr>
                            <td>Office Kegerator</td>
                            <td>Because EVERYONE loves beer</td>
                            <td><a href="productInfo.php?product_id=beer" class="productPic"><img src="pics/beer.jpg" width="50px" height="50px"></a></td>
                            <td>$412.02</td>
                            <td><input type="number" min = "0" max="50" name="keg_quantity" class="quantity"></td>
                        </tr>
                    </table>
                    <button type="submit" class="btn btn-primary">Checkout</button>
                </form>
                <br><br><br>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</div>
</body>
</html>