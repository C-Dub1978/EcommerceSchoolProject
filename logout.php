<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['email']);
session_unset();
session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Thanks for Shopping With Initech</title>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
        <link href="styles/welcome.css" rel="stylesheet" type="text/css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="javascript"></script>
    </head>
<body>
<div class="main_bg">
<div class="row">
    <div class="col-sm-2"></div>
    <div class="jumbotron col-sm-8">
        <h3>Thanks for shopping with initech!</h3>
        <a href="login.html"><button class="btn btn-primary">Shop Again!</button></a>
    </div>
    <div class="col-sm-2"></div>
</div>
</div>
</body>
</html>
