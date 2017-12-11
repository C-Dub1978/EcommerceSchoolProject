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
    unset($_SESSION['id']);
    unset($_SESSION['isAdmin']);
    unset($_SESSION['timeout']);
    session_unset();
    session_destroy();
}
?>