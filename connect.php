<?php
// Stap 1: Definieer de "telefoonnummers"
$host = 'localhost';
$db   = 'micro_enurgy_poc';
$port = '8889'; 
$user = 'root'; 
$pass = 'root'; 

// De DSN (Data Source Name) - plak de stukjes aan elkaar
$dsn = "mysql:host=$host;port=$port;dbname=$db";

// Stap 2: Het 'try...catch' blok
try {
    // Stap 3: Maak het PDO-object (de verbinding)
    // Dit is de 'gevaarlijke' regel die kan mislukken
    $pdo = new PDO($dsn, $user, $pass);

    // Als we deze regel bereiken, is het gelukt.
    echo "Verbinding met database '$db' gelukt!";

} catch (PDOException $e) {
    // Als de 'try' mislukt, springt PHP hierheen.
    // $e bevat het foutobject.
    // getMessage() geeft de mens-leesbare fout.
    echo "Verbinding mislukt: " . $e->getMessage();
}

?>