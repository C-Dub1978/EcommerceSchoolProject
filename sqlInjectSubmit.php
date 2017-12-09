<?php
$serverName = "localhost";
$username = "sdev_owner";
$password = "sdev300";
$postuser = "";
$postpassword = "";

if(isset($_POST)) {
    $postuser = $_POST['username'];
    $postpassword = $_POST['password'];
}

try {
    $conn = new PDO("mysql:host=$serverName;dbname=sdev", $username, $password);
    // set to exception mode
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "connection successful<br><br>";
    $sql = "SELECT * FROM Users WHERE username = '$postuser'";
    $stmt = $conn->query($sql);
    $row = $stmt->fetchObject();
    echo $row->userID . "<br><br>";
    echo $row->username . "<br><br>";
    echo $row->password . "<br><br>";
    echo $row->address . "<br><br>";

}
catch(PDOException $e) {
    echo "connection failed: " . $e->getMessage();
}
?>