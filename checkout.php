<?php
include 'session.php';
include 'db/DBFunctions.php';
$params = getDBParams();
$pdo = getDb($params->getUsername(), $params->getPassword(), $params->getDb(), $params->getHost());
$total = 0;
$products = getAllProducts($pdo);

$counter = 0;
foreach($_POST as $key => $value) {
    $strfield = str_replace('_', ' ', $key);
    if($value != null && $value > 0) {
        $products[$counter]->setQuantity($value);
    }
    $counter++;
}


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
                                if(!is_null($product->getQuantity()) && $product->getQuantity() > 0) {
                                    $total_per_product = getTotal($product->getPrice(), $product->getQuantity());
                                    $total += $total_per_product;
                                    echo "<tr>";
                                    echo "<td>";
                                    echo $product->getName() . "</td>";
                                    echo "<td><img src=" . $product->getPicURL() . " width='50' height='50'>";
                                    echo "<td>";
                                    echo $product->getPrice() . "</td>";
                                    echo "<td>";
                                    echo $product->getQuantity() . "</td>";
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
                        <input type="text" class="form-control" name="first_name" required />
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name:</label>
                        <input type="text" class="form-control" name="last_name" required />
                    </div>
                    <div class="form-group">
                        <label for="address">Billing Address:</label>
                        <input type="text" class="form-control" name="address" required />
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input type="text" class="form-control" name="city" required />
                    </div>
                    <div class="form-group">
                        <label for="state">Select State:</label>
                        <select class="form-control" name="state" required>
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
                            <label class="radio-inline"><input type="radio" name="cardRadio" value="Visa" required>Visa</label>
                            <label class="radio-inline"><input type="radio" name="cardRadio" value="MasterCard">MasterCard</label>
                            <label class="radio-inline"><input type="radio" name="cardRadio" value="Amex">Amex</label>
                            <label class="radio-inline"><input type="radio" name="cardRadio" value="Diner's Club">Diner's Club</label>
                    </div>
                    <div class="form-group">
                        <label for="card_number">Credit Card Number:</label>
                        <input type="text" class="form-control" name="card_number" required>
                    </div>
                    <div class="form-group">
                        <label for="card_expiration">Credit Card Expiration Date:</label>
                        <input type="text" class="form-control" name="card_expiration" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Order</button>
                </form><br><br><a href="index.php"><button class="btn btn-primary">Back To Products</button></a><br><br><br>
            </div>
        </div>
    </div>
</div>
</body>
</html>
