<?php
include 'session.php';
include 'db/DBFunctions.php';
$params = getDBParams();
$pdo = getDb($params->getUsername(), $params->getPassword(), $params->getDb(), $params->getHost());
$product = $_GET['productID'];
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $product; ?></title>
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
                    echo "<h2>Welcome, " . $_SESSION['username'] . "!</h2><br>";
                    echo "Your product: " . $product . "<br>";
                ?>
            </div>
            <div class="col-sm-2"></div>
        </div><br><br><br>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <?php
                    $productObj = getProduct($pdo, $product);
                    if($productObj) {
                        echo "<img src='" . $productObj->getPicURL() . "' width='300' height='300'>";
                        echo "<p>ID: " . $productObj->getID() . "</p>";
                        echo "<p>Product Name: " . $productObj->getName() . "</p>";
                        echo "<p>" . $productObj->getDescription() . "</p>";
                        echo "<p>Price: $" . $productObj->getPrice() . "</p>";
                    }
                    else {
                        echo "<h2>No Product Information available for " . $product . ", sorry</h2>";
                    }
                ?>
                <a href="logout.php" class="right"><button class="btn btn-primary">Logout</button></a>
                <a href="index.php"><button class="btn btn-primary">Back To Products</button></a>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</body>
</html>

