<?php
/**
 * Created by PhpStorm.
 * User: klown
 * Date: 12/8/17
 * Time: 10:49 PM
 */
include 'getDBParams.php';
$params = getDBParams();
if($params != null) {
    echo "got db params!<br>";
    echo $params->getUsername() . "<br>";
    echo $params->getPassword() . "<br>";
    echo $params->getHost() . "<br>";
    echo $params->getDb() . "<br>";
}
?>