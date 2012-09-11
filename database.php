<?php

function connect() {
    $host = "mysql51-c1.sinanceylan.nl";
    $username = "sinanceyl";
    $password = "5q4%0Jk0";
    $db_name = "sinanceyl";

    $host = 'localhost';
    $username = 'root';
    $password = '';
    $db_name = 'sinanceyl';
    
    $conn = mysql_connect($host, $username, $password) or die("FOUT >> Er kan geen connectie gemaakt worden");
    mysql_select_db('sinanceyl') or die("FOUT >> De database kan niet worden gevonden");
}
connect();
?>