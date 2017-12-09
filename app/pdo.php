<?php
    function getDb($user, $pass, $dbname, $host) {
        $params = 'mysql:host=' . $host . ';dbname=' . $dbname . ';charset=utf8mb4';
        $db = null;
        try {
            $db = new PDO($params, $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e) {
            $e->getMessage();
        }
        return $db;
    }


?>