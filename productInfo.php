<?php
session_start();
$product = $_GET['product_id'];
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
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $product; ?></title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles/welcome.css" rel="stylesheet" type="text/css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="javascript"></script>
</head>
<body>
    <div class="main_bg">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="jumbotron text-center col-sm-8">
                <?php
                    echo "<h2>Welcome, " . $_SESSION['username'] . "!</h2><br>";
                    echo "Your product: " . $product . "<br>";
                ?>
            </div>
            <div class="col-sm-2"></div>
        </div><br><br><br>
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <?php
                    switch($product) {
                        case "red_stapler":
                            echo "<img src='pics/stapler.jpg' width='400' height='400'>";
                            echo "<p>An absolute classic, heavy duty, durable, and lasting</p>";
                            echo "<p>Price: $19.99</p><br>";
                            break;
                        case "blue_stapler":
                            echo "<img src='pics/staplerBlue.jpg' width='400' height='400'>";
                            echo "<p>An absolute classic, heavy duty, durable, and lasting</p>";
                            echo "<p>Price: $19.99</p><br>";
                            break;
                        case "small_floppy":
                            echo "<img src='pics/floppySmall.jpeg' width='400' height='400'>";
                            echo "<p>For your storage needs, up to 1.44 MB disk storage</p>";
                            echo "<p>Price: $5.18</p><br>";
                            break;
                        case "big_floppy":
                            echo "<img src='pics/floppyBig.jpg' width='400' height='400'>";
                            echo "<p>Stores up to 1.2 MB, excellent storage solution</p>";
                            echo "<p>Price: $9.11</p><br>";
                            break;
                        case "macintosh_1":
                            echo "<img src='pics/macintosh1.jpeg' width='400' height='400'>";
                            echo "<p>	With a 1.1 Ghz processor and 512Kb Memory, desktop processing is simplistic and easy</p>";
                            echo "<p>Price: $1,237.74</p><br>";
                            break;
                        case "macintosh_2":
                            echo "<img src='pics/macintosh2.jpg' width='400' height='400'>";
                            echo "<p>Featuring a 2 Ghz, Dual-core processor, this one takes server computing to the next level</p>";
                            echo "<p>Price: $1,237.74</p><br>";
                            break;
                        case "amiga":
                            echo "<img src='pics/amiga.jpg' width='400' height='400'>";
                            echo "<p>The future of graphic intense applications</p>";
                            echo "<p>Price: $1,556.01</p><br>";
                            break;
                        case "ibm":
                            echo "<img src='pics/ibm.jpg' width='400' height='400'>";
                            echo "<p>Utilizing hardware and software that took NASA to the moon</p>";
                            echo "<p>Price: $2,300.11</p><br>";
                            break;
                        case "sony":
                            echo "<img src='pics/sony.png' width='400' height='400'>";
                            echo "<p>Sexy, sleek, simplistic. This laptop gives you power in your pocket</p>";
                            echo "<p>Price: $898.71</p><br>";
                            break;
                        case "server":
                            echo "<img src='pics/server.jpg' width='400' height='400'>";
                            echo "<p>Turn your small business into a modern-day Turing machine and never look back</p>";
                            echo "<p>Price: $7,019.33</p><br>";
                            break;
                        case "coffee":
                            echo "<img src='pics/coffee.png' width='400' height='400'>";
                            echo "<p>Drive. Initiative. Productive developers. Bring the crack epidemic into the office</p>";
                            echo "<p>Price: $1,900.21</p><br>";
                            break;
                        case "beer":
                            echo "<img src='pics/beer.jpg' width='400' height='400'>";
                            echo "<p>Because EVERYONE loves beer</p>";
                            echo "<p>Price: $412.02</p><br>";
                            break;
                    }
                ?>
                <a href="logout.php" class="right"><button class="btn btn-primary">Logout</button></a>
                <a href="index.php"><button class="btn btn-primary">Back To Products</button></a>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
</body>
</html>

