<?php

function connect() {
    $host = "mysql51-c1.sinanceylan.nl";
    $username = "sinanceyl";
    $password = "5q4%0Jk0";
    $db_name = "sinanceyl";

//    $host = 'localhost';
//    $username = 'root';
//    $password = '';
//    $db_name = 'sinanceyl';
    
    global $conn;
    $conn = mysql_connect($host, $username, $password) or die("FOUT >> Er kan geen connectie gemaakt worden");
    mysql_select_db('sinanceyl') or die("FOUT >> De database kan niet worden gevonden");

    global $dbh;
try {
    $dbh = new PDO('mysql:dbname=' . $db_name . ';host=' . $host, $username, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
    
}
connect();
?>