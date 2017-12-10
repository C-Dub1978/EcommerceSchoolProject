<?php
include './DBFunctions.php';
$pdo = null;
$params = getDBParams();
if($params != null) {
    $pdo = getDb($params->getUsername(), $params->getPassword(), $params->getDb(), $params->getHost());
    if($pdo != null) {
        echo "pdo returned successfully<br>";
        $user = getUser($pdo, 'foolishklown', 'chris@myubercode.com');
        echo $user->__toString();
        $products = getAllProducts($pdo);
        foreach($products as $product) {
            echo "<ul>";
            echo "<li>{$product['productName']}</li>";
            echo "<li>{$product['price']}</li>";
            echo "<li>{$product['description']}</li>";
            echo "<li><img src='../" . $product['pictureURL'] . "' width='50px' height='50px'></li>";
            echo "</ul>";
        }

        $product = getProduct($pdo, 'Mr. Coffee');
        if($product != null) {
            echo "<br>";
            echo "<br>";
            echo "-----------------<br>";
            echo "the name: " . $product['productName'] . "<br>";
            echo "the price: " . $product['price'] . "<br>";
            echo "the description: " . $product['description'] . "<br>";
            echo "the picture: <img src='../" . $product['pictureURL'] . "' width='50px' height='50px'>";
        }

        echo "<br>--------------------------------------<br>";
        $newProduct = addProduct($pdo, array(
            'productName' => 'Crack Cocaine',
            'price' => 123.21,
            'description' => 'An aid that will SURELY get your developers working around the clock!',
            'pictureURL' => 'pics/crack.jpg'
        ));
        if($newProduct) {
            echo "successfully added product!<br>";
        }
        else {
            echo "error adding product<br>";
        }
    }
}
else {
    echo 'null params';
}

?>