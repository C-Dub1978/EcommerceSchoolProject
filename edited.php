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
            <h2>Welcome, <?php echo "<strong>". $_SESSION['username'] . "!</strong>" ?></h2>
            <p>Initech....where initiative meets technology</p>
            <p>We sell products that meet your technological needs, no matter what your stack</p>
            <h4>Administrator Panel</h4>
        </div>
        <div class="col-sm-2"></div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <?php
            if($_GET['action'] == 'editProduct') {
                $productID = $_GET['productID'];
                $params = array(
                    'productName' => $_POST['productName'],
                    'price' => $_POST['price'],
                    'description' => $_POST['description']
                );
                $boolUpdated = updateProduct($pdo, $params, $productID);
                if ($boolUpdated) {
                    echo "<h3>Successfully updated " . $_POST['productName'];
                }
                else {
                    echo "<h3>Error updating " . $_POST['productName'];
                }

            }
            if($_GET['action'] == 'deleteProduct') {
                $productID = $_GET['productID'];
                $boolDeleted = deleteProduct($pdo, $productID);
                if($boolDeleted) {
                    echo "<h3>Successfully deleted " . $_POST['productName'];
                }
                else {
                    echo "<h3>Error deleting " . $_POST['productName'];
                }
            }
            if($_GET['action'] == 'editCustomer') {
                $customerID = $_GET['customerID'];
                $isAdmin = 0;
                if($_POST['customerList1'] == 'Administrator') {
                    $isAdmin = 1;
                }
                $params = array(
                    'username' => $_POST['username'],
                    'email' => $_POST['email'],
                    'address' => $_POST['address'],
                    'adminType' => $isAdmin
                );
                foreach($params as $param) {
                    echo "Parampassed: " . $param . "<br>";
                }
                $boolEdited = updateUser($pdo, $params, $customerID);
                if($boolEdited) {
                    echo "<h3>Successfully updated " . $_POST['username'];
                }
                else {
                    echo "<h3>Error updating " . $_POST['username'];
                }
            }
            if($_GET['action'] == 'deleteCustomer') {
                $customerID = $_GET['customerID'];
                $boolDeleted = deleteUser($pdo, $customerID);
                if($boolDeleted) {
                    echo "<h3>Successfully deleted " . $_POST['customerName'] . "</h3><br><br>";
                }
                else {
                    echo "<h3>Error deleting " . $_POST['productName'] . "</h3><br><br>";
                }
            }
            ?>
            <a href='index.php'><button class='btn btn-primary'>Back To Products</button></a><br><br>
        </div>
        <div class="col-sm-2"></div><br>
    </div>

</div>
</body>
</html>

