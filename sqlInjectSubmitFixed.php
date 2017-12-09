<?php
$serverName = "localhost";
$username = "sdev_owner";
$password = "sdev300";
$dbname = "sdev";
$postuser = "";
$postpassword = "";

if(isset($_POST)) {
    $postuser = $_POST['username'];
    $postpassword = $_POST['password'];
}

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dbname", $username, $password);
    // set to exception mode to disallow returning query error info on the page
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $conn->prepare("SELECT * FROM Users WHERE username = :name AND password = :pass LIMIT 1;");
    $stmt->bindParam(':name', $postuser);
    $stmt->bindParam(':pass', $postpassword);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        $values = $stmt->fetch(PDO::FETCH_ASSOC);
        echo $values['username'] . "<br><br>";
        echo $values['password'] . "<br><br>";
        echo $values['address'] . "<br><br>";
    }


}
catch (PDOException $e) {
    echo "connection failed: " . $e->getMessage();
}

?>