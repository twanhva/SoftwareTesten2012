<?php

function connect() {
    include('credentials.php');
    
    global $conn;
    $conn = mysql_connect($host, $username, $password) or die("FOUT >> Er kan geen connectie gemaakt worden");
    mysql_select_db($db_name) or die("FOUT >> De database kan niet worden gevonden");

    global $dbh;
try {
    $dbh = new PDO('mysql:dbname=' . $db_name . ';host=' . $host, $username, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
    
}
connect();
?>