<?php
include '../classes/DBParams.php';
function getDBParams() {
    $db = null;
    $myPairs = null;
    $keys = array();
    $values = array();
    $trimmed = fopen('../params/dbparams.txt', 'r')
    or die("Unable to open file");
    if($trimmed != null) {
        while(!feof($trimmed)) {
            $line = explode("=", fgets($trimmed));
            $keys[] = $line[0];
            $values[] = $line[1];
        }
        $myPairs = array_combine($keys, $values);
        $db = new DBParams($myPairs['username'], $myPairs['password'], $myPairs['host'], $myPairs['db']);
    }
    fclose($trimmed);
    return $db;
}
?>