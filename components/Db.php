<?php

class Db {

    public static function getConnection() {

        $paramsPath = ROOT. '/config/db_params.php';
        $params = include($paramsPath);
 
        $dsh = "mysql:host={$params['host']};dbname={$params['dbname']}";
        $db = new PDO($dsh, $params['user'], $params['password']);
 
        return $db;
     }   
}
?>