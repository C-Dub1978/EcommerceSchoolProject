<?php
include '../classes/DBParams.php';
include '../classes/Product.php';
include '../classes/Customer.php';

function getDBParams() {
    $trimmed = file('../params/dbparams.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $key = array();
    $vals = array();
    foreach($trimmed as $line) {
        $pairs = explode("=", $line);
        $key[] = $pairs[0];
        $vals[] = $pairs[1];
    }
    $myPairs = array_combine($key, $vals);
    $dbclass = new DBParams($myPairs['username'], $myPairs['password'], $myPairs['host'], $myPairs['db']);
    return $dbclass;
}

function getDb($user, $pass, $dbname, $host) {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $db = null;
    try {
        $db = new PDO($dsn, $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "pdo set!<br>";
    }
    catch(PDOException $e) {
        $e->getMessage();
    }
    return $db;
}

function getUser($db, $user, $email) {
    echo "called get user<br>";
    $sql = $db->prepare("SELECT * FROM Customers WHERE username=:user");
    $sql->bindParam(':user', $user, PDO::PARAM_STR);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    $customer = new Customer();
    $customer->setUsername($result['username']);
    $customer->setEmail($result['email']);
    $customer->setAddress($result['address']);
    $customer->setIsAdmin($result['isAdmin']);
    return $customer;
}

function getAllProducts($db) {
    echo "called get all products<br>";
    $sql = "SELECT * FROM Products";
    return $db->query($sql);
}

function getProduct($db, $name) {
    echo "called get one product<br>";
    $product = null;
    $sql = $db->prepare("SELECT * FROM Products WHERE productName=:name");
    $sql->bindParam(':name', $name);
    $sql->execute();
    if($sql->rowCount() > 0) {
        $product = $sql->fetch(PDO::FETCH_ASSOC);
    }
    return $product;
}

function addProduct($db, $productArray) {
    echo "entering add single product<br>";
    $added = false;
    $sql = $db->prepare("INSERT INTO Products(productName, price, description, pictureURL) VALUES(
                          :productName, :price, :description, :pictureURL
                       )");
    echo "prepared statement<br>";
    $sql->execute(array(':productName' => $productArray['productName'],
                         ':price' => $productArray['price'],
                         ':description' => $productArray['description'],
                         ':pictureURL' => $productArray['pictureURL']));
    if($sql->rowCount() > 0) {
        $added = true;
    }
    return $added;
}

function updateProduct($db, $productArray, $productID) {
    echo "entering update single product<br>";
    $updated = false;
    $sql = $db->prepare("UPDATE Products SET productName=:name, price=:price, description=:description, pictureURL=:pic WHERE productID=:id");
    $sql->execute(array(':name' => $productArray['productName'],
        ':price' => $productArray['price'],
        ':description' => $productArray['description'],
        ':pic' => $productArray['pictureURL'],
        ':id' => $productID));
    if ($sql->rowCount() > 0) {
        $updated = true;
    }
    return $updated;
}

function deleteProduct($db, $productID) {
    echo "entering delete product<br>";
    $deleted = false;
    $sql = $db->prepare("DELETE FROM Products WHERE productID=:id");
    $sql->bindParam(':id', $productID);
    $sql->execute();
    if($sql->rowCount() > 0) {
        $deleted = true;
    }
    return $deleted;
}
?>