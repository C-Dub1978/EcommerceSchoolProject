<?php

class DBParams {
    private $username;
    private $password;
    private $host;
    private $db;

    public function __construct($myusername, $mypassword, $myhost, $mydb) {
        $this->username = $myusername;
        $this->password = $mypassword;
        $this->host = $myhost;
        $this->db = $mydb;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @param string $host
     */
    public function setHost($host)
    {
        $this->host = $host;
    }

    /**
     * @return string
     */
    public function getDb()
    {
        return $this->db;
    }

    /**
     * @param string $db
     */
    public function setDb($db)
    {
        $this->db = $db;
    }
}


class Product {
    private $id;
    private $name;
    private $price;
    private $description;
    private $picURL;
    private $quantity;

    //Constructor
    public function __construct() {
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getPicURL()
    {
        return $this->picURL;
    }

    /**
     * @param string $picURL
     */
    public function setPicURL($picURL)
    {
        $this->picURL = $picURL;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($num) {
        $this->quantity = $num;
    }

    public function __toString()
    {
        return "ID: " . $this->getId() . "<br>".
            "Name: " . $this->getName() . "<br>".
            "Price: " . $this->getPrice() . "<br>".
            "Description: " . $this->getDescription() . "<br>".
            "URL: " . $this->getPicURL() . "<br>";
    }
}


class Customer {
    private $id;
    private $username;
    private $address;
    private $email;
    private $isAdmin;

    public function __construct() {
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getisAdmin()
    {
        return $this->isAdmin;
    }

    /**
     * @param mixed $isAdmin
     */
    public function setIsAdmin($isAdmin)
    {
        $this->isAdmin = $isAdmin;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



    public function __toString()
    {
        // TODO: Implement __toString() method.
        return 'username: ' . $this->getUsername() . '<br>email: ' . $this->getEmail() . '<br>address: ' . $this->getAddress() . '<br>';
    }


}



/**
 * @return DBParams
 * function to strip the lines out of the config file and combine the keys/values into an array,
 * which then builds a DBParams class and returns it
 */
function getDBParams() {
    $trimmed = file('db/dbparams.txt', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
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

/**
 * @param $user
 * @param $pass
 * @param $dbname
 * @param $host
 * @return null|PDO
 * Function to use the DBParams class as argument input, then build and return a new PDO
 * object for use in the different files on the e-commerce app
 */
function getDb($user, $pass, $dbname, $host) {
    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";
    $db = null;
    try {
        $db = new PDO($dsn, $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) {
        echo "oh, fuck!" . $e->getMessage();
    }
    return $db;
}

/**
 * @param $db
 * Function to nullify the PDO object and close it's connection to mysql
 */
function killDB($db) {
    $db = null;
}


/**
 * @param $db
 * @return null
 * Function to get all users from db
 */
function getAllUsers($db) {
    $users = null;
    try {
        $sql = $db->prepare("SELECT * FROM Customers");
        $sql->execute();
        $result = $sql->fetchAll(PDO::FETCH_ASSOC);
        if ($result) {
            $users = array();
            foreach ($result as $user) {
                $myUser = new Customer();
                $myUser->setUsername($user['username']);
                $myUser->setEmail($user['email']);
                $myUser->setAddress($user['address']);
                $myUser->setIsAdmin($user['isAdmin']);
                $myUser->setId($user['customerID']);
                $users[] = $myUser;
            }
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    //killDB($db);
    return $users;
}


/**
 * @param $db
 * @param $user
 * @param $email
 * @return Customer
 * Function to build a prepared statement with PDO, and build/return a Customer class object, if that
 * customer exists in mysql
 */
function getUser($db, $custid) {
    $customer = null;
    try {
        $sql = $db->prepare("SELECT * FROM Customers WHERE customerID=:id");
        $sql->bindParam(':id', $custid);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result != null) {
            $customer = new Customer();
            $customer->setId($result['customerID']);
            $customer->setUsername($result['username']);
            $customer->setEmail($result['email']);
            $customer->setAddress($result['address']);
            $customer->setIsAdmin($result['isAdmin']);
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    //killDB($db);
    return $customer;
}

function getUserOverload($db, $username, $email) {
    $customer = null;
    try {
        $sql = $db->prepare("SELECT * FROM Customers WHERE username=:name AND email=:mail LIMIT 1");
        $sql->bindParam(':name', $username);
        $sql->bindParam(':mail', $email);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            $customer = new Customer();
            $customer->setId($result['customerID']);
            $customer->setUsername($result['username']);
            $customer->setEmail($result['email']);
            $customer->setAddress($result['address']);
            $customer->setIsAdmin($result['isAdmin']);
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    return $customer;
}



/**
 * @param $db
 * @param $userArray
 * @return Customer
 * Create a new user, either by the admin panel or
 */
function createUser($db, $userArray) {
    $newCustomer = null;
    try {
        $sql = $db->prepare("INSERT INTO Customers(username, email, address, isAdmin) VALUES (
                              :user, :emailaddy, :addy, :admin
                            )");
        $sql->execute(array(':user' => $userArray['username'],
                            ':emailaddy' => $userArray['email'],
                            ':addy' => $userArray['address'],
                            ':admin' => $userArray['accountType']
            ));
        if($sql->rowCount() > 0) {
            $newCustomer = new Customer();
            $id = $db->lastInsertId();
            echo "the last id is: " . $id;
            $newCustomer->setUsername($userArray['username']);
            $newCustomer->setEmail($userArray['email']);
            $newCustomer->setAddress($userArray['address']);
            $newCustomer->setIsAdmin($userArray['accountType']);
            $newCustomer->setId($id);
        }
    }
    catch(PDOException $e) {
        echo "this didn't work: " . $e->getMessage();
    }
    //killDB($db);
    return $newCustomer;
}

function updateUser($db, $userArray, $userID) {
    $updated = false;
    try {
        $sql = $db->prepare("UPDATE Customers SET username=:name, email=:mail, address=:addy, isAdmin=:admin WHERE customerID=:id");
        $sql->execute(array(
            ':name' => $userArray['username'],
            ':mail' => $userArray['email'],
            ':addy' => $userArray['address'],
            ':admin' => $userArray['adminType'],
            ':id' => $userID
        ));
        if ($sql->rowCount() > 0) {
            $updated = true;
        }
    }
    catch(PDOException $e) {
        echo "error: " . $e->getMessage();
    }
    return $updated;
}

function deleteUser($db, $customerID) {
    $deleted = false;
    try {
        $sql = $db->prepare("DELETE FROM Customers WHERE customerID=:id");
        $sql->bindParam(':id', $customerID);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $deleted = true;
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    return $deleted;
}


function updateUserAddress($db, $id, $address) {
    $updated = false;
    try {
        $sql = $db->prepare("UPDATE Customers SET address=:addy WHERE customerID=:custID");
        $sql->bindParam(':addy', $address);
        $sql->bindParam(':custID', $id);
        $sql->execute();
        if($sql->rowCount() > 0) {
            $updated = true;
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    echo "the bool value in the update address sql function is: " . $updated;
    return $updated;
}

/**
 * @param $db
 * @return array
 * Function to query the Products table and build a Product class object with each row returned, which
 * is added to an array and returned by the function to the caller
 */
function getAllProducts($db) {
    $products = array();
    try {
        $sql = $db->query("SELECT * FROM Products");
        $results = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $result) {
            $product = new Product();
            $product->setId($result['productID']);
            $product->setName($result['productName']);
            $product->setPrice($result['price']);
            $product->setDescription($result['description']);
            $product->setPicURL($result['pictureURL']);
            $products[] = $product;
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    //killDB($db);
    return $products;
}

/**
 * @param $db
 * @param $id
 * @return null
 * Function to get a single product by name
 */
function getProduct($db, $id) {
    $product = null;
    try {
        $sql = $db->prepare("SELECT * FROM Products WHERE productID=:product");
        $sql->bindParam(':product', $id, PDO::PARAM_INT);
        $sql->execute();
        $row = $sql->fetch(PDO::FETCH_ASSOC);
        if($row) {
            $product = new Product();
            $product->setId($row['productID']);
            $product->setName($row['productName']);
            $product->setPrice($row['price']);
            $product->setDescription($row['description']);
            $product->setPicURL($row['pictureURL']);
        }
        else {

        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    //killDB($db);
    return $product;
}

/**
 * @param $db
 * @param $productArray
 * @return bool
 * Function to add a new product through the admin menu
 */
function addProduct($db, $productArray) {
    $added = false;
    try {
        $sql = $db->prepare("INSERT INTO Products(productName, price, description, pictureURL) VALUES(
                          :productName, :price, :description, :pictureURL
                       )");
        $sql->execute(array(':productName' => $productArray['productName'],
            ':price' => $productArray['price'],
            ':description' => $productArray['description'],
            ':pictureURL' => $productArray['pictureURL']));
        if ($sql->rowCount() > 0) {
            $added = true;
        }
    }
    catch(PDOException $e) {
       echo $e->getMessage();
    }
    //killDB($db);
    return $added;
}

/**
 * @param $db
 * @param $productArray
 * @param $productID
 * @return bool
 * Function to update a product with new fields in the array, and a product id matching the argument
 */
function updateProduct($db, $productArray, $productID) {
    $updated = false;
    try {
        $sql = $db->prepare("UPDATE Products SET productName=:name, price=:price, description=:description WHERE productID=:id");
        $sql->execute(array(
            ':name' => $productArray['productName'],
            ':price' => $productArray['price'],
            ':description' => $productArray['description'],
            ':id' => $productID
        ));
        if ($sql->rowCount() > 0) {
            $updated = true;
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    //killDB($db);
    return $updated;
}

/**
 * @param $db
 * @param $productID
 * @return bool
 * Function to delete product from db
 */
function deleteProduct($db, $productID) {
    $deleted = false;
    try {
        $sql = $db->prepare("DELETE FROM Products WHERE productID=:id");
        $sql->bindParam(':id', $productID);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $deleted = true;
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    //killDB($db);
    return $deleted;
}


?>