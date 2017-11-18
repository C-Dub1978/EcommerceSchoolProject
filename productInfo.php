<?php
session_start();
$product = $_GET['product_id'];
?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <div class="main_bg">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="jumbotron text-center col-sm-8">
                <?php
                    echo $_SESSION['username'] . "is the username";
                    echo $product;
                ?>
            </div>
            <div class="col-sm-2"></div>
            <a href="welcome.php">Back To Shop</a>
        </div>
    </div>
</body>
</html>

