<?php

$host = 'localhost';
$db   = 'micro_enurgy_poc';
$port = '8889'; 
$user = 'root'; 
$pass = 'root'; 


$dsn = "mysql:host=$host;port=$port;dbname=$db";


try {

    $pdo = new PDO($dsn, $user, $pass);

    echo "Verbinding met database '$db' gelukt!</br>";

} catch (PDOException $e) {

    echo "Verbinding Mislukt..." ;
    die;

}

?>