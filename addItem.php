<?php
include 'session.php';
include 'db/DBFunctions.php';
$params = getDBParams();
$pdo = getDb($params->getUsername(), $params->getPassword(), $params->getDb(), $params->getHost());
$action = null;
$postParams = null;

if(isset($_GET['action'])) {
    $action = $_GET['action'];

    if($action == 'addproduct') {
        $postParams = array(
            'productName' => $_POST['productName'],
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'pictureURL' => 'pics/' . $_POST['productPicture']
        );
        $newProduct = addProduct($pdo, $postParams);
        if($newProduct) {
            echo "Successfully added" . $_POST['productName'] . "!";
        }
        else {
            echo "Error adding product";
        }
    }
    if($action == 'editproduct') {

    }
}




echo $_GET['item'] . "<br>";
echo $_GET['action'] . "<br>";
echo $_POST['productName'] . "<br>";
echo $_POST['price'] . "<br>";
echo $_POST['description'] . "<br>";
