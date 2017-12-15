<?php
include 'session.php';
include 'db/DBFunctions.php';
$params = getDBParams();
$pdo = getDb($params->getUsername(), $params->getPassword(), $params->getDb(), $params->getHost());
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$card_type = $_POST['cardRadio'];
$card_number = $_POST['card_number'];
$card_expiration = $_POST['card_expiration'];
$addressUpdated = false;

echo "session id is: " . $_SESSION['id'];
$customer = getUser($pdo, $_SESSION['id']);
if($customer->getAddress() == null) {
    $addressUpdated = updateUserAddress($pdo, $_SESSION['id'], $address);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Thanks for Doing Business</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/welcome.css" rel="stylesheet" type="text/css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="javascript"></script>
</head>
<body>
    <div class="main_bg">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="jumbotron text-center col-sm-8">
                <h2>Thanks for doing business with Initech</h2>
                <p>Please check your email for order confirmation and shipping information soon</p>
                <?php
                    if($addressUpdated) {
                        echo "<p>We successfully updated your address but did not save any other personal information</p>";
                    }
                ?>
                <span class="logout"><a href="logout.php"><button class="btn btn-primary btn-block">Logout</button></a></span>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</body>
</html>
