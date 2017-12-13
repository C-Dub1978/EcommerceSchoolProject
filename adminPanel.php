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
    <br><br>
    <div class="row">
        <div class="products">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <br><br>
                <span class="logout">
                    <a href="logout.php" class="right" id="logoutAdminPanel"><button class="btn btn-primary">Logout</button></a>
                </span>
                <div class="adminForm">
                    <form method="post" action="addItem.php?action=addproduct">
                        <h3>Add Product</h3>
                        <div class="form-group">
                            <label for="productName">Product Name:</label>
                            <input type="text" name="productName" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" name="price" class="form-control" step="any" min="0" required />
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" class="form-control"></textarea>
                        </div>
                        <div class="form-group upload">
                            <label for="productPicture" class="fileUpload">Upload Picture</label>
                            <input type="file" name="productPicture" class="form-control" id="file-upload">
                        </div>
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </form>
                </div>
                <br><br>
                <div class="adminForm">
                    <form method="post" action="addItem.php?action=editproduct">
                        <h3>Edit Product</h3>
                        <div class="form-group">
                            <?php
                                $products = getAllProducts($pdo);
                                if($products) {
                                    echo "<label for='productsList1'>Select Product:</label>";
                                    echo "<select class='form-control' name='productsList1'>";
                                        foreach($products as $product) {
                                            echo "<option>" . $product->getName() . "</option>";
                                        }
                                    echo "</select><br>";
                                    echo "<button type='submit' class='btn btn-primary'>Edit Product</button>";
                                }
                                else {
                                    echo "<p>Product list is currently unavailable</p>";
                                }
                            ?>
                        </div>
                    </form>
                </div>
                <br><br>
                <div class="adminForm">
                    <form method="post" action="addItem.php?action=deleteproduct">
                        <h3>Delete Product</h3>
                        <div class="form-group">
                            <?php
                                if($products) {
                                    echo "<label for='productsList2'>Select Product:</label>";
                                    echo "<select class='form-control' name='productsList2'>";
                                    foreach($products as $product) {
                                        echo "<option>" . $product->getName() . "</option>";
                                    }
                                    echo "</select><br>";
                                    echo "<button type='submit' class='btn btn-primary'>Edit Product</button>";
                                }
                                else {
                                    echo "<p>Product list is currently unavailable</p>";
                                }
                            ?>
                        </div>
                    </form>
                </div>
                <br><br>
                <div class="adminForm">
                    <form method="post" action="addItem.php?action=addcustomer">
                        <h3>Add Customer</h3>
                        <div class="form-group">
                            <label for="username">Customer Name:</label>
                            <input type="text" name="customerName" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="address">Address:</label>
                            <input type="text" name="address" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="accountType">Account Type:</label>
                            <select class="form-control" name="accountType">
                                <option>Administrator</option>
                                <option>User</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Add New Customer</button>
                    </form>
                </div>
                <br><br>
                <div class="adminForm">
                    <form method="post" action="addItem.php?action=editcustomer">
                        <h3>Edit Customer</h3>
                        <div class="form-group">
                            <?php
                                $customers = getAllUsers($pdo);

                                if($customers) {
                                    echo "<label for='customerList1'>Select Customer:</label>";
                                    echo "<select class='form-control' name='customerList1'>";
                                    foreach($customers as $customer) {
                                        echo "<option>" . $customer->getUserName() . "</option>";
                                    }
                                    echo "</select><br>";
                                    echo "<button type='submit' class='btn btn-primary'>Edit Customer</button>";
                                }
                                else {
                                    echo "<p>Customer list is currently unavailable</p>";
                                }
                            ?>
                        </div>
                    </form>
                </div>
                <br><br>
                <div class="adminForm">
                    <form method="post" action="addItem.php?action=deletecustomer">
                        <h3>Delete Customer</h3>
                        <div class="form-group">
                            <?php
                            if($customers) {
                                echo "<label for='customerList2'>Select Customer:</label>";
                                echo "<select class='form-control' name='customerList2'>";
                                foreach($customers as $customer) {
                                    echo "<option>" . $customer->getUserName() . "</option>";
                                }
                                echo "</select><br>";
                                echo "<button type='submit' class='btn btn-primary'>Delete Customer</button>";
                            }
                            else {
                                echo "<p>Customer list is currently unavailable</p>";
                            }
                            ?>
                        </div>
                    </form>
                </div>
                <br><br>
                <a href="index.php"><button class="btn btn-primary">Back To Products</button></a><br><br>
                <br><br>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</div>
