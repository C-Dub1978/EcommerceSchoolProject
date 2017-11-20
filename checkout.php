<?php
session_start();
$time_now = $_SERVER['REQUEST_TIME'];
if(!isset($_SESSION['timeout'])) {
    $_SESSION['timeout'] = $time_now;
}
$duration = 1800;

if(isset($_SESSION['timeout']) && $time_now - $_SESSION['timeout'] > $duration) {
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['timeout']);
    session_unset();
    session_destroy();
}
$total = 0;
$products = array(
    array(
        'name' => 'Swingline Stapler, Red',
        'quantity' => $_POST['stapler_red_quantity'],
        'price' => 19.99,
        'url' => 'pics/stapler.jpg'
    ),
    array(
        'name' => 'Swingline Stapler, Blue',
        'quantity' => $_POST['stapler_blue_quantity'],
        'price' => 19.99,
        'url' => 'pics/staplerBlue.jpg'
    ),
    array(
        'name' => 'Floppy Disk, 3.5"',
        'quantity' => $_POST['small_floppy_quantity'],
        'price' => 5.18,
        'url' => 'pics/floppySmall.jpeg'
    ),
    array(
        'name' => 'Floppy Disk, 5.5"',
        'quantity' => $_POST['large_floppy_quantity'],
        'price' => 9.11,
        'url' => 'pics/floppyBig.jpg'
    ),
    array(
        'name' => 'Macintosh PC',
        'quantity' => $_POST['mac_quantity'],
        'price' => 1237.74,
        'url' => 'pics/macintosh1.jpeg'
    ),
    array(
        'name' => 'Imac PC',
        'quantity' => $_POST['imac_quantity'],
        'price' => 1237.74,
        'url' => 'pics/macintosh2.jpg'
    ),
    array(
        'name' => 'Commadore Amiga',
        'quantity' => $_POST['amiga_quantity'],
        'price' => 1556.01,
        'url' => 'pics/amiga.jpg'
    ),
    array(
        'name' => 'IBM Desktop',
        'quantity' => $_POST['ibm_quantity'],
        'price' => 2300.11,
        'url' => 'pics/ibm.jpg'
    ),
    array(
        'name' => 'Sony Vaio Laptop',
        'quantity' => $_POST['sony_quantity'],
        'price' => 898.71,
        'url' => 'pics/sony.png'
    ),
    array(
        'name' => 'Rack Server',
        'quantity' => $_POST['rack_quantity'],
        'price' => 7019.33,
        'url' => 'pics/server.jpg'
    ),
    array(
        'name' => 'Mr. Coffee',
        'quantity' => $_POST['coffee_quantity'],
        'price' => 1900.21,
        'url' => 'pics/coffee.png'
    ),
    array(
        'name' => 'Office Kegerator',
        'quantity' => $_POST['keg_quantity'],
        'price' => 412.02,
        'url' => 'pics/beer.jpg'
    )
);

function getTotal($price, $quantity) {
    return $price * $quantity;
}

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
        <div class=" jumbotron text-center col-sm-8">
            <h2>Welcome, <?php echo "<strong>". $_SESSION['username'] . "!</strong>" ?></h2>
            <p>Please check that your order is correct, and fill in your information below</p>
            <p>We use a slightly secure processing platform to hope that your personal information stays that way</p>
        </div>
        <div class="col-sm-2"></div>
    </div><br><br><br>
    <div class="row">
        <div class="products">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <h3>Your Order</h3><span class="logout"><a href="logout.php"><button class="btn btn-primary btn-block">Logout</button></a></span><br>
                <form action="process.php" method="post">
                    <table class="table">
                        <tr><th>Product</th><th>&nbsp</th><th>Price</th><th>Quantity</th><th>Total Price</th></tr>
                        <?php
                            setlocale(LC_MONETARY, 'en_US');
                            foreach($products as $product) {
                                if(!is_null($product['quantity']) && $product['quantity'] > 0) {
                                    $total_per_product = getTotal($product['price'], $product['quantity']);
                                    $total += $total_per_product;
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $product['name'] . "</td>";
                                    echo "<td><img src=" . $product['url'] . " width='50' height='50'>";
                                    echo "<td>";
                                    echo $product['price'] . "</td>";
                                    echo "<td>";
                                    echo $product['quantity'] . "</td>";
                                    echo "<td>";
                                    echo money_format('%i', $total_per_product);
                                    echo "</tr>";
                                }
                            }
                        ?>
                    </table>
                    <br><br><br>
                    <h3>Your Grand Total Today: <?php
                        setlocale(LC_MONETARY, 'en_US');
                        echo money_format('%i', $total);
                        echo '<br>'?>
                    </h3>
                    <p>Your email address:
                        <?php
                        if(isset($_SESSION['email'])){
                            echo $_SESSION['email'];
                        }?></p>
                    <div class="form-group">
                        <label for="first_name">First Name:</label>
                        <input type="text" class="form-control" name="first_name">
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" name="last_name">
                    </div>
                    <div class="form-group">
                        <label for="address">Billing Address:</label>
                        <input type="text" class="form-control" name="address">
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" name="city">
                    </div>
                    <div class="form-group">
                        <label for="state">Select State:</label>
                        <select class="form-control" name="state">
                            <option>AL</option>
                            <option>AK</option>
                            <option>AZ</option>
                            <option>AR</option>
                            <option>CA</option>
                            <option>CO</option>
                            <option>CT</option>
                            <option>DE</option>
                            <option>FL</option>
                            <option>GA</option>
                            <option>HI</option>
                            <option>ID</option>
                            <option>IL</option>
                            <option>IN</option>
                            <option>IA</option>
                            <option>KS</option>
                            <option>KY</option>
                            <option>LA</option>
                            <option>ME</option>
                            <option>MD</option>
                            <option>MA</option>
                            <option>MI</option>
                            <option>MN</option>
                            <option>MS</option>
                            <option>MO</option>
                            <option>MT</option>
                            <option>NE</option>
                            <option>NV</option>
                            <option>NH</option>
                            <option>NJ</option>
                            <option>NM</option>
                            <option>NY</option>
                            <option>NC</option>
                            <option>ND</option>
                            <option>OH</option>
                            <option>OK</option>
                            <option>OR</option>
                            <option>PA</option>
                            <option>RI</option>
                            <option>SC</option>
                            <option>SD</option>
                            <option>TN</option>
                            <option>TX</option>
                            <option>UT</option>
                            <option>VT</option>
                            <option>VA</option>
                            <option>WA</option>
                            <option>WV</option>
                            <option>WI</option>
                            <option>WY</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="card_type">Credit Card Type:</label>
                            <label class="radio-inline"><input type="radio" name="cardRadio" value="Visa">Visa</label>
                            <label class="radio-inline"><input type="radio" name="cardRadio" value="MasterCard">MasterCard</label>
                            <label class="radio-inline"><input type="radio" name="cardRadio" value="Amex">Amex</label>
                            <label class="radio-inline"><input type="radio" name="cardRadio" value="Diner's Club">Diner's Club</label>
                    </div>
                    <div class="form-group">
                        <label for="card_number">Credit Card Number:</label>
                        <input type="text" class="form-control" name="card_number">
                    </div>
                    <div class="form-group">
                        <label for="card_expiration">Credit Card Expiration Date:</label>
                        <input type="text" class="form-control" name="card_expiration">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Order</button>
                </form><br><br><a href="index.php"><button class="btn btn-primary">Back To Products</button></a><br><br><br>
            </div>
        </div>
    </div>
</div>
</body>
</html>
