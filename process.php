<?php
session_start();
$time_now = $_SERVER['REQUEST_TIME'];
if(!isset($_SESSION['timeout'])) {
    $_SESSION['timeout'] = $time_now;
}
$duration = 1800;

if(isset($_SESSION['timeout']) && $time_now - $_SESSION['timeout'] > $duration) {
    unset($_SESSION['username']);
    unset($_SESSION['email']);
    unset($_SESSION['timeout']);
    session_unset();
    session_destroy();
}
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
                <h2>Thanks for doing semi-solid business with our half-witted company!</h2>
                <p>Now that we have your money, PLEASE use this button to logout</p>
                <p>If you are not satisfied with our information security, you may want</p>
                <p>to consider pursuing a degree in software development and security?</p>
                <span class="logout"><a href="logout.php"><button class="btn btn-primary btn-block">Logout</button></a></span>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</body>
</html>
