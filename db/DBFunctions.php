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
 * @param $user
 * @param $email
 * @return Customer
 * Function to build a prepared statement with PDO, and build/return a Customer class object, if that
 * customer exists in mysql
 */
function getUser($db, $user, $email) {
    $customer = null;
    $sql = $db->prepare("SELECT * FROM Customers WHERE username=:user AND email=:email");
    $sql->bindParam(':user', $user, PDO::PARAM_STR);
    $sql->bindParam(':email', $email, PDO::PARAM_STR);
    $sql->execute();
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    if($result != null) {
        $customer = new Customer();
        $customer->setId($result['customerID']);
        $customer->setUsername($result['username']);
        $customer->setEmail($result['email']);
        $customer->setAddress($result['address']);
        $customer->setIsAdmin($result['isAdmin']);
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
    $newcustomer = null;
    $adminStatus = 0;
    try {
        $sql = $db->prepare("INSERT INTO Customers(username, email, address, isAdmin) VALUES (
                              :user, :emailaddy, :addy, :admin
                            )");
        if($userArray['isAdmin']) {
            $adminStatus = 1;
        }
        $sql->execute(array(':user' => $userArray['username'],
                            ':emailaddy' => $userArray['email'],
                            ':addy' => $userArray['address'],
                            ':admin' => $adminStatus
            ));
        if($sql->rowCount() > 0) {
            $newCustomer = new Customer();
            $newCustomer->setUsername($userArray['username']);
            $newCustomer->setEmail($userArray['email']);
            $newCustomer->setAddress($userArray['address']);
            $newCustomer->setIsAdmin($userArray['isAdmin']);
        }
        $sql = $db->prepare("SELECT customerID FROM Customers WHERE username=:name AND email=:email");
        $sql->execute(array(':username' => $userArray['username'],
                            ':email' => $userArray['email']));
        $id = $sql->fetch(PDO::FETCH_ASSOC);
        if($sql->rowCount() > 0) {
            $newCustomer->setId($id['customerID']);
        }
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
    return $newCustomer;
}

/**
 * @param $db
 * @return array
 * Function to query the Products table and build a Product class object with each row returned, which
 * is added to an array and returned by the function to the caller
 */
function getAllProducts($db) {
    $products = array();
    $sql = $db->query("SELECT * FROM Products");
    $results = $sql->fetchAll(PDO::FETCH_ASSOC);
    foreach($results as $result) {
        $product = new Product();
        $product->setId($result['productID']);
        $product->setName($result['productName']);
        $product->setPrice($result['price']);
        $product->setDescription($result['description']);
        $product->setPicURL($result['pictureURL']);
        $products[] = $product;
    }
    return $products;
}

/**
 * @param $db
 * @param $name
 * @return null
 * Function to get a single product by name
 */
function getProduct($db, $id) {
    $product = null;
    try {
        $sql = $db->prepare("SELECT * FROM Products WHERE productID=:product LIMIT 1");
        $sql->bindParam(':product', $id);
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
    }
    catch(PDOException $e) {
        echo $e->getMessage();
    }
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
    $sql = $db->prepare("INSERT INTO Products(productName, price, description, pictureURL) VALUES(
                          :productName, :price, :description, :pictureURL
                       )");
    $sql->execute(array(':productName' => $productArray['productName'],
                         ':price' => $productArray['price'],
                         ':description' => $productArray['description'],
                         ':pictureURL' => $productArray['pictureURL']));
    if($sql->rowCount() > 0) {
        $added = true;
    }
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

/**
 * @param $db
 * @param $productID
 * @return bool
 * Function to delete product from db
 */
function deleteProduct($db, $productID) {
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