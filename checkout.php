<?php
session_start();

$products = array(
    'red_stapler' => array(
        'quantity' => $_POST['stapler_red_quantity'],
        'price' => 19.99,
        'url' => 'pics/stapler.jpg'
    ),
    'blue_stapler' => array(
        'quantity' => $_POST['stapler_blue_quantity'],
        'price' => 19.99,
        'url' => 'pics/staplerBlue.jpg'
    ),
    'small_floppy' => array(
        'quantity' => $_POST['small_floppy_quantity'],
        'price' => 5.18,
        'url' => 'pics/floppySmall.jpeg'
    ),
    'large_floppy' => array(
        'quantity' => $_POST['large_floppy_quantity'],
        'price' => 9.11,
        'url' => 'pics/floppyBig.jpg'
    ),
    'mac' => array(
        'quantity' => $_POST['mac_quantity'],
        'price' => 1237.74,
        'url' => 'pics/macintosh1.jpeg'
    ),
    'imac' => array(
        'quantity' => $_POST['imac_quantity'],
        'price' => 1237.74,
        'url' => 'pics/macinstosh2.jpg'
    ),
    'amiga' => array(
        'quantity' => $_POST['amiga_quantity'],
        'price' => 1556.01,
        'url' => 'pics/amiga.jpg'
    ),
    'ibm' => array(
        'quantity' => $_POST['ibm_quantity'],
        'price' => 2300.11,
        'url' => 'pics/ibm.jpg'
    ),
    'sony' => array(
        'quantity' => $_POST['sony_quantity'],
        'price' => 898.71,
        'url' => 'pics/sony.png'
    ),
    'rack' => array(
        'quantity' => $_POST['rack_quantity'],
        'price' => 7019.33,
        'url' => 'pics/server.jpg'
    ),
    'coffee' => array(
        'quantity' => $_POST['coffee_quantity'],
        'price' => 1900.21,
        'url' => 'pics/coffee.png'
    ),
    'keg' => array(
        'quantity' => $_POST['keg_quantity'],
        'price' => 412.02,
        'url' => 'pics/beer.jpg'
    )
);

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
<?php
foreach($products as $product) {
    echo 'The product is: ' . $product . "<br>";
    echo 'The quantity is: ' . $product['quantity'] . "<br>";
    echo 'The price is: ' . $product['price'] . "<br>";
    echo "<img src=" . $product['url'] . " width=50px height=50px><br>";
}
?>
</body>
</html>
