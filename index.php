<?php
// ----- DEEL 0: DE UITSMIJTER (NIEUW) -----
session_start(); // Dit MOET de allereerste regel zijn.

// De controle: Is er een 'user_id' ticket in de kluis?
if ( !isset($_SESSION['user_id']) ) {
    // Geen ticket? Je hoort hier niet. Terug naar de poort.
    header('Location: login.php');
    exit; // STOP HET SCRIPT.
}

// ----- DEEL 1: DE PHP-LOGICA (NU AANGEPAST) -----
// Als we hier komen, is de gebruiker ingelogd.
require_once 'connect.php';

// NIET MEER HARDCODED! We lezen het ticket.
$huidige_user_id = $_SESSION['user_id']; 
$resultaten = [];

try {
    $sql = "SELECT 
                excercises.titel, 
                excercises.beschrijving, 
                users.naam 
            FROM 
                excercises 
            JOIN 
                users ON excercises.user_id = users.user_id
            WHERE 
                excercises.user_id = ?";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$huidige_user_id]);
    
    $resultaten = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // DEZE LOGICA IS NU OVERBODIG. We hebben de naam al.
    // if (!empty($resultaten)) {
    //     $gebruikersnaam = $resultaten[0]['naam'];
    // }

} catch (PDOException $e) {
    die("Fout bij het ophalen van data: " . $e->getMessage());
}

// ----- DEEL 2: DE HTML-PRESENTATIE -----
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <title>Mijn Oefeningen</title>
</head>
<body>

</br><a href="logout.php">Log uit</a></br>

    <h1>Welkom, <?php echo htmlspecialchars($_SESSION['user_naam']); ?></h1>
    <p>Hier zijn jouw opgeslagen oefeningen:</p>

    </body>
</html>