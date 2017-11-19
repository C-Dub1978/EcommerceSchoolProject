<?php
session_start();

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$address = $_POST['address'];
$city = $_POST['city'];
$state = $_POST['state'];
$card_type = $_POST['cardRadio'];
$card_number = $_POST['card_number'];
$card_expiration = $_POST['card_expiration'];
?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>
    <?php
        echo "Thanks for shopping " . $first_name . " " . $last_name . "!!!";
        echo "Address: " . $address . "<br>";
        echo "City: " . $city . "<br>";
        echo "State: " . $state . "<br>";
        echo "Card Type: " . $card_type . "<br>";
        echo "Card Number: " . $card_number . "<br>";
        echo "Expiration: " . $card_expiration . "<br>";
    ?>
</body>
</html>
