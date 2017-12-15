<?php
include 'session.php';
include 'db/DBFunctions.php';
$params = getDBParams();
$pdo = getDb($params->getUsername(), $params->getPassword(), $params->getDb(), $params->getHost());
$action = null;
$postParams = null;
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
    <br><br>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
<?php
if(isset($_GET['action'])) {
    $action = $_GET['action'];
    if($action == 'addproduct') {
        $uploaddir = '/var/www/html/week4/pics/';
        $uploadfile = $uploaddir . basename($_FILES['productPicture']['name']);
        if(move_uploaded_file($_FILES['productPicture']['tmp_name'], $uploadfile)) {
            echo "successful";
        }
        else {
            echo "couldnt upload";
        }

        $postParams = array(
            'productName' => $_POST['productName'],
            'price' => $_POST['price'],
            'description' => $_POST['description'],
            'pictureURL' => '/pics/' . $_FILES['productPicture']['name']
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
        $product = null;
        if(isset($_POST['productsList1'])) {
            $productID = (int)$_POST['productsList1'];
            $product = getProduct($pdo, $productID);
        }
        if($product) {
            echo "<div class='adminForm'>";
               echo "<form method='post' action='edited.php?action=editProduct&productID=" . $product->getID() . "'>";
               echo "<h4>Edit Product</h4>";
               echo "<div class='form-group'>";
               echo "<label for='productName'>Product Name:</label>";
               echo "<input type='text' name='productName' class='form-control' placeholder='" . $product->getName() . "' required />";
               echo "</div>";
               echo "<div class='form-group'>";
               echo "<label for='price'>Price:</label>";
               echo "<input type='text' name='price' class='form-control' placeholder='" . $product->getPrice() . "' required />";
               echo "</div>";
               echo "<div class='form-group'>";
               echo "<label for='description'>Description:</label>";
               echo "<textarea name='description' class='form-control' placeholder='" . $product->getDescription() . "' required></textarea>";
               echo "</div>";
               echo "<button type='submit' class='btn btn-primary'>Edit Product</button>";
            echo "</div>";
        }
        else {
            echo "Couldn't load product info";
        }
    }
    if($action == 'deleteproduct') {
        $product = null;
        if(isset($_POST['productsList2'])) {
            $productID = (int)$_POST['productsList2'];
            $product = getProduct($pdo, $productID);
        }
        if($product) {
            echo "<div class='adminForm'>";
                echo "<form method='post' action='edited.php?action=deleteProduct&productID=" . $productID . "&productName=" . $product->getName() ."'>";
                echo "<h4>Delete Product</h4>";
                echo "<h3>Are you sure you want to delete the product, " . $product->getName() . "???</h3>";
                echo "<p><strong>THIS ACTION IS IRREVERSIBLE</strong></p>";
                echo "<button type='submit' class='btn btn-primary'>Delete Product</button>";
            echo "</div>";
        }
        else {
            echo "Couldn't load product info";
        }
    }
    if($action == 'addcustomer') {
        $customer = null;
        if(isset($_POST['customerName']) && isset($_POST['email']) && isset($_POST['address']) && isset($_POST['accountType'])) {
            $account = 0;
            if($_POST['accountType'] == 'Administrator') {
                $account = 1;
            }
            $params = array(
                'username' => $_POST['customerName'],
                'email' => $_POST['email'],
                'address' => $_POST['address'],
                'accountType' => $account
            );
            $customer = createUser($pdo, $params);
            if($customer) {
                echo "<div class='adminForm'>";
                echo "<h4>Successfully added customer with username " .  $params['username'] . "</h4>";
                echo "</div>";
            }
            else {
                echo "error adding customer ";
            }
        }
        else {
            echo "<h4>Please return home and try again</h4>";
        }
    }
    if($action == 'editcustomer') {
        $customer = null;
        if(isset($_POST['customerList1'])) {
            $customerId = (int)$_POST['customerList1'];
            $customer = getUser($pdo, $customerId);
            if($customer) {
                echo "<div class='adminForm'>";
                echo "<form method='post' action='edited.php?action=editCustomer&customerID=" . $customer->getID() . "'>";
                echo "<h4>Edit Customer</h4>";
                echo "<div class='form-group'>";
                echo "<label for='username'>Username:</label>";
                echo "<input type='text' name='username' class='form-control' placeholder='" . $customer->getUsername() . "' required />";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='email'>Email:</label>";
                echo "<input type='email' name='email' class='form-control' placeholder='" . $customer->getEmail() . "' required />";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='address'>Address:</label>";
                echo "<input type='text' name='address' class='form-control' placeholder='" . $customer->getAddress() . "' required />";
                echo "</div>";
                echo "<div class='form-group'>";
                echo "<label for='customerList1'>Account Type:</label>";
                echo "<select class='form-control' name='customerList1' required>";
                echo "<option>Administrator</option>";
                echo "<option>User</option>";
                echo "</select>";
                echo "</div>";
                echo "<button type='submit' class='btn btn-primary'>Edit Customer </button>";
                echo "</div>";
            }
        }
    }
    if($action == 'deletecustomer') {
        $customer = null;
        if(isset($_POST['customerList2'])) {
            $customerID = (int)$_POST['customerList2'];
            $customer = getUser($pdo, $customerID);
        }
        if($customer) {
            echo "<div class='adminForm'>";
            echo "<form method='post' action='edited.php?action=deleteCustomer&customerID=" . $customerID . "&customerName=" . $customer->getUserName() ."'>";
            echo "<h4>Delete Customer Account</h4>";
            echo "<h3>Are you sure you want to delete the Customer Account, " . $customer->getUserName() . "???</h3>";
            echo "<p><strong>THIS ACTION IS IRREVERSIBLE</strong></p>";
            echo "<button type='submit' class='btn btn-primary'>Delete Customer</button>";
            echo "</div>";
        }
        else {
            echo "Couldn't load customer info";
        }
    }

}
echo "<br>";
echo "<a href='index.php'><button class='btn btn-primary'>Back To Products</button></a><br><br>";
?>
        </div>
        <div class="col-sm-2"></div>
    </div>
</div>
</body>
</html>