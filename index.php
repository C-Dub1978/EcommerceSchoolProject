<?php
include 'session.php';
include 'db/DBFunctions.php';
$params = getDBParams();
$pdo = getDb($params->getUsername(), $params->getPassword(), $params->getDb(), $params->getHost());
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
                $customer = getUser($pdo, $_SESSION['username'], $_SESSION['email']);
                if($customer) {
                    $_SESSION['id'] = $customer->getId();
                    $_SESSION['isAdmin'] = $customer->getisAdmin();
                }
                else {
                    //TODO: implement creation of new user if they weren't found in the db. with no admin privilege
                }
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
                            <th>Product ID</th><th>Product</th><th>Information</th><th>See More</th><th>Price</th><th>Quantity</th>
                        </tr>
                            <?php
                            $allProducts = getAllProducts($pdo);
                            if($allProducts) {
                                foreach ($allProducts as $product) {
                                    echo "<tr>";
                                    echo "<td>" . $product->getID() . "</td>";
                                    echo "<td>" . $product->getName() . "</td>";
                                    echo "<td>" . $product->getDescription() . "</td>";
                                    echo "<td><a href='productInfo.php?productID= " . $product->getID() . "' class='productPic'>
                                            <img src='" . $product->getPicURL() . "' width='50px' height='50px'>
                                          </a>";
                                    echo "<td>$" . $product->getPrice() . "</td>";
                                    echo "<td><input type='number' min='0' max='10' name='" . $product->getName() . "' class='quantity'></td>";
                                    echo "</tr>";
                                }
                            }
                            else {
                                echo "<h2>No Products Available At This Time...</h2>";
                            }
                            ?>
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