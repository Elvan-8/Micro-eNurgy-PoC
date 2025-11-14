<?php
// ----- DEEL 1: DE PHP-LOGICA (DE MOTOR) -----
require_once 'connect.php';

$huidige_user_id = 1;
$resultaten = []; // Maak de variabele 'leeg'
$gebruikersnaam = ''; // Maak de variabele 'leeg'

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

    // Als we resultaten hebben, pakken we de naam van de gebruiker
    // (Deze is in elke rij hetzelfde, dus we pakken gewoon de eerste)
    if (!empty($resultaten)) {
        $gebruikersnaam = $resultaten[0]['naam'];
    }

} catch (PDOException $e) {
    // In een echt project log je dit, nu tonen we de fout
    die("Fout bij het ophalen van data: " . $e->getMessage());
}

// ----- DEEL 2: DE HTML-PRESENTATIE (DE DISPLAY) -----
// Vanaf hier sturen we HTML naar de browser
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mijn Oefeningen</title>
    <style>
        body { font-family: sans-serif; margin: 2em; }
        .oefening { border: 1px solid #ccc; padding: 10px; margin-bottom: 10px; }
        h1 { color: #333; }
        h2 { color: #555; }
    </style>
</head>
<body>

    <h1>Welkom, <?php echo htmlspecialchars($gebruikersnaam); ?></h1>
    <p>Hier zijn jouw opgeslagen oefeningen:</p>

    <hr> <?php if (empty($resultaten)): ?>
    
        <p>Je hebt nog geen oefeningen aangemaakt.</p>
    
    <?php else: ?>
    
        <?php foreach ($resultaten as $oefening): ?>
            
            <div class="oefening">
                
                <h2><?php echo htmlspecialchars($oefening['titel']); ?></h2>
                <p><?php echo htmlspecialchars($oefening['beschrijving']); ?></p>
            
            </div>
        
        <?php endforeach; ?>
    
    <?php endif; ?>

</body>
</html>